<?php
class StudentsController extends AppController{
	public $uses = array('Enquiry','Applicant','ApplicantFile','DownloadFile','ShortMessage','ApplicantItinerary');
	public $name = 'Students';
	public $layout = 'student';
	public $components = array('FileUploader');

	public $paginate = array(
			'limit' => 20,
			'order' => array(
					'ShortMessage.is_read'=>'ASC',
					'ShortMessage.id'=>'DESC'
			),
			'recursive' => 1
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('login','home','logout','upload','basic_info',
		'ajax_save_basic','ajax_save_family','send_message_ajax','my_messages',
		'mask_message_as_readed','ajax_save_app_itinerary','arrive_us_activate','ajax_save_app_return');
		/*
		 * 把给学生的新的短消息的个数设置到页面中
		 */
		$this->ShortMessage->unbindModel(array('belongsTo'=>array('Receiver')));
		$this->set(
			'new_messages',
			$this->ShortMessage->find('count',array('conditions'=>array(
				'AND'=>array(
					'ShortMessage.receiver_id'=>$this->Session->read('enquiry_id'),
					'ShortMessage.is_read'=>0
				)
			)))
		);
	}
	
	public function mask_message_as_readed($id=NULL){
		if ($id) {
			$this->ShortMessage->id = $id;
			if ($this->ShortMessage->exists()) {
				$this->ShortMessage->saveField('is_read',1);
			}
		}
		$this->redirect(array('action'=>'my_messages'));
	}
	
	public function my_messages(){
		$this->paginate['conditions']=array(
			'ShortMessage.receiver_id'=>$this->Session->read('enquiry_id'),
		);
		$this->set('data',$this->paginate('ShortMessage'));
		return;
	}
	
	public function send_message_ajax(){
		if ($this->request->is('ajax')) {	
			if ($this->Session->check('enquiry_id')) {
				$this->layout = 'ajax';
				$bean = array();
				$bean['ShortMessage']['receiver_id'] = $this->request->data['receiver_id'];
				$bean['ShortMessage']['sender_id'] = $this->request->data['sender_id'];
				$bean['ShortMessage']['content'] = $this->request->data['message_content'];
				if ( $this->ShortMessage->send($bean) ) {
					$this->set('data',1);
				}else{
					$this->set('data',0);
				}
			}else{
				//Session expired or not login
				$this->set('data',0);
			}
			$this->render('ajax_view','ajax');
		}
		return;
	}
	
	/**
	 * 已经被列为申请人的学生登录的方法，这里要特别说明，通过enquriy来登录，但是同时要找出它的applicant的id，之后才能进行其他的操作
	 */
	public function login(){
		$this->layout = 'user_login';
		if (!empty($this->request->data)) {
			$d = $this->Enquiry->student_login($this->request->data);
			if( $d ) {
				//redirect to the student home page,save the enquiry id in the session
				if (!$this->Session->check('enquiry_id')) {
					$this->Session->write('enquiry_id',$d['Enquiry']['id']);
					$this->Session->write('enquiry_name',$d['Enquiry']['name']);
					$this->Session->write('project_id',$d['Enquiry']['project_id']);
					$this->Session->write('teacher_id',$d['User']['id']);
					$this->Session->write('teacher_name',$d['User']['name']);
					$this->Session->write('teacher_email',$d['User']['username']);
					$this->Session->write('current_phase',$d['Applicant']['phase_id']);//代表当前学生处于哪个阶段
				}
				$this->redirect(array('controller'=>'Students', 'action'=>'basic_info'));
			}
		}
		return;
	}
	
