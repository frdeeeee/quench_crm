<?php
require_once 'ApplicantEventListener.php'; //这个是专门监听和响应和applicant有关操作的消息的
class ProfilesController extends AppController{
	public $uses = array('Enquiry','Applicant','Profile','Checkin','CheckinPhoto');
	public $name = 'Profiles';
	public $layout = 'student_check_in';
	public $components = array('FileUploader');

	public $paginate = array(
			'limit' => 20,
			'recursive' => 1
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('activate','check_in','add_photo','list_checkins',
			'please_wait','update_status','view_detail','leave_teacher_note','modify','return_request_form');
		if (in_array($this->action, array('update_status','view_detail','leave_teacher_note'))) {
			$listener = new ApplicantEventListener();
			$this->Profile->getEventManager()->attach($listener);
		}else{
			//表明不是老师申请执行的方法
			if (!$this->Session->check('enquiry_id') || is_null($this->Session->read('enquiry_id'))) {
				$this->redirect(array('controller'=>'Students','action'=>'login'));
				return;
			}
		}
	}
	
	public function leave_teacher_note(){
		if ($this->request->is('ajax')) {
			$this->Profile->id = $this->request->data['profile_id'];
			$this->Profile->set(array(
				'teacher_notes'=>$this->request->data['teacher_notes'],
				'is_updated_by_student'=>0
			));
			if ($this->Profile->save()) {
				$this->set('data',1);
			}else{
				$this->set('data',0);
			}
			$this->render('ajax_result','ajax');
		}
		return;
	}
	
	public function view_detail($id=NULL){
		if ($this->Auth->user('department_id')==OPERATION_DEPARTMENT) {
			$this->layout = 'default';
		}
		$this->Profile->id = $id;
		$this->set('data',$this->Profile->read());
		return;
	}
	
	public function update_status(){
		if ($this->request->is('ajax')) {
			$this->set('data',$this->Profile->update_status($this->request->data['profile_id'],$this->Auth->user()));
			$this->render('ajax_result','ajax');
		}
		return;
	}
	
	//Student must activate from here
	public function activate(){
		if (empty($this->request->data)) {
			//check if activated;
			$profile = $this->Profile->find(
				'first',
				array(
					'conditions'=>array(
						'Profile.enquiry_id'=>$this->Session->read('enquiry_id')
					)
				)
			);
			if (!empty($profile['Profile'])) {
				if ($profile['Profile']['status']==0) {
					//表示还没有激活;
					$this->redirect(array('action'=>'please_wait'));
				}else if($profile['Profile']['status']==1){
					//表示已经被老师激活
					$this->redirect(array('action'=>'check_in'));
				}
			}
		}else{
			$count = $this->Profile->find('count',array('conditions'=>array('Profile.enquiry_id'=>$this->Session->read('enquiry_id'))));
			if ($count==0) {
				$this->request->data['Profile']['enquiry_id'] = $this->Session->read('enquiry_id');
				if($this->Profile->save($this->request->data)){
					$this->redirect(array('action'=>'please_wait'));
				}else{
					$this->Session->setFlash('无法激活，请稍候再试或优势办的管理老师');
					$this->set('msg_type','error');
				}
			}else{
				$this->redirect(array('action'=>'please_wait'));
			}
		}
		$this->render($this->Session->read('project_id').DS.$this->action);
		return;
	}
	
	public function modify(){
		if (empty($this->request->data)) {
			$this->set('data',
				$this->Profile->find('first',array('conditions'=>array('Profile.enquiry_id'=>$this->Session->read('enquiry_id'))))
			);
		}else{
			//每次学生修改激活信息的时候，都把已更新的只是改为真
			$this->request->data['Profile']['is_updated_by_student']=1;
			if($this->Profile->save($this->request->data)){
					$this->redirect(array('action'=>'please_wait'));
			}else{
					$this->Session->setFlash('无法激活，请稍候再试或优势办的管理老师');
					$this->set('msg_type','error');
			}
		}
		return;
	}
	
	public function please_wait(){
		$this->set('data',$this->Profile->find('first',array(
			'conditions'=>array(
				'Profile.enquiry_id'=>$this->Session->read('enquiry_id')
			),
			'fields'=>array(
				'Profile.teacher_notes'
			)
		)));
		return;
	}
	
	public function add_photo($enquiry_id=NULL){
		if (!empty($this->request->data)) {
			$result = $this->FileUploader->save_students_photo($this->request->data);
			if ($result===SUCCESS) {
				$temp = array(
					'CheckinPhoto'=>array(
						'enquiry_id'=>$this->request->data['CheckinPhoto']['enquiry_id'],
						'title'=>$this->request->data['CheckinPhoto']['title'],
						'description'=>$this->request->data['CheckinPhoto']['description'],
						'file_path'=>$this->request->data['CheckinPhoto']['application_form']['name'],
						'file_size'=>$this->request->data['CheckinPhoto']['application_form']['size']
					)
				);
				if ($this->CheckinPhoto->save($temp)) {
					$this->Session->setFlash('照片上传成功！');
					$this->set('msg_type','success');
				}else{
					$this->Session->setFlash('照片上传失败！');
					$this->set('msg_type','error');
				}
			}elseif ($result===WRONG_FILE_TYPE){
				$this->Session->setFlash('您选择的照片的格式不对！');
				$this->set('msg_type','error');
			}elseif ($result===FAILED){
				$this->Session->setFlash('您选择的上传路径不存在！');
				$this->set('msg_type','error');
			}else{
				$this->Session->setFlash('您选择的照片保存失败！');
				$this->set('msg_type','error');
			}
		}
		//先把学生已经上传的学生都找出来
			$this->CheckinPhoto->unbindModel(array('belongsTo'=>array('Enquiry')));
			$this->paginate['conditions'] = array(
				'CheckinPhoto.enquiry_id'=>$this->Session->read('enquiry_id')
			);
			$this->paginate['order']=array(
				'CheckinPhoto.id DESC'
			);
			$this->set('data',$this->paginate('CheckinPhoto'));
		return;
	}
	
	//Student's check in
	public function check_in(){
		if (empty($this->request->data)) {
			$d = $this->Checkin->find(
				'all',array(
					'conditions'=>array(
						'Checkin.enquiry_id'=>$this->Session->read('enquiry_id')
					),
					'order'=>array('Checkin.id DESC')
				)
			);
			$this->set('data',$d);
		}else{
			if ($this->Checkin->do_check_in($this->request->data)) {
				//check in succeed;
				$this->redirect(array('action'=>'add_photo'));
			}else{
				$this->Session->setFlash('无法Check-In，请稍候再试或优势办的管理老师');
				$this->set('msg_type','error');
			}
		}
		return;
	}

	public function list_checkins(){
		$this->paginate['conditions']=array('Checkin.enquiry_id'=>$this->Session->read('enquiry_id'));
		$this->set('data',$this->paginate('Checkin'));
		return;
	}
	
	public function return_request_form(){
		$this->loadModel('Applicant');
		//提取学生的回国登记的状态
			$temp = $this->Applicant->find('first',array('conditions'=>array('Applicant.enquiry_id'=>$this->Session->read('enquiry_id')))) ;
			$this->set('data',$temp);
		if (!empty($this->request->data)) {
			if ($this->Applicant->save($this->request->data)) {
				$this->Session->setFlash('回国登记保存成功！');
				$this->set('msg_type','success');;
			}else {
				$this->Session->setFlash('无法保存您的登记，请稍候再试或联系优势办的管理老师');
				$this->set('msg_type','error');
			}
		}
		return;
	}
}