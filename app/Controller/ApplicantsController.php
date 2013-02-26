<?php
require_once 'ApplicantEventListener.php'; //这个是专门监听和响应和applicant有关操作的消息的
class ApplicantsController extends AppController{
	public $uses = array('Applicant','Orgnization','JobStatus','VisaStatus',
					'Source','Project','Province','FeeType','DownloadFile',
					'Enquiry','Note','Tag','ApplicantItinerary','ApplyFeeStatus',
					'ContractStatus','ProjectFeeStatus','State','TrainingMethod',
					'Embassy','ProjectStatus','ReturnStatus');
	public $name = 'Applicants';

	public $paginate = array(
			'limit' => 20,
			'recursive' => 1,
			'order'=>array('Applicant.phase_id'=>'asc')
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
		if (in_array(
			$this->action, 
			array('add','phase_visa_confirmed','phase_oversea_confirmed','phase_settle_confirmed',
				 'return_to_phase_apply','phase_before_leaving_confirmed','ajax_save_app_return'))
		) {
			$listener = new ApplicantEventListener();
			$this->Applicant->getEventManager()->attach($listener);
		}
		$this->set('current_menu','Applicants');
	}
	
	public function beforeRender(){
		$this->set('controller_name',$this->name);
		$this->set('action_name',$this->action);
		$this->set('is_applicant',1);
		//给搜索表单用的
		if (in_array($this->action, 
				array(
					'list_all_in_phase_apply','list_all_in_phase_visa_prepair','list_all_in_phase_settle',
					'list_all_in_phase_visa','list_all_in_phase_before_leaving','list_all_in_phase_oversea',
					'list_all_in_phase_return','list_all_by_160','modify'
				)
			)
		) {
			//$this->loadModel('Phase','Model');
			//$this->set('local_phases',$this->Phase->find('list'));
			$this->set('local_phases',$this->cached_data['phases']);
			$this->set('orgnizations',$this->Orgnization->find('list'
				,array(
					'conditions'=>array('Orgnization.project_id'=>$this->Session->read('my_project'))
				)
			));
			$this->init_auto_complete_data();
			$this->set('by_group_id',$this->Session->read('my_group'));
		}
	}
	
	/**
	 * 这个方法将前台提交的特殊格式写的表单自动保存到数据库中
	 * Enter description here ...
	 */
	private function _save_app_ajax_way(){
		$this->Applicant->id = $this->request->data['applicant_id'];
		$bean=array('Applicant');
		foreach ($this->request->data as $key=>$value) {
			$bean['Applicant'][$key]=$value;
		}
		if ($this->Applicant->save($bean)) {
			return 1;
		}else{
			return 0;
		}
	}
	/**
	 * 申请人申请资料和状态信息的保存
	 */
	public function ajax_save_progress(){
		if ($this->request->is('ajax')) {
			$this->set('data',$this->_save_app_ajax_way());
			$this->render('ajax_save_family','ajax');
		}
		return;
	}
	/**
	 * 保存归国阶段的数据
	 */
	public function ajax_save_app_return(){
		if ($this->request->is('ajax')) {
			//下面是固定的操作
			$result = $this->_save_app_ajax_way();
			$this->set('data',$result);
			if ($this->request->data['return_status_id']==3 && $result==1) {
				//学生提交的回国登记被审核通过，则自动的切换学生的状态到归国阶段
				if ($this->Applicant->field('phase_id') == PHASE_OVERSEA) {
					//$this->Applicant->saveField('phase_id',PHASE_RETURN);
					$this->Applicant->confirm_phase_return($this->request->data['applicant_id'],$this->Auth->user());
				}
			}
			$this->render('ajax_save_family','ajax');
		}
		return;
	}
	
	public function ajax_save_family(){
		if ($this->request->is('ajax')) {
			$this->set('data',$this->_save_app_ajax_way());
			$this->render('ajax_save_family','ajax');
		}
		return;
	}

	/**
	 * show operation department statistic for admin
	 */
	public function load_statistic_admin(){
		$this->set('data',$this->load_statistic());
		$this->set('current_menu','Statistics');
		$this->paginate['conditions']=array(
			'and'=>array(
				'Note.user_id'=>$this->Auth->user('id'),
				'Note.is_deleted=0'
			)
		);
		$this->set('my_notes',$this->paginate('Note'));
		return;
	}
	/**
	 * 给运营部人员看的统计报告
	 */
	public function load_statistic_operator(){
		//$this->set('data',$this->load_statistic($this->Session->read('my_group')));
		$this->set('data',$this->_load_statistic_by_group($this->Session->read('my_group'),$this->Session->read('my_project')));
		$this->set('to_do_next_week',$this->load_to_do_next_week());
		//$this->set('pendings',$this->load_pendings());
		$this->set('pendings',array());
		
		$this->paginate['order']=array('Note.modified');
		$this->paginate['conditions']=array(
			'and'=>array(
				'Note.is_deleted=0',
				'Note.user_id'=>$this->Auth->user('id')
			)
		);
		$this->set('my_notes',$this->paginate('Note'));
		return;
	}
	
	private function _load_statistic_by_group($group_id,$project_id){
		$d = array();
		$d['total_enquiry']=$this->Enquiry->total_enquiry($group_id,$project_id);
		$d['total_app_form_submitted']=$this->Enquiry->total_app_form_submitted($group_id,$project_id);
		$d['total_slep_attend']=$this->Enquiry->total_slep_attend($group_id,$project_id);
		$d['total_slep_not_attend']=$this->Enquiry->total_slep_attend($group_id,$project_id,TRUE,FALSE);
		$d['total_slep_pass']=$this->Enquiry->total_slep_pass($group_id,$project_id);
		$d['total_slep_not_pass']=$this->Enquiry->total_slep_pass($group_id,$project_id,TRUE,FALSE);
		$d['total_enquiry_is_app']=$this->Enquiry->total_enquiry_is_app($group_id,$project_id);
		$d['app_data_not_done']=$this->Applicant->app_data_not_done($group_id,$project_id);
		$d['visa_data_done']=$this->Applicant->visa_data_done($group_id,$project_id);
		$d['visa_data_not_done']=$this->Applicant->visa_data_done($group_id,$project_id,TRUE,FALSE);
		$d['in_phase_settle']=$this->Applicant->been_phase($group_id,$project_id,PHASE_SETTLE);
		$d['done_160']=$this->Applicant->done_160($group_id,$project_id);
		$d['waiting_for_visa_appointment']=$this->Applicant->waiting_for_visa_appointment($group_id,$project_id);
		$d['has_visa_training_date']=$this->Applicant->has_visa_training_date($group_id,$project_id);
		$d['has_visa_appointment_date']=$this->Applicant->has_visa_appointment_date($group_id,$project_id);
		$d['get_visa']=$this->Applicant->get_visa($group_id,$project_id);
		$d['has_before_leaving_training_date']=$this->Applicant->has_before_leaving_training_date($group_id,$project_id);
		$d['in_phase_oversea']=$this->Applicant->been_phase($group_id,$project_id,PHASE_OVERSEA);
		$d['in_phase_return']=$this->Applicant->been_phase($group_id,$project_id,PHASE_RETURN);
		$d['get_cancelled']=$this->Applicant->get_cancelled($group_id,$project_id,PHASE_RETURN);
		return $d;
	}
	
	public function show($name=NULL,$view=NULL){
		$d = $this->Applicant->$name($this->Session->read('my_group'),$this->Session->read('my_project'),FALSE);
		$this->set('data',$d);
		$this->set('no_pagi',1);
		//$this->_set_common_variables();
		$this->render($view);
		return;
	}

	private function load_pendings(){
		return array();
	}
	
	private function load_to_do_next_week(){
		$one_week_later  = mktime(0, 0, 0, date("m")  , date("d")+7, date("Y"));
		$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
		
		return $this->Applicant->find('all',array(
			'conditions'=>array(
				'AND'=>array(
					'Applicant.group_id'=>$this->Session->read('my_group'),
					'Applicant.departure_date>'.date('Y-m-d',$yesterday),
					'Applicant.departure_date<'.date('Y-m-d',$one_week_later),
					'Applicant.status=0'
				) 
			),
			'recursive'=>1
		));
	}
	