	public function home( $msg_type = null ,$phase_id = NULL){
		if ($this->Session->check('enquiry_id')) {
			//通过Enquiry找到Applicant的信息
			if (!$this->Session->check('applicant_id')) {
				$temp_app = $this->Applicant->find('first',array(
					'conditions'=>array(
							'Applicant.enquiry_id'=>$this->Session->read('enquiry_id')
							),
					'fields'=>array('Applicant.id','Applicant.application_data')
					));
				$this->Session->write('applicant_id',$temp_app['Applicant']['id']);
				//
				$this->Session->write('material_status',$temp_app['Applicant']['application_data']);
			}
			//取出申请人文件的信息
			$d = $this->DownloadFile->find('all',array(
						'joins'=>array(
								array(
										'table'=>'applicant_files',
										'alias' => 'ApplicantFile',
										'type' => 'LEFT',
										'conditions'=>array(
												'AND'=>array(
														'DownloadFile.id = ApplicantFile.download_file_id',
														'ApplicantFile.applicant_id'=>$this->Session->read('applicant_id')
												)
										)
									)
								),
						'conditions'=>array(
								'and'=>array(
									'DownloadFile.phase_id'=>$phase_id,
									'DownloadFile.project_id'=>$this->Session->read('project_id'),
									'DownloadFile.is_deleted'=>0, //只能看到没有删除的
									'DownloadFile.available'=>1 //只能看到已经发布的
								) 
							),
						'fields'=>array(
								'DownloadFile.title',
								'DownloadFile.file_name',
								'DownloadFile.id',
								'DownloadFile.phase_id',
								'DownloadFile.notes',
								'ApplicantFile.id',
								'ApplicantFile.is_passed',
								'ApplicantFile.file_name',
								'ApplicantFile.modified',
								'ApplicantFile.latest_comments',
								'ApplicantFile.is_readed'
								)
					));
			$this->set('data',$d);
			$this->set('phase_id',$phase_id);
			
			if ($phase_id==PHASE_BEFORE_LEAVING) {
				$this->set('itinerary',$this->ApplicantItinerary->find('first',array('conditions'=>array('ApplicantItinerary.applicant_id'=>$this->Session->read('applicant_id')))));
			}
			if ($msg_type) {
				$this->set('msg_type',$msg_type);
			}
			
			if ($phase_id==PHASE_RETURN) {
				$this->set('return_form',$this->Applicant->find('first',array(
					'conditions'=>array('Applicant.id'=>$this->Session->read('applicant_id')),
					'recursive'=>-1,
					'fields'=>array('Applicant.return_date','Applicant.project_status_id','Applicant.return_status_id','Applicant.homestay_ok',)
				)));
				$this->render('return_cn');
			}
		}else{
			$this->redirect(array('controller'=>'Students','action'=>'login'));
		}
		return;
	}
	
	/**
	 * 申请人上传文件的方法
	 */
	public function upload(){
		if (!empty($this->request->data)) {
			//Check if the record has existed
			$result = $this->FileUploader->save($this->request->data);
			if ( $result === SUCCESS ) {
				//保存成功;接下来写到数据库中
				$temp = $this->ApplicantFile->find(
						'first',array('conditions'=>array(
								'ApplicantFile.applicant_id'=>$this->request->data['ApplicationFile']['applicant_id'],
								'ApplicantFile.download_file_id'=>$this->request->data['ApplicationFile']['download_file_id']
								)));
				//检查是否已经有记录存在
				if ($temp) {
					//已经有记录了，先是更新操作;
					$this->ApplicantFile->id = $temp['ApplicantFile']['id'];
					$bean = array('ApplicantFile'=>array(
							'file_name' => trim($this->request->data['Applicant']['application_form']['name']),
							'is_updated' => 1
					));
				}else{
					//没有，表示要插入一新的记录
					$this->DownloadFile->id = $this->request->data['ApplicationFile']['download_file_id'];
					$bean = array('ApplicantFile'=>array(
							'applicant_id' => $this->request->data['ApplicationFile']['applicant_id'],
							'file_name' => trim($this->request->data['Applicant']['application_form']['name']),
							'download_file_id' => $this->request->data['ApplicationFile']['download_file_id'],
							'phase_id' => $this->DownloadFile->field('phase_id')  //把这个文件属于哪个阶段也保存起来
							));
				}
				
				if ($this->ApplicantFile->save($bean)) {
					$this->Session->setFlash('文件已经成功保存！');
					$this->redirect(array('action'=>'home','success',$this->request->data['ApplicationFile']['phase_id']));
				}else{
					$this->Session->setFlash('数据库故障，无法保存您上传的文件，请稍候再试或联系优势的老师！');
					$this->redirect(array('action'=>'home','error',$this->request->data['ApplicationFile']['phase_id']));
				}
			}else{
				switch ($result) {
					case WRONG_FILE_TYPE:
						$this->Session->setFlash('您上传的文件格式不对，请使用Word文件或者PDF文件，或联系优势的老师！');
						$this->redirect(array('action'=>'home','error',$this->request->data['ApplicationFile']['phase_id']));
					break;
					
					case SAVE_UPLOAD_FILE_FAILED:
						$this->Session->setFlash('系统繁忙，无法保存您上传的文件，请稍候再试或联系优势的老师！！');
						$this->redirect(array('action'=>'home','error',$this->request->data['ApplicationFile']['phase_id']));
						break;
					
					default:
						$this->Session->setFlash('系统故障，无法保存您上传的文件，请稍候再试或联系优势的老师！！');
						$this->redirect(array('action'=>'home','error',$this->request->data['ApplicationFile']['phase_id']));
					break;
				}
			}
		}
		return;
	}
	