	private function load_statistic($group_id=null){
		$this->Project->unbindModel(array('hasMany'=>array('Task','Enquiry','Applicant','DownloadFile')));
		//$this->paginate['order']=array('order'=>array('Applicant.modify desc','Applicant.name'));
		//$this->paginate['recursive']=-1;
		$result = array();
		$result['total_registions'] = $this->Project->find('all',array(
			'fields'=>array(
				'Project.name',
				'Project.id',
				//'Task.target','Task.deadline',
				'COUNT(DISTINCT Enquiry1.id) as total_registions'
			),
			'group'=>array('Project.id'),
			'recursive'=>-1,
			'joins'=>array(
				array(
					'table'=>'enquiries',
					'alias' => 'Enquiry1',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Enquiry1.project_id = Project.id',
							'Enquiry1.status'=>NORMAL,
							(!is_null($group_id)?'Enquiry1.group_id='.$group_id:NULL)
						) 
					)
				)
			)
		));
		$result['total_examed'] = $this->Project->find('all',array(
			'fields'=>array(
				'Project.name',
				'Project.id',
				//'Task.target','Task.deadline',
				'COUNT(DISTINCT Enquiry2.id) as total_examed',
			),
			'group'=>array('Project.id'),
			'recursive'=>-1,
			'joins'=>array(
				array(
					'table'=>'enquiries',
					'alias' => 'Enquiry2',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Enquiry2.project_id = Project.id',
							'Enquiry2.slep_scores>=0', //表示来考试了
							'Enquiry2.status'=>NORMAL,
							(!is_null($group_id)?'Enquiry2.group_id='.$group_id:NULL)
						) 
					)
				)
			)
		));
		$result['total_pass'] = $this->Project->find('all',array(
			'fields'=>array(
				'Project.name',
				'Project.id',
				//'Task.target','Task.deadline',
				'COUNT(DISTINCT Enquiry3.id) as total_pass',
			),
			'group'=>array('Project.id'),
			'recursive'=>-1,
			'joins'=>array(
				array(
					'table'=>'enquiries',
					'alias' => 'Enquiry3',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Enquiry3.project_id = Project.id',
							'Enquiry3.slep_scores>=45', //表示考试通过
							'Enquiry3.status'=>NORMAL,
							(!is_null($group_id)?'Enquiry3.group_id='.$group_id:NULL)
						) 
					)
				)
			)
		));
		$result['total_applicants'] = $this->Project->find('all',array(
			'fields'=>array(
				'Project.name',
				'Project.id',
				//'Task.target','Task.deadline',
				'COUNT(DISTINCT Applicant1.id) as total_applicants',
			),
			'group'=>array('Project.id'),
			'recursive'=>-1,
			'joins'=>array(
				array(
					'table'=>'applicants',
					'alias' => 'Applicant1',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Applicant1.project_id = Project.id',
							'Applicant1.status=0',
							(!is_null($group_id)?'Applicant1.group_id='.$group_id:NULL)
						) 
					)
				),
			)
		));
		$result['total_visa_data_done'] = $this->Project->find('all',array(
			'fields'=>array(
				'Project.name',
				'Project.id',
				//'Task.target','Task.deadline',
				'COUNT(DISTINCT Applicant2.id) as total_visa_data_done',
			),
			'group'=>array('Project.id'),
			'recursive'=>-1,
			'joins'=>array(
				array(
					'table'=>'applicants',
					'alias' => 'Applicant2',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Applicant2.project_id = Project.id',
							'Applicant2.status'=>NORMAL,
							'Applicant2.visa_data=1',  //签证资料已经准备齐全
							(!is_null($group_id)?'Applicant2.group_id='.$group_id:NULL)
						) 
					)
				),
			)
		));
		$result['total_app_data_done'] = $this->Project->find('all',array(
			'fields'=>array(
				'Project.name',
				'Project.id',
				//'Task.target','Task.deadline',
				'COUNT(DISTINCT Applicant5.id) as total_app_data_done',
			),
			'group'=>array('Project.id'),
			'recursive'=>-1,
			'joins'=>array(
				array(
					'table'=>'applicants',
					'alias' => 'Applicant5',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Applicant5.project_id = Project.id',
							'Applicant5.status=0',
							'Applicant5.application_data=1',  //表示申请资料已经完整了
							(!is_null($group_id)?'Applicant5.group_id='.$group_id:NULL)
						) 
					)
				),
			)
		));
		$result['total_project_data_done'] = $this->Project->find('all',array(
			'fields'=>array(
				'Project.name',
				'Project.id',
				//'Task.target','Task.deadline',
				'COUNT(DISTINCT Applicant6.id) as total_project_data_done',
			),
			'group'=>array('Project.id'),
			'recursive'=>-1,
			'joins'=>array(
				array(
					'table'=>'applicants',
					'alias' => 'Applicant6',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Applicant6.project_id = Project.id',
							'Applicant6.status=0',
							'Applicant6.project_data=1',  //表示安置材料准备完成
							(!is_null($group_id)?'Applicant6.group_id='.$group_id:NULL)
						) 
					)
				),
			)
		));
		$result['total_get_visa'] = $this->Project->find('all',array(
			'fields'=>array(
				'Project.name',
				'Project.id',
				//'Task.target','Task.deadline',
				'COUNT(DISTINCT Applicant7.id) as total_get_visa'
			),
			'group'=>array('Project.id'),
			'recursive'=>-1,
			'joins'=>array(
				array(
					'table'=>'applicants',
					'alias' => 'Applicant7',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Applicant7.project_id = Project.id',
							'Applicant7.status=0',
							'Applicant7.visa_status=3',  //表示签证通过,3是因为visa status表中的id值
							(!is_null($group_id)?'Applicant7.group_id='.$group_id:NULL)
						) 
					)
				),
			)
		));
		$result['total_oversea'] = $this->Project->find('all',array(
			'fields'=>array(
				'Project.name',
				'Project.id',
				//'Task.target','Task.deadline',
				'COUNT(DISTINCT Applicant8.id) as total_oversea'
			),
			'group'=>array('Project.id'),
			'recursive'=>-1,
			'joins'=>array(
				array(
					'table'=>'applicants',
					'alias' => 'Applicant8',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Applicant8.project_id = Project.id',
							'Applicant8.status=0',
							'Applicant8.phase_id'=>PHASE_OVERSEA,  //表示签证通过
							(!is_null($group_id)?'Applicant8.group_id='.$group_id:NULL)
						) 
					)
				),
			)
		));
		$result['total_return'] = $this->Project->find('all',array(
			'fields'=>array(
				'Project.name',
				'Project.id',
				//'Task.target','Task.deadline',
				'COUNT(DISTINCT Applicant9.id) as total_return',
			),
			'group'=>array('Project.id'),
			'recursive'=>-1,
			'joins'=>array(
				array(
					'table'=>'applicants',
					'alias' => 'Applicant9',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Applicant9.project_id = Project.id',
							'Applicant9.status=0',
							'Applicant9.phase_id'=>PHASE_RETURN,  //表示签证通过
							(!is_null($group_id)?'Applicant9.group_id='.$group_id:NULL)
						) 
					)
				)
			)
		));
		$result['total_before_leaving'] = $this->Project->find('all',array(
			'fields'=>array(
				'Project.name',
				'Project.id',
				//'Task.target','Task.deadline',
				'COUNT(DISTINCT Applicant10.id) as total_before_leaving'
			),
			'group'=>array('Project.id'),
			'recursive'=>-1,
			'joins'=>array(
				array(
					'table'=>'applicants',
					'alias' => 'Applicant10',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Applicant10.project_id = Project.id',
							'Applicant10.status=0',
							'Applicant10.phase_id'=>PHASE_BEFORE_LEAVING,  //表示签证通过
							(!is_null($group_id)?'Applicant10.group_id='.$group_id:NULL)
						) 
					)
				)
			)
		));
		$result['projects']=$this->Project->find('list');
		/*
		$this->Project->find('all',array(
			'fields'=>array(
				'Project.name',
				'Project.id',
				'Task.target','Task.deadline'
			),
			'group'=>array('Project.id'),
			'recursive'=>-1,
			'joins'=>array(
				
				,array(
					'table'=>'tasks',
					'alias' => 'Task',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Task.project_id = Project.id',
							(!is_null($group_id)?'Task.group_id='.$group_id:NULL)
						) 
					)
				)
				
			)
		));
		*/
		return $result;
	}
	
	/**
	 * 通过enq id的值找到applicant id的值
	 * @param Integer $enq_id
	 */
	public function modify_by_enquiry_id($enq_id = NULL){
		$bean = $this->Applicant->find('first',array('conditions'=>array('Applicant.enquiry_id'=>$enq_id),'fields'=>array('Applicant.id')));
		$this->redirect(array('action'=>'modify',$bean['Applicant']['id']));
	}
	
	public function modify($app_id = NULL, $phase_id = NULL,$msg_type=NULL){
		if ($msg_type) {
			//将传递过来的消息发到页面上，其中老师上传学生的job offer时会用到
			$this->set('msg_type',$msg_type);
		}
		if (empty($this->request->data)) {
			$this->Applicant->id = $app_id;
			$this->Applicant->unbindModel(array('belongsTo'=>array('User')));
			$applicant = $this->Applicant->read();
			$this->set('data',$applicant);
			$this->set('itinerary',$applicant);

			$this->loadModel('Customer','Model');
			$this->set('customers',$this->Customer->find('list',array(
				'conditions'=>array(
					'Customer.group_id'=>$this->Session->read('my_group'),
					'Customer.available'=>1,
					//'Customer.customerType_id'=>1,
				)
			)));
			$this->loadModel('Presentation','Model');
			$this->set('presentations',$this->Presentation->find('list',array(
				'conditions'=>array(
					'Presentation.group_id'=>$this->Session->read('my_group'),
					'Presentation.available'=>1
				)
			)));
			
			//找出activate的信息和checkin的信息
			$this->Enquiry->unbindModel(array('hasMany'=>array('EnquiryFeedback')));
			$d_checkins = $this->Enquiry->find('first',array(
				'conditions'=>array('Enquiry.id'=>$applicant['Applicant']['enquiry_id']),
				'fields'=>array(
					'Profile.id','Profile.created','Profile.status','Profile.modified','Profile.is_updated_by_student','Profile.teacher_notes'
					)
				)
			);
			$this->set('d_oversea',$d_checkins);
			/*
			$this->set(
				'download_file',
				$this->DownloadFile->find('list',array(
					'conditions'=>array('DownloadFile.phase_id',PHASE_SETTLE))));
			*/	
			$fields = array(
				'DownloadFile.title',
				'DownloadFile.file_name',
				'DownloadFile.id',
				'DownloadFile.phase_id',
				'ApplicantFile.id',
				'ApplicantFile.is_passed',
				'ApplicantFile.is_readed',
				'ApplicantFile.file_name',
				'ApplicantFile.modified',
				'ApplicantFile.latest_comments'
			);
			$joins = array(
						array(
							'table'=>'applicant_files',
							'alias' => 'ApplicantFile',
							'type' => 'LEFT',
							'conditions'=>array(
								'AND'=>array(
										'DownloadFile.id = ApplicantFile.download_file_id',
										'ApplicantFile.applicant_id'=>$app_id
									)
							)
					)
			);
			
			$d = $this->DownloadFile->find('all',array(
						'joins'=>$joins,
						'conditions'=>array(
								'and'=>array(
									'DownloadFile.phase_id'=>PHASE_APPLY,
									'DownloadFile.project_id'=>$applicant['Applicant']['project_id'],
									'DownloadFile.is_deleted'=>0, //只能看到没有删除的
									'DownloadFile.available'=>1 //只能看到已经发布的
								) 
							),
						'fields'=>$fields
					));
			$this->set('applicants_data',$d);
			//
			$d_settle = $this->DownloadFile->find('all',array(
						'joins'=>$joins,
						'conditions'=>array(
							'and'=>array(
								'DownloadFile.phase_id'=>PHASE_SETTLE,
								'DownloadFile.project_id'=>$applicant['Applicant']['project_id'],
								'DownloadFile.is_deleted'=>0, //只能看到没有删除的
								'DownloadFile.available'=>1 //只能看到已经发布的
							)
						),
						'fields'=>$fields
			));
			$this->set('applicants_settle_data',$d_settle);
			//
			$d_visa = $this->DownloadFile->find('all',array(
						'joins'=>$joins,
						'conditions'=>array(
							'and'=>array(	
								'DownloadFile.phase_id'=>PHASE_VISA,
								'DownloadFile.project_id'=>$applicant['Applicant']['project_id'],
								'DownloadFile.is_deleted'=>0, //只能看到没有删除的
								'DownloadFile.available'=>1 //只能看到已经发布的
							)			
						),
						'fields'=>$fields
			));
			$this->set('applicants_visa_data',$d_visa);
			//
			$d_before_leaving = $this->DownloadFile->find('all',array(
						'joins'=>$joins,
						'conditions'=>array(
							'and'=>array(
								'DownloadFile.phase_id'=>PHASE_BEFORE_LEAVING,
								'DownloadFile.project_id'=>$applicant['Applicant']['project_id'],
								'DownloadFile.is_deleted'=>0, //只能看到没有删除的
								'DownloadFile.available'=>1 //只能看到已经发布的
							)
						),
						'fields'=>$fields
			));
			$this->set('applicants_before_leaving_data',$d_before_leaving);
			//
			$d_return = $this->DownloadFile->find('all',array(
						'joins'=>$joins,
						'conditions'=>array(
							'and'=>array(
								'DownloadFile.phase_id'=>PHASE_RETURN,
								'DownloadFile.project_id'=>$applicant['Applicant']['project_id'],
								'DownloadFile.is_deleted'=>0, //只能看到没有删除的
								'DownloadFile.available'=>1 //只能看到已经发布的
							)
						),
						'fields'=>$fields
			));
			$this->set('applicants_return_data',$d_return);
			$this->set('phase_id',$phase_id);
			
			//学生上传的照片
			$this->loadModel('CheckinPhoto');
			$this->CheckinPhoto->unbindModel(array('belongsTo'=>array('Enquiry')));
			$photos = $this->CheckinPhoto->find('all',array(
				'conditions'=>array(
					'CheckinPhoto.enquiry_id'=>$applicant['Applicant']['enquiry_id']
				),
				'order'=>array(
					'CheckinPhoto.id DESC'				
				)
			));
			$this->set('photos',$photos);
		}else{
			if ($this->Applicant->save($this->request->data)) {
				$this->Session->setFlash('报名学生申请记录更新成功!');
				$this->redirect(array('action'=>'list_all','success'));
			}else{
				$this->set('msg_type','error');
				$this->Session->setFlash('无法更新报名学生申请记录, 请稍候再试!');
			}
		}
		return;
	}
	
	public function add($enquiry_id = null){
		if (!is_null($enquiry_id)) {
			//把整个user数组传过去，作为邮件中发件人的信息来源
			$rich_msg = $this->Applicant->confirm_applicant($enquiry_id,$this->Auth->user());
			if ($rich_msg['result']) {
				$this->Session->setFlash('报名学生申请记录添加成功!');
				$this->redirect(array('action'=>'list_all_in_phase_apply','success'));
			}else{
				$this->set('msg_type','error');
				$this->Session->setFlash('无法添加报名学生申请记录, 请稍候再试!');
				$this->redirect(array('controller'=>'Enquiries', 'action'=>'list_all_for_operator','error'));
			}
		}
		return;
	}
	
	/**
	 * Save the search query fields in DB or retrieve one from DB
	 * @param Integer $search_url_id
	 * @param array $bean  :holding the query fields
	 */
	private function _handle_search_url($search_url_id, $bean){
		$result = NULL;
		if ($search_url_id) {
			//不为空，表示来自pagination
			$this->loadModel('SearchUrl');
			$this->SearchUrl->id = $search_url_id;
			if ($this->SearchUrl->exists()) {
				$result = array();
				$get_query_str = $this->SearchUrl->field('link');
				parse_str($get_query_str,$result);
			}
		}else{
			//为空，表示来自form的search按钮，这个是有要先生成一个search_url的记录
			//首先把POST的数据转换成GET的字符串
			//$bean = $this->request->data['Enquiry'];
			$get_query_str = http_build_query( $bean );
			if (strlen($get_query_str) > 0) {
				$temp_bean = array();
				$temp_bean['SearchUrl'] = array('link'=>$get_query_str);
				$this->loadModel('SearchUrl');
				$this->SearchUrl->save($temp_bean);
				$result = $this->SearchUrl->id;
			}
		}
		return $result;
	}
	
	/**
	 * 专门用来根据给定的参数，构造数据库查询条件数组的私有方法
	 * @param Array $params
	 * @return Ambigous <multitype:multitype:string  , unknown>
	 */
	private function _get_search_options($params = NULL){
		$options = array();
		$school = $params['school'];
		$name = $params['name'];
		$mobile = $params['mobile'];
		$options['AND'] = array(
				'Enquiry.school LIKE'=>"%$school%",
				'Enquiry.name LIKE'=>"%$name%",
				'Enquiry.mobile LIKE'=>"%$mobile%"
		);
		if (isset($params['is_applicant'])) {
			$options['AND']['Enquiry.is_applicant']=$params['is_applicant'];
		}
		if (isset($params['group_id'])) {
			$options['AND']['Enquiry.group_id']=$params['group_id'];
		}
		if (isset($params['project_id'])) {
			$options['AND']['Enquiry.project_id']=$params['project_id'];
		}
		if (isset($params['task_id'])) {
			$options['AND']['Enquiry.task_id']=$params['task_id'];
		}
		if ($this->Session->read('my_group')>0) {
			//不是管理员，要加入限制group的条件
			$options['AND']['Enquiry.group_id']=$this->Session->read('my_group');
		}
		return $options;
	}
	
	private function _get_search_joins(){
		return array(
				array(
						'table'=>'applicants',
						'alias' => 'Applicant',
						'type' => 'RIGHT',
						'conditions'=>array(
							'Enquiry.id = Applicant.enquiry_id'
						)
					),
				array(
						'table'=>'orgnizations',
						'alias' => 'Orgnization',
						'type' => 'LEFT',
						'conditions'=>array(
								'Orgnization.id = Applicant.orgnization_id'
						)
					),
				array(
						'table'=>'job_status',
						'alias' => 'JobStatus',
						'type' => 'LEFT',
						'conditions'=>array(
								'JobStatus.id = Applicant.job_status'
						)
					),
				array(
						'table'=>'visa_status',
						'alias' => 'VisaStatus',
						'type' => 'LEFT',
						'conditions'=>array(
								'VisaStatus.id = Applicant.visa_status'
						)
					),
				array(
						'table'=>'projects',
						'alias' => 'Project',
						'type' => 'LEFT',
						'conditions'=>array(
								'Project.id = Applicant.project_id'
						)
					),
				array(
						'table'=>'phases',
						'alias' => 'Phase',
						'type' => 'LEFT',
						'conditions'=>array(
								'Phase.id = Applicant.phase_id'
						)
					)
		);
	}
	
	private function _get_search_fields(){
		return array(
				'Enquiry.id','Enquiry.name','Enquiry.school','Enquiry.email','Enquiry.mobile',
				'Orgnization.name',
				'JobStatus.name',
				'VisaStatus.name',
				'Applicant.slep',
				'Applicant.apply_fee',
				'Applicant.project_fee',
				'Applicant.sign_date',
				'Applicant.application_data',
				'Applicant.project_data',
				'Applicant.visa_data',
				'Applicant.visa_signed_date',
				'Applicant.departure_date',
				'Applicant.id'
				);
	}
	
	/**
	 * 根据搜索的查询条件数组，向搜索表单设置不同的参数，代表下次的查询
	 * @param Array $param
	 */
	private function _set_search_keys($params){
		if (isset($params['AND']['Enquiry.is_applicant'])) {
			$this->set('is_applicant',$params['AND']['Enquiry.is_applicant']);
		}
		if ($this->Session->read('my_group')>0) {
			$this->set('by_group_id',$this->Session->read('my_group'));
		}else{
			if (isset($params['AND']['Enquiry.group_id'])) {
				$this->set('by_group_id',$params['AND']['Enquiry.group_id']);;
			}
		}
		if (isset($params['AND']['Enquiry.project_id'])) {
			$this->set('by_project_id',$params['AND']['Enquiry.project_id']);
		}
		if (isset($params['AND']['Enquiry.task_id'])) {
			$this->set('by_task_id',$params['AND']['Enquiry.task_id']);
		}
	
		return;
	}
	
	public function search_old($search_url_id = NULL){
		if (empty($this->request->data)) {
			$result = $this->_handle_search_url($search_url_id,NULL);
		}else{
			$result = $this->_handle_search_url($search_url_id,$this->request->data['Enquiry']);
		}
		
		$options = null;
		if(is_array($result)){
			//表示来自pagination
			$options = $this->_get_search_options($result);
			$query_id = $search_url_id;
		}else{
			//the search button was clicked first time
			$options = $this->_get_search_options($this->request->data['Enquiry']);
			$query_id = $result;
		}
		
		//根据上传的数据来创建paginate的conditions
		$this->paginate['conditions'] = array($options);
		
		$this->paginate['joins'] = $this->_get_search_joins();
		$this->paginate['fields'] = $this->_get_search_fields();
		$this->Enquiry->unbindModel(array('belongsTo'=>array('Group','Project'),'hasMany'=>array('EnquiryFeedback')));
		$this->set('data',$this->paginate('Enquiry'));
		
		//用来在产生的paginator上生成第一个代表search_url表中记录的id
		$this->set('query_id',$query_id);
		//向搜索表单中中设置hidden的参数
		$this->_set_search_keys($options);
		
		$this->render('list_all');
		return;
	}
	
	/**
	 * 管理员用来按project查看申请表的方法
	 * @param Integer $project_id
	 */
	public function load_by_project($project_id = null){
		$this->Enquiry->unbindModel(array('belongsTo'=>array('Group','Project','Phase'),'hasMany'=>array('EnquiryFeedback')));
		$this->paginate['conditions'] = array(
				'AND'=>array(
						'Enquiry.project_id'=>$project_id,
						'Enquiry.is_applicant'=>1,
						($this->Session->read('my_group')>0)?('Enquiry.group_id='.$this->Session->read('my_group')):NULL //不是管理员，则按组查询
				)
		);
		$this->paginate['joins'] = $this->_get_search_joins();
		$this->paginate['fields'] = array(
				'Enquiry.id','Enquiry.name','Enquiry.school','Enquiry.email','Enquiry.mobile',
				'Orgnization.name',
				'JobStatus.name',
				'VisaStatus.name',
				'Applicant.application_data',
				'Applicant.project_data',
				'Applicant.visa_data',
				'Applicant.id',
				'Project.name',
				'Phase.name'
		);
		$this->paginate['recursive']=-1;
		
		$this->set('data',$this->paginate('Enquiry'));
		if ($project_id) {
			$this->set('by_project_id',$project_id);
		}
		$this->render('load_by_project_admin');
		return;
	}
	
	/**
	 * 管理员用来按task查看申请表的方法
	 * @param Integer $tast_id
	 */
	public function load_by_task($task_id = null){
		$this->paginate['conditions'] = array(
				'AND'=>array(
						'Enquiry.task_id'=>$task_id,
						'Enquiry.is_applicant'=>1
				)
		);
		$this->paginate['joins'] = $this->_get_search_joins();
		$this->paginate['fields'] = array(
				'Enquiry.id','Enquiry.name','Enquiry.school','Enquiry.email','Enquiry.mobile',
				'Orgnization.name',
				'JobStatus.name',
				'VisaStatus.name',
				'Applicant.application_data',
				'Applicant.project_data',
				'Applicant.visa_data',
				'Applicant.id',
				'Project.name',
				'Phase.name'
		);
		$this->Enquiry->unbindModel(array('belongsTo'=>array('Group','Project'),'hasMany'=>array('EnquiryFeedback')));
		$this->paginate['recursive']=-1;
		$this->set('data',$this->paginate('Enquiry'));
		$this->set('by_task_id',$task_id);
		
		$this->render('load_by_project_admin');
		return;
	}
	
	/**
	 * 列出所有处于安置状态的申请人
	 */
	public function list_all_in_phase_settle($msg_type=NULL,$to_excel=0,$current_query_id=NULL){
		//取消无用的bind
		$this->Applicant->unbindModel(
			array(
			'belongsTo'=>array(
				'VisaStatus','Source'
				),
			'hasOne'=>array('ApplicantVisa')	
			)
		);
		$this->paginate['recursive']=1;
		$fields = array(
			'Applicant.id','Applicant.application_data','Applicant.project_data','Applicant.job_offer_upload_oversea_status',
			'Applicant.status','Enquiry.id','Enquiry.school','Enquiry.name','Enquiry.mobile','Enquiry.email','Enquiry.contract_id',
			'Project.id','Project.name','Orgnization.name','JobStatus.name','Phase.name','Phase.id',
			'ApplicantJob.company_name','ApplicantJob.state_id','ApplicantJob.city_name',
			'ApplicantJob.street_name','ApplicantJob.employer_name','ApplicantJob.job_title',
			'ApplicantJob.interview','ApplicantJob.provide_accom','ApplicantJob.start_from','ApplicantJob.end_by','ApplicantJob.hf_status'
			,'ApplicantJob.hf_issue_date','ApplicantJob.family_city_name','User.name'
		);
		$conditions = array(
			'AND'=>array(
				'Applicant.project_id'=>$this->Session->read('my_project'),
				'Applicant.user_id'=>$this->Auth->user('id'),
				'Applicant.phase_id>='.PHASE_SETTLE
			) 
		);
		if (!empty($this->request->data)) {
			$this->add_search_options(&$conditions,$fields);
			$this->set('no_pagi',1);
		}else{
			if ($current_query_id) {
				$arr = $this->parse_query_id($current_query_id);
				$fields = $arr['fields'];
				$conditions = $arr['conditions'];
			}
		}
		
		//Get app info and remove useless app files 
		$d = $this->_do_query($to_excel, $fields, $conditions);
		$this->set('data',$d );

		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);
		}
		//加入本组的学生的雇主姓名和雇主地址列表，给自动补全用
		$this->loadModel('ApplicantJob');	
		$employees = $this->ApplicantJob->find('all',array(
				'conditions'=>array(
					'ApplicantJob.group_id'=>$this->Session->read('my_group')
				),
				'fields'=>array('ApplicantJob.company_name','ApplicantJob.employer_address'),
				'recursive'=>-1
			));
		$this->set('employees',$employees);
		
		if($to_excel==0){
			$render_view = $this->Session->read('my_project').DS.$this->action;
		}else{
			$render_view = $this->Session->read('my_project').DS.'to_excel';
		}
		$this->render($render_view);
		return;
	}
	
	public function return_to_phase_apply($app_id = NULL){
		if ($app_id) {
			$this->Applicant->id = $app_id;
			if ($this->Applicant->exists()) {
				if($this->Applicant->return_to_phase_apply($app_id,$this->Auth->user())){
					$this->Session->setFlash('更新成功，该用户已经处于申请状态。');
					$this->redirect(array('action'=>'list_all_in_phase_apply','success'));
				}else{
					$this->Session->setFlash('更新失败，请稍候再试，或者联系管理员。');
					$this->redirect(array('action'=>'list_all_in_phase_settle','error'));
				}
			}else{
				$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
				$this->redirect(array('action'=>'list_all_in_phase_settle','error'));
			}
		}else{
			$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
			$this->redirect(array('action'=>'list_all_in_phase_settle','error'));
		}
		return;
	}
	
	public function return_to_phase_settle($app_id = NULL){
		if ($app_id) {
			$this->Applicant->id = $app_id;
			if ($this->Applicant->exists()) {
				if($this->Applicant->return_to_phase_settle($app_id,$this->Auth->user())){
					$this->Session->setFlash('更新成功，该用户已经处于申请状态。');
					$this->redirect(array('action'=>'list_all_in_phase_settle','success'));
				}else{
					$this->Session->setFlash('更新失败，请稍候再试，或者联系管理员。');
					$this->redirect(array('action'=>'list_all_in_phase_visa','error'));
				}
			}else{
				$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
				$this->redirect(array('action'=>'list_all_in_phase_visa','error'));
			}
		}else{
			$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
			$this->redirect(array('action'=>'list_all_in_phase_visa','error'));
		}
		return;
	}
	
	/**
	 * 用来确认一个申请人已经进入安置阶段的方法
	 * @param Integer $app_id
	 */
	public function phase_settle_confirmed($app_id = NULL){
		if ($app_id) {
			$this->Applicant->id = $app_id;
			if ($this->Applicant->exists()) {
				$rich_msg = $this->Applicant->change_to_phase_settle($app_id,$this->Auth->user());
				if($rich_msg['result']){
					$this->Session->setFlash('更新成功，该用户已经处于安置状态。');
					$this->redirect(array('action'=>'list_all_in_phase_settle','success'));
				}else{
					$this->Session->setFlash('更新失败，请稍候再试，或者联系管理员。');
					$this->redirect(array('action'=>'list_all_in_phase_apply','error'));
				}
			}else{
				$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
				$this->redirect(array('action'=>'list_all_in_phase_apply','error'));
			}
		}else{
			$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
			$this->redirect(array('action'=>'list_all_in_phase_apply','error'));
		}
		return;
	}
	
	/**
	 * 用来确认一个在申请状态的客户，进入了签证阶段，由运营部的用户触发，通过appid
	 * @param Integer $app_id
	 */
	public function phase_visa_confirmed($app_id = NULL){
		if ($app_id) {
			$this->Applicant->id = $app_id;
			if ($this->Applicant->exists()) {
				$rich_msg = $this->Applicant->change_to_phase_visa($app_id,$this->Auth->user());
				if($rich_msg['result']){
					$this->Session->setFlash('更新成功，该用户已经处于签证状态。');
					$this->redirect(array('action'=>'list_all_in_phase_visa','success'));
				}else{
					$this->Session->setFlash('更新失败，请稍候再试，或者联系管理员。');
					$this->redirect(array('action'=>'list_all_in_phase_settle','error'));
				}
			}else{
				$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
				$this->redirect(array('action'=>'list_all_in_phase_settle','error'));
			}
		}else{
			$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
			$this->redirect(array('action'=>'list_all_in_phase_settle','error'));
		}
		return;
	}
	
	/**
	 * 用来确认一个在签证状态的客户，进入了行前阶段，由运营部的用户触发，通过appid
	 * @param Integer $app_id
	 */
	public function phase_before_leaving_confirmed($app_id = NULL){
		if ($app_id) {
			$this->Applicant->id = $app_id;
			if ($this->Applicant->exists()) {
				$rich_msg = $this->Applicant->change_to_phase_before_leaving($app_id,$this->Auth->user());
				if($rich_msg['result']){
					$this->Session->setFlash('更新成功，该用户已经处于行前状态。');
					$this->redirect(array('action'=>'list_all_in_phase_before_leaving','success'));
				}else{
					$this->Session->setFlash('更新失败，请稍候再试，或者联系管理员。');
					$this->redirect(array('action'=>'list_all_in_phase_visa','error'));
				}
			}else{
				$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
				$this->redirect(array('action'=>'list_all_in_phase_visa','error'));
			}
		}else{
			$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
			$this->redirect(array('action'=>'list_all_in_phase_visa','error'));
		}
		return;
	}
	
	/**
	 * 用来确认一个在签证状态的客户，进入了赴美阶段，由运营部的用户触发，通过appid
	 * @param Integer $app_id
	 */
	public function phase_oversea_confirmed($app_id){
		if ($app_id) {
			$this->Applicant->id = $app_id;
			if ($this->Applicant->exists()) {
				$rich_msg = $this->Applicant->change_to_phase_oversea($app_id,$this->Auth->user());
				if($rich_msg['result']){
					$this->Session->setFlash('更新成功，该用户已经处于赴美状态。');
					$this->redirect(array('action'=>'list_all_in_phase_oversea','success'));
				}else{
					$this->Session->setFlash('更新失败，请稍候再试，或者联系管理员。');
					$this->redirect(array('action'=>'list_all_in_phase_visa','error'));
				}
			}else{
				$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
				$this->redirect(array('action'=>'list_all_in_phase_visa','error'));
			}
		}else{
			$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
			$this->redirect(array('action'=>'list_all_in_phase_visa','error'));
		}
		return;
	}
	
	public function phase_return_confirmed($app_id){
		if ($app_id) {
			$this->Applicant->id = $app_id;
			if ($this->Applicant->exists()) {
				if($this->Applicant->saveField('phase_id',PHASE_RETURN)){
					$this->Session->setFlash('更新成功，该用户已经处于回国状态。');
					$this->redirect(array('action'=>'list_all_in_phase_return','success'));
				}else{
					$this->Session->setFlash('更新失败，请稍候再试，或者联系管理员。');
					$this->redirect(array('action'=>'list_all_in_phase_oversea','error'));
				}
			}else{
				$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
				$this->redirect(array('action'=>'list_all_in_phase_oversea','error'));
			}
		}else{
			$this->Session->setFlash('您正在操作的用户不存在，请重试或者联系管理员。');
			$this->redirect(array('action'=>'list_all_in_phase_oversea','error'));
		}
		return;
	}
	
	/**
	 * 列出所有在海外赴美阶段的申请人
	 * @param string $msg_type
	 */
	public function list_all_in_phase_oversea($msg_type = NULL,$to_excel=0,$current_query_id=NULL){
		$this->Applicant->unbindModel(
			array(
			'belongsTo'=>array(
				'JobStatus','VisaStatus','Enquiry','Orgnization','Project','Phase','User'
				),
			'hasOne'=>array('ApplicantVisa','ApplicantJob','ApplicantItinerary'),
			'hasMany'=>array('ApplicantFile')
			)
		);
		$this->paginate['recursive']=-1;
		$fields = array(
			'Applicant.id',
			'Enquiry.id','Enquiry.school','Enquiry.name','Enquiry.mobile','Enquiry.email','Enquiry.contract_id',
			'Project.id','Project.name','Phase.name','Phase.id','Orgnization.name',
			'ApplicantJob.company_name','ApplicantJob.state_id','ApplicantJob.city_name',
			'ApplicantJob.street_name','ApplicantJob.employer_name','ApplicantJob.job_title',
			'ApplicantJob.interview','ApplicantJob.provide_accom','ApplicantJob.start_from','ApplicantJob.end_by',
			'Profile.status','ApplicantJob.hf_family_name'
		);
		
		$joins = array(
			array(
				'table'=>'applicant_jobs',
				'alias'=>'ApplicantJob',
				'type'=>'left',
				'conditions'=>array(
					'Applicant.id=ApplicantJob.applicant_id'
				)
			),
			array(
				'table'=>'projects',
				'alias'=>'Project',
				'type'=>'left',
				'conditions'=>array(
					'Applicant.project_id=Project.id'
				)
			),
			array(
				'table'=>'orgnizations',
				'alias'=>'Orgnization',
				'type'=>'left',
				'conditions'=>array(
					'Applicant.orgnization_id=Orgnization.id'
				)
			),
			array(
				'table'=>'phases',
				'alias'=>'Phase',
				'type'=>'left',
				'conditions'=>array(
					'Applicant.phase_id=Phase.id'
				)
			),
			array(
				'table'=>'enquiries',
				'alias'=>'Enquiry',
				'type'=>'left',
				'conditions'=>array(
					'Applicant.enquiry_id=Enquiry.id'
				)
			),
			array(
				'table'=>'profiles',
				'alias'=>'Profile',
				'type'=>'left',
				'conditions'=>array(
					'Profile.enquiry_id=Enquiry.id'
				)
			)
		);
		$conditions = array(
			'AND'=>array(
				'Applicant.project_id'=>$this->Session->read('my_project'),
				'Applicant.user_id'=>$this->Auth->user('id'),
				'Applicant.phase_id>='.PHASE_OVERSEA,
				'Applicant.status'=>NORMAL
			) 
		);
		if (!empty($this->request->data)) {
			$this->add_search_options(&$conditions,$fields,$joins);//这里面包括根据搜索表单的输入，同时构造joins里面的profile的条件
			$this->set('no_pagi',1);
		}else{
			if ($current_query_id) {
				$arr = $this->parse_query_id($current_query_id);
				$fields = $arr['fields'];
				$conditions = $arr['conditions'];
			}
		}
		
		$d = $this->_do_query_join($to_excel, $fields, $conditions, $joins);
		
		$eids = '';
		for ($i = 0; $i < count($d); $i++) {
			if ($i < count($d)-1) {
				$eids .= $d[$i]['Enquiry']['id'].',';
			}else{
				$eids .= $d[$i]['Enquiry']['id'];
			}
		}
		//Get checkins
		$this->Enquiry->unbindModel(array(
			'belongsTo'=>array('Group','Project','Source','Presentation','Customer','ApplyFeeStatus','ContractStatus','ProjectFeeStatus'),
			'hasOne'=>array('Profile'),'hasMany'=>array('EnquiryFeedback')
		));
		//下面的查询是一个最简单结果，因为enquiry类中的hasmany已经预设了条件，并返回所需要的created
		if (strlen($eids)>0) {
			$checkins = $this->Enquiry->find('all',array(
				'conditions'=>array('Enquiry.id IN('.$eids.')'),
				'fields'=>array('Enquiry.id')
			));
		}
		
		for ($i = 0; $i < count($d); $i++) {
			if (isset($checkins[$i]['Checkin'][0])) {
				$d[$i]['Checkin']=array('latest_create'=>$checkins[$i]['Checkin'][0]['created']);
			}
		}
		
		$this->set('data',$d);
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);;
		}
		//$this->set('states',$this->State->find('list'));
		
		//加入本组的学生的雇主姓名和雇主地址列表，给自动补全用
		$this->loadModel('ApplicantJob');	
		$employees = $this->ApplicantJob->find('all',array(
				'conditions'=>array(
					'ApplicantJob.group_id'=>$this->Session->read('my_group')
				),
				'fields'=>array('ApplicantJob.company_name','ApplicantJob.employer_address'),
				'recursive'=>-1
			));
		$this->set('employees',$employees);
		if($to_excel==0){
			$render_view = $this->Session->read('my_project').DS.$this->action;
		}else{
			$render_view = $this->Session->read('my_project').DS.'to_excel';
		}
		$this->render($render_view);
		return;
	}
	
	/**
	 * 列出所有在签证阶段的申请人
	 * “签证阶段学生管理”的学生列表，包括所有 曾经或现在 处于签证阶段的学生
	 * （也包括所有拿到JOBoffer后退出的学生）。即包括所有“joboffer状态”是
	 * “已上传外方机构”的学生（鉴定标准）。
	 * @param string $msg_type
	 */
	public function list_all_in_phase_visa($msg_type = null,$to_excel=0,$current_query_id=NULL){
		$conditions = array(
			'AND'=>array(
				'Applicant.project_id'=>$this->Session->read('my_project'),
				'Applicant.user_id'=>$this->Auth->user('id'),
				//'Applicant.status'=>NORMAL,
				'Applicant.phase_id>='.PHASE_VISA
			) 
		);
		$this->Applicant->unbindModel(
			array(
			'belongsTo'=>array(
				'Source'
				),
			'hasOne'=>array('ApplicantJob')
			)
		);
		$this->paginate['recursive']=1;
		$fields = array(
			'Applicant.id','Applicant.visa_data','ApplicantVisa.visa_traing_date','Applicant.status',
			'Applicant.phase_id','ApplicantVisa.visa_appointment_date','ApplicantVisa.id',
			'ApplicantVisa.last_training_date','ApplicantVisa.embassy_address','ApplicantVisa.embassy_id',
			'ApplicantVisa.training_method_id','User.name',
			'ApplicantVisa.sevis','ApplicantVisa.ds2019','ApplicantVisa.form160',
			'Enquiry.id','Enquiry.school','Enquiry.name','Enquiry.mobile','Enquiry.email','Enquiry.contract_id',
			'Project.id','Project.name','Phase.name','Phase.id','Orgnization.name',
			'VisaStatus.name','Applicant.visa_status'
		);
		if (!empty($this->request->data)) {
			$this->add_search_options(&$conditions,$fields);
			$this->set('no_pagi',1);
		}else{
			if ($current_query_id) {
				$arr = $this->parse_query_id($current_query_id);
				$fields = $arr['fields'];
				$conditions = $arr['conditions'];
			}
		}
		
		$d = $this->_do_query($to_excel, $fields, $conditions);
		
		$length = count($d);
		for ($i = 0; $i < $length; $i++) {
			$this->_remove_useless_app_files(PHASE_VISA, $d[$i]['ApplicantFile']);
		}
		$this->set('data',$d);
		//Get total files needed for phase_apply
		$this->set('total_file_needed',$this->DownloadFile->find('list',
			array(
				'conditions'=>array(
					'and'=>array(
						'DownloadFile.phase_id'=>PHASE_VISA,
						'DownloadFile.project_id'=>$this->Session->read('my_project')	
					)
				)
			))
		);
		//给搜索表单用的
		//$this->set('visa_status',$this->VisaStatus->find('list'));
		//$this->set('embassys',$this->Embassy->find('list'));
		//$this->set('train_methods',$this->TrainingMethod->find('list'));
		
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);;
		}
		if($to_excel==0){
			$render_view = $this->Session->read('my_project').DS.$this->action;
		}else{
			$render_view = $this->Session->read('my_project').DS.'to_excel';
		}
		$this->render($render_view);
		return;
	}
	