	public function basic_info(){
		if ($this->Session->check('enquiry_id')) {
			$this->set('data',$this->Applicant->find('first',array('conditions'=>array('Applicant.enquiry_id'=>$this->Session->read('enquiry_id')))));
			//$this->set('provinces',$this->Province->find('list'));
		}else{
			$this->redirect(array('action'=>'logout'));
		}
		
		return;
	}
	
	public function ajax_save_basic(){
		if ($this->request->is('ajax')) {
			$this->Enquiry->id = $this->request->data['enquiry_id'];
			$bean = array(
					'Enquiry'=>array(
							'id'=>$this->request->data['enquiry_id'],
							'name'=>$this->request->data['EnquiryName'],
							'school'=>$this->request->data['EnquirySchool'],
							'major'=>$this->request->data['EnquiryMajor'],
							'grade'=>$this->request->data['EnquiryGrade'],
							'mobile'=>$this->request->data['EnquiryMobile'],
							'gender'=>$this->request->data['EnquiryGender'],
							'email'=>$this->request->data['EnquiryEmail'],
							'province_id'=>$this->request->data['EnquiryProvinceId'],
							'city_name'=>$this->request->data['EnquiryCityName'],
							'identification'=>$this->request->data['EnquiryIdentification']
					)
			);
			if ($this->Enquiry->save($bean)) {
				$this->set('data',1);
			}else{
				$this->set('data',0);
			}
			$this->render('ajax_view','ajax');
		}
		return;
	}
	
	public function ajax_save_family(){
		if ($this->request->is('ajax')) {
			$this->Applicant->id = $this->request->data['applicant_id'];
			$bean=array('Applicant');
			foreach ($this->request->data as $key=>$value) {
					$bean['Applicant'][$key]=$value;
			}
			if ($this->Applicant->save($bean)) {
				$this->set('data',1);
			}else{
				$this->set('data',0);
			}
			$this->render('ajax_view','ajax');
		}
		return;
	}
	
	public function logout(){
		if ($this->Session->check('enquiry_id')) {
			$this->Session->delete('enquiry_id');
			$this->Session->destroy();
		}
		$this->redirect(array('controller'=>'Students','action'=>'login'));
		return;
	}
	
	public function ajax_save_app_itinerary(){
		if ($this->request->is('ajax')) {
				//先根据app id的值看看是不是更新操作
				$bean = $this->ApplicantItinerary->find('first',
					array('conditions'=>array(
						'ApplicantItinerary.applicant_id'=>$this->request->data['applicant_id']
					)));
				
				$this->ApplicantItinerary->id = $bean['ApplicantItinerary']['id'];
				foreach ($this->request->data as $key=>$value) {
					$bean['ApplicantItinerary'][$key]=$value;
				}
				//$bean['ApplicantItinerary']['group_id']=$this->Session->read('my_group');
				$bean['ApplicantItinerary']['user_id']=$this->Session->read('teacher_id');
				if ($this->ApplicantItinerary->save($bean)) {
					$this->set('data',1);
				}else{
					$this->set('data',0);
				}
				//发一个短消息给老师，但是只是尽力到达，不判断是否成功
				$this->ShortMessage->save(
					array(
						'ShortMessage'=>array(
							'receiver_id'=>$this->Session->read('teacher_id'),
							'content'=>$this->Session->read('enquiry_name').'刚刚更新了行程单，特此通知！'
						)
					)
				);
				
				$this->render('ajax_view','ajax');
			}
	}
	
	public function ajax_save_app_return(){
		if ($this->request->is('ajax')) {
				//下面是固定的操作
				$this->Applicant->id = $this->request->data['applicant_id'];
				$bean=array('Applicant');
				foreach ($this->request->data as $key=>$value) {
					$bean['Applicant'][$key]=$value;
				}
				if ($this->Applicant->save($bean)) {
					$this->set('data',1);
				}else{
					$this->set('data',0);
				}
				$this->render('ajax_view','ajax');
			}
	}
}