/**
	 * 列出所有在归国阶段的申请人
	 * @param string $msg_type
	 */
	public function list_all_in_phase_return($msg_type = null,$to_excel=0,$current_query_id=NULL){
		$this->Applicant->unbindModel(
			array(
			'belongsTo'=>array(
				'JobStatus','VisaStatus'
				),
			'hasOne'=>array('ApplicantVisa','ApplicantJob')
			//'hasMany'=>array('ApplicantFile')
			)
		);
		$fields=array(
			'Applicant.id','Applicant.return_date','User.name',
			'Enquiry.id','Enquiry.school','Enquiry.name','Enquiry.mobile','Enquiry.email','Enquiry.contract_id',
			'Project.id','Project.name','Phase.name','Phase.id','Orgnization.name',
			'ProjectStatus.id','ProjectStatus.name','ReturnStatus.id','ReturnStatus.name'
		);
		
		$conditions = array(
			'AND'=>array(
				'Applicant.project_id'=>$this->Session->read('my_project'),
				'Applicant.user_id'=>$this->Auth->user('id'),
				'Applicant.status'=>NORMAL,
				'Applicant.phase_id'=>PHASE_RETURN
			) 
		);
		if (!empty($this->request->data)) {
			$this->add_search_options(&$conditions,$fields);
			$this->set('no_pagi',1);
		}else{
			if ($current_query_id) {
				$arr = $this->parse_query_id($current_query_id);
				$fields = $arr['fields'];
				$conditions = $arr['conditions'];
			}
		}
		
		$d = $this->_do_query($to_excel, $fields, $conditions);
		
		$length = count($d);
		for ($i = 0; $i < $length; $i++) {
			$this->_remove_useless_app_files(PHASE_RETURN, $d[$i]['ApplicantFile']);
		}
		
		$this->set('data',$d);
		//Get total files needed for phase_apply
		$this->set('total_file_needed',
		$this->DownloadFile->find('list',
			array(
				'conditions'=>array(
					'and'=>array(
						'DownloadFile.phase_id'=>PHASE_RETURN,
						'DownloadFile.project_id'=>$this->Session->read('my_project')	
					)
				))
			)
		);
		
		/* 和搜索表单相关的一些数据 */
		//$this->loadModel('ProjectStatus');
		//$this->set('project_status',$this->ProjectStatus->find('list'));
		//$this->loadModel('ReturnStatus');
		//$this->set('return_status',$this->ReturnStatus->find('list'));
		
		/*完成和表单相关的数据设定*/
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);;
		}
		if($to_excel==0){
			$render_view = $this->Session->read('my_project').DS.$this->action;
		}else{
			$render_view = $this->Session->read('my_project').DS.'to_excel';
		}
		$this->render($render_view);
		return;
	}
	
	/**
	 * 列出所有在赴美阶段的申请人
	 * @param string $msg_type
	 */
	public function list_all_in_phase_before_leaving($msg_type = null,$to_excel=0,$current_query_id=NULL){
		$conditions = array(
			'AND'=>array(
				'Applicant.project_id'=>$this->Session->read('my_project'),
				'Applicant.user_id'=>$this->Auth->user('id'),
				'Applicant.phase_id>='.PHASE_BEFORE_LEAVING
			) 
		);
		$this->Applicant->unbindModel(
			array(
				'belongsTo'=>array(
					'JobStatus','VisaStatus','Source'
				),
				'hasOne'=>array('ApplicantJob')
			)
		);
		$fields =array(
			'Applicant.id','Applicant.status',
			'ApplicantVisa.last_training_date','ApplicantVisa.visa_traing_date','ApplicantVisa.visa_appointment_date',
			'ApplicantVisa.last_training_date','ApplicantVisa.embassy_address','Applicant.visa_status','Applicant.usa_informed',
			'Enquiry.id','Enquiry.school','Enquiry.name','Enquiry.mobile','Enquiry.email','Enquiry.contract_id',
			'Project.id','Project.name','Phase.id','Phase.name','Orgnization.name','User.name',
			'ApplicantItinerary.air_port_pick_status'
		);
		if (!empty($this->request->data)) {
			$this->add_search_options(&$conditions,$fields);
			$this->set('no_pagi',1);
		}else{
			if ($current_query_id) {
				$arr = $this->parse_query_id($current_query_id);
				$fields = $arr['fields'];
				$conditions = $arr['conditions'];
			}
		}
		$d = $this->_do_query($to_excel, $fields, $conditions);
		
		$length = count($d);
		for ($i = 0; $i < $length; $i++) {
			$this->_remove_useless_app_files(PHASE_BEFORE_LEAVING, $d[$i]['ApplicantFile']);
		}
		$this->set('data',$d );
		//Get total files needed for phase_apply
		$this->set('total_file_needed',$this->DownloadFile->find('list',
			array(
				'conditions'=>array(
					'and'=>array(
						'DownloadFile.phase_id'=>PHASE_BEFORE_LEAVING,
						'DownloadFile.project_id'=>$this->Session->read('my_project')	
					)
				))
			)
		);
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);;
		}
		if($to_excel==0){
			$render_view = '1'.DS.$this->action;
		}else{
			$render_view = '1'.DS.'to_excel';
		}
		$this->render($render_view);
		return;
	}
	
	/**
	 * 列出所有在申请阶段的申请人
	 * @param  $msg_type
	 */
	public function list_all_in_phase_apply($msg_type = null,$to_excel=0,$current_query_id=NULL){
		//取消无用的bind
		$this->Applicant->unbindModel(
			array(
			'belongsTo'=>array(
				'JobStatus','VisaStatus'
				),
			'hasOne'=>array('ApplicantJob','ApplicantVisa')	
			)
		);
		$fields = array(
			'Applicant.id','Applicant.application_data','Applicant.status','Phase.name','Phase.id',
			'Enquiry.id','Enquiry.school','Enquiry.name','Enquiry.mobile','Enquiry.email','Enquiry.contract_id',
			'Project.id','Project.name','Source.id','Source.name','Orgnization.name','User.name'
		);
		$conditions = array(
				'AND'=>array(
					'Applicant.project_id'=>$this->Session->read('my_project'),
					'Applicant.user_id'=>$this->Auth->user('id'),
					'Applicant.phase_id>'.PHASE_REGISTRATION
					//'Applicant.status'=>NORMAL
				) 
			);
		if (!empty($this->request->data)) {
			//这时穿过来的关于ApplicantFile的条件不加入搜索条件中，而join中处理
			//把current query id也传过去进行处理
			$this->add_search_options(&$conditions,$fields,array('ApplicantFile'),array(),$current_query_id);
			$this->set('no_pagi',1);
		}else{
			//检查一下是不是传来了query id。这表示时打印当前视图，或者pagination过来的
			if ($current_query_id) {
				//从数据库中直接取得原来保存的link，解析之后返回
				//link字段中保存了conditions和fields两个数组
				$arr = $this->parse_query_id($current_query_id);
				$fields = $arr['fields'];
				$conditions = $arr['conditions'];
			}
		}
		$d = $this->_do_query($to_excel,$fields,$conditions);
		
		$length = count($d);
		for ($i = 0; $i < $length; $i++) {
			$this->_remove_useless_app_files(PHASE_APPLY, $d[$i]['ApplicantFile']);
		}
		
		$this->set('data',$d );
		
		//Get total files needed for phase_apply
		$this->set('total_file_needed',$this->DownloadFile->find(
			'list',
			array('conditions'=>array('and'=>array (
				'DownloadFile.phase_id'=>PHASE_APPLY,
				'DownloadFile.project_id'=>$this->Session->read('my_project'))))
		));
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);
		}
		if($to_excel==0){
			$render_view = $this->Session->read('my_project').DS.$this->action;
		}else{
			$render_view = $this->Session->read('my_project').DS.'to_excel';
			$this->layout = 'excel';
		}
		$this->render($render_view);
		return;
	}
	
	/**
	 * 管理员查看运营部员工的有效销售跟踪情况
	 */
	public function list_all_by_user_id($operator_id = NULL,$current_query_id=NULL){
		//取消无用的bind
		$this->Applicant->unbindModel(
			array(
			'belongsTo'=>array(
				'JobStatus','VisaStatus'
				),
			'hasOne'=>array('ApplicantJob','ApplicantVisa')	
			)
		);
		$fields = array(
			'Applicant.id','Applicant.application_data','Applicant.status','Phase.name','Phase.id',
			'Enquiry.id','Enquiry.school','Enquiry.name','Enquiry.mobile','Enquiry.email','Enquiry.contract_id',
			'Project.id','Project.name','Source.id','Source.name','Orgnization.name','User.name'
		);
		$conditions = array(
				'AND'=>array(
					'Applicant.user_id'=>$operator_id,
					'Applicant.phase_id>'.PHASE_REGISTRATION
				) 
			);
		if (!empty($this->request->data)) {
			//这时穿过来的关于ApplicantFile的条件不加入搜索条件中，而join中处理
			//把current query id也传过去进行处理
			$this->add_search_options(&$conditions,$fields,array('ApplicantFile'),array(),$current_query_id);
			$this->set('no_pagi',1);
		}else{
			//检查一下是不是传来了query id。这表示时打印当前视图，或者pagination过来的
			if ($current_query_id) {
				//从数据库中直接取得原来保存的link，解析之后返回
				//link字段中保存了conditions和fields两个数组
				$arr = $this->parse_query_id($current_query_id);
				$fields = $arr['fields'];
				$conditions = $arr['conditions'];
			}
		}
		$d = $this->_do_query(0,$fields,$conditions);  //0这个参数代表不是输出excel视图
		
		$length = count($d);
		for ($i = 0; $i < $length; $i++) {
			$this->_remove_useless_app_files(PHASE_APPLY, $d[$i]['ApplicantFile']);
		}
		
		$this->set('data',$d );
		
		//Get total files needed for phase_apply
		$this->set('total_file_needed',$this->DownloadFile->find(
			'list',
			array('conditions'=>array('and'=>array (
				'DownloadFile.phase_id'=>PHASE_APPLY,
				'DownloadFile.project_id'=>$this->Session->read('my_project'))))
		));

		$render_view = '1'.DS.'list_all_in_phase_apply';
		$this->action = 'list_all_in_phase_apply';
		$this->Session->write('my_project',1);
		$this->render($render_view);
		return;
	}
	
/**
	 * 列出所有在申请阶段的申请人
	 * @param  $msg_type
	 */
	public function list_all_in_phase_visa_prepair($msg_type = null,$to_excel=0,$current_query_id=NULL){
		//取消无用的bind
		$this->Applicant->unbindModel(
			array(
			'belongsTo'=>array(
				'JobStatus','VisaStatus'
				),
			'hasOne'=>array('ApplicantJob','ApplicantVisa')	
			)
		);
		$fields = array(
			'Applicant.id','Applicant.visa_data','Applicant.status','Phase.name','Phase.id','Enquiry.contract_id',
			'Enquiry.id','Enquiry.school','Enquiry.name','Enquiry.mobile','Enquiry.email',
			'Project.id','Project.name','Source.id','Source.name','Orgnization.name','User.name'
		);
		$conditions = array(
			'AND'=>array(
				'Applicant.project_id'=>$this->Session->read('my_project'),
				'Applicant.user_id'=>$this->Auth->user('id'),
				'Applicant.phase_id>='.PHASE_APPLY
			) 
		);
		if (!empty($this->request->data)) {
			$this->add_search_options(&$conditions,$fields);
			$this->set('no_pagi',1);
		}else{
			if ($current_query_id) {
				$arr = $this->parse_query_id($current_query_id);
				$fields = $arr['fields'];
				$conditions = $arr['conditions'];
			}
		}
		
		$d = $this->_do_query($to_excel,$fields,$conditions);
		
		$length = count($d);
		for ($i = 0; $i < $length; $i++) {
			$this->_remove_useless_app_files(PHASE_VISA, $d[$i]['ApplicantFile']);
		}
		$this->set('data',$d );
		//Get total files needed for phase_apply
		$this->set('total_file_needed',$this->DownloadFile->find(
			'list',
			array(
				'conditions'=>array(
						'and'=>array(
							'DownloadFile.phase_id'=>PHASE_VISA,
							'DownloadFile.project_id'=>$this->Session->read('my_project')	
						)
				))
			)
		);
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);;
		}
		if($to_excel==0){
			$render_view = $this->Session->read('my_project').DS.$this->action;
		}else{
			$render_view = $this->Session->read('my_project').DS.'to_excel';
		}
		$this->render($render_view);
		return;
	}
	
	/**
	 * 这个私有方法是根据给定的to_excel来判定是用paginate还是一般的执行数据库的查询，主要是为了解决重复的代码
	 * @param integer $to_excel
	 */
	private function _do_query_join($to_excel,$fields,$conditions,$joins , $file_name='youthedu_report_applicant_' ){
		if ($to_excel==0) {
			$this->paginate['fields']=$fields;
			$this->paginate['conditions'] = $conditions;
			$this->paginate['joins'] = $joins;
			$d = $this->paginate('Applicant');
		}else{
			$d = $this->Applicant->find('all',array(
				'conditions'=>$conditions,
				'fields'=>$fields,
				'joins'=>$joins,
				'order'=>array('Applicant.phase_id'=>'ASC')
			));
			$this->layout='excel';
			$this->set('output_file_name',$file_name.date('Y-m-d',time()).'.xls');
		}
		return $d;
	}
	
	/**
	 * 这个私有方法专门用来将查询出的和某个申请人相关的上传的文件中，不在指定的阶段的数组元素删除
	 * @param Integer $phase_id  指定的阶段
	 * @param array $app_files  包含上传的文件信息的数组
	 */
	private function _remove_useless_app_files($phase_id, & $app_files){
		if (!empty($app_files)) {
			$length = count($app_files);
			for ($i = 0; $i < $length; $i++) {
				if ($app_files[$i]['phase_id']!=$phase_id) {
					unset( $app_files[$i] );
				}
			}
		}
		return;
	}
	
	public function list_all($msg_type = null){
		$this->paginate['conditions'] = array('Applicant.group_id'=>$this->Session->read('my_group'));
		$this->set('data',$this->paginate('Applicant'));
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);;
		}
		$this->set('by_group_id',$this->Session->read('my_group'));
		return;
	}
	
	/**
	 * for Admin and Director use only
	 * @param Integer $group_id
	 */
	public function list_all_by_group_id($group_id = null){
		$this->paginate['conditions'] = array('Applicant.group_id'=>$group_id);
		$this->set('data',$this->paginate('Applicant'));
		$this->set('by_group_id',$group_id);
		$this->render('list_all');
		return;
	}
	
	/**
	 * 因故取消一个申请人的处理方法
	 */
	public function cancel(){
		$msg_type = 'error';
		if (!empty($this->request->data)) {
			if ($this->Applicant->cancel($this->request->data)) {
				$msg_type = 'success';
				$this->Session->setFlash('操作成功！');
			}else{
				$this->Session->setFlash('操作失败，请稍候再试或联系管理员！');
			}
		}
		$this->redirect($this->referer());
		return;
	}
	
	public function list_all_by_160($status = 0,$msg_type=NULL){
		$conditions = array(
			'AND'=>array(
				'Applicant.group_id'=>$this->Session->read('my_group'),
				'Applicant.status'=>NORMAL,
				'ApplicantVisa.form160'=>$status
			) 
		);
		if (!empty($this->request->data)) {
			$this->add_search_options(&$conditions);
			$this->set('no_pagi',1);
		}
		$this->paginate['conditions'] = $conditions;
		$this->Applicant->unbindModel(
			array(
			'belongsTo'=>array(
				'User','Source'
				),
			'hasOne'=>array('ApplicantJob')
			)
		);
		$this->paginate['recursive']=1;
		//$this->paginate['order']=array('Applicant.phase_id'=>'asc');
		$this->paginate['fields']=array(
			'Applicant.id','Applicant.visa_data','ApplicantVisa.visa_traing_date',
			'Applicant.phase_id','ApplicantVisa.visa_appointment_date',
			'ApplicantVisa.last_training_date','ApplicantVisa.embassy_address',
			'ApplicantVisa.sevis','ApplicantVisa.ds2019','ApplicantVisa.form160',
			'Enquiry.id','Enquiry.school','Enquiry.name','Enquiry.mobile','Enquiry.email',
			'Project.id','Project.name','Phase.name','Phase.id','Orgnization.name',
			'VisaStatus.name','Applicant.visa_status'
		);
		
		$d = $this->paginate('Applicant');
		$length = count($d);
		for ($i = 0; $i < $length; $i++) {
			$this->_remove_useless_app_files(PHASE_VISA, $d[$i]['ApplicantFile']);
		}
		$this->set('data',$d );
		
		//Get total files needed for phase_apply
		$this->set('total_file_needed',$this->DownloadFile->find('list',array('conditions'=>array('DownloadFile.phase_id'=>PHASE_VISA))));
		//给搜索表单用的
		// $this->set('visa_status',$this->VisaStatus->find('list'));
		
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);
		}
		$this->autoRender = FALSE;
		$this->render($this->Session->read('my_project').DS.'list_all_in_phase_visa');
		return;
	}
}