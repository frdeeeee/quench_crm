<?php
class SalesController extends AppController{
	public $uses = array('Group','WorkingLog','Enquiry','Presentation','Project','Note');
	public $name = 'Sales';
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('controller_name',$this->name);
		$this->set('action_name',$this->action);
	}
	
	public $paginate = array(
			'limit' => 20,
			'recursive' => 1,
	);
	
	/*
	 * 管理员登陆的界面加载
	 */
	public function load_admin(){
		$this->set('data',$this->load_admin_statistics());
		//取得最后的一个客户的纪录
		$this->set('latest_applicant',$this->Enquiry->find('first',array(
			'conditions'=>array(
				'AND'=>array(
					'Enquiry.is_applicant=1',
					'Enquiry.status=0'
				)
			),
			'order'=>array('Enquiry.modified DESC')
		)));
		//今天需要联系的人
		$this->WorkingLog->unbindModel(array('hasMany'=>array('WorkingLogFeedback')));
		$this->set('to_do',$this->WorkingLog->find('all',array(
			'conditions'=>array(
				'AND'=>array(
					'WorkingLog.user_id'=>$this->Auth->user('id'),
					'WorkingLog.next_appointment' => date('Y-m-d',time())
				) 
			)
		)));
		//取得所属组的宣讲会纪录总数
		$this->set('total_presentations',$this->Presentation->get_total());
		//Load Admin's notes
		$this->paginate['order']=array('Note.modified');
		$this->paginate['conditions']=array(
			'and'=>array(
				'Note.is_deleted=0',
				'Note.user_id'=>$this->Auth->user('id')
			)
		);
		$this->set('my_notes',$this->paginate('Note'));
		$this->set('current_menu','Statistics');
		return;
	}
	
	/**
	 * 普通员工登陆界面的加载方法
	 */
	public function load(){
		//统计表
		$this->set('data',$this->load_sales_statistics());
		$this->set('all_sales_data',$this->load_admin_statistics());
		//今天需要联系的人
		$this->set('to_do',$this->get_to_do_today());
		//取得最后的一个客户的纪录
		$this->set('latest_applicant',$this->get_latest_applicant());
		//取得所属组的宣讲会纪录总数
		$this->set('total_presentations',$this->Presentation->get_total($this->Session->read('my_group')));
		//Load Sales's notes
		$this->paginate['order']=array('Note.modified');
		$this->paginate['conditions']=array(
			'and'=>array(
				'Note.is_deleted=0',
				'Note.user_id'=>$this->Auth->user('id')
			)
		);
		$this->set('my_notes',$this->paginate('Note'));
		//取得学生如果在报名后一个星期之内没有安排考试，系统自动提醒，这样我们好安排学生考试，以免遗漏
		
		$this->set('no_slep_arrangement',$this->get_no_slep_arrangements());
		return;
	}
	
	private function get_no_slep_arrangements(){
		$one_week_ago = date('Y-m-d',mktime(0, 0, 0, date("m") ,date("d")-7, date("Y")));
		$this->Enquiry->unbindModel(
			array(
				'hasMany'=>array(
					'EnquiryFeedback','MoneyReturn','Checkin'
				),
				'belongsTo'=>array(
					'Group','Project','Source','Presentation','Customer',
					'ApplyFeeStatus','ContractStatus','ProjectFeeStatus'
				)
			)
		);
		return $this->Enquiry->find('all',array(
			'conditions'=>array(
				'and'=>array(
					'Enquiry.slep_scores'=>0,
					'Enquiry.group_id IN ('.$this->Session->read('my_groups_ids').')',
					'Enquiry.status'=>NORMAL,
					'Enquiry.created<\''.$one_week_ago.'\''
				)
			),
			'fields'=>array('Enquiry.id','Enquiry.name','Enquiry.school')
		));
	}
	
	private function get_latest_applicant(){
		return $this->Enquiry->find('first',array(
			'conditions'=>array(
				'AND'=>array(
					'Enquiry.group_id'=>$this->Session->read('my_group'),
					'Enquiry.is_applicant=1',
					'Enquiry.status=0'
				)
			),
			'order'=>array('Enquiry.created DESC')
		));
	}
	
	private function get_to_do_today(){
		$this->WorkingLog->unbindModel(array('hasMany'=>array('WorkingLogFeedback')));
		$one_week_later = date('Y-m-d',mktime(0, 0, 0, date("m") ,date("d")+7, date("Y")));
		return $this->WorkingLog->find('all',array(
			'conditions'=>array(
				'AND'=>array(
					'WorkingLog.group_id'=>$this->Session->read('my_group'),
					'WorkingLog.next_appointment<"'.$one_week_later.'"',
					'WorkingLog.next_appointment>="'.date('Y-m-d',time()).'"',
				) 
			),
			'order'=>array('WorkingLog.next_appointment'=>'asc')
		));
	}
	
	private function load_sales_statistics(){
		$this->Project->unbindModel(array('hasMany'=>array('Task','Enquiry','Applicant','DownloadFile')));
		return $this->Project->find('all',array(
			'fields'=>array(
				'COUNT(DISTINCT Enquiry.id) as total_enquiries',
				'COUNT(DISTINCT Enquiry2.id) as total_applicants',
				'Project.name',
				'Project.target',
				'Project.deadline',
				'Project.id',
				'Task.name',
				'Task.target',
				'Task.deadline',
				'Task.id'
			),
			'group'=>array('Project.id'),
			'recursive'=>1,
			'joins'=>array(
				array(
					'table'=>'enquiries',
					'alias' => 'Enquiry',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Enquiry.project_id = Project.id',
							'Enquiry.status=0',
							'Enquiry.group_id'=>$this->Session->read('my_group')
						) 
					)
				),
				array(
					'table'=>'enquiries',
					'alias' => 'Enquiry2',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Enquiry2.project_id = Project.id',
							'Enquiry2.status=0',
							'Enquiry2.is_applicant=1',
							'Enquiry2.group_id'=>$this->Session->read('my_group')
						) 
					)
				),
				array(
					'table'=>'tasks',
					'alias' => 'Task',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Task.project_id = Project.id',
							'Task.group_id IN ('.$this->Session->read('my_groups_ids').')',
							'Task.status=0'
						) 
					)
				)
			)
		));
	}
	
	private function load_admin_statistics(){
		$this->Project->unbindModel(array('hasMany'=>array('Task','Enquiry','Applicant')));
		return $this->Project->find('all',array(
			'fields'=>array(
				'COUNT(DISTINCT Enquiry.id) as total_enquiries',
				'COUNT(DISTINCT Enquiry2.id) as total_applicants',
				'Project.name',
				'Project.target',
				'Project.deadline',
				'Project.id'
			),
			'group'=>array('Project.id'),
			'recursive'=>1,
			'joins'=>array(
				array(
					'table'=>'enquiries',
					'alias' => 'Enquiry',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Enquiry.project_id = Project.id',
							'Enquiry.status=0'
						) 
					)
				),
				array(
					'table'=>'enquiries',
					'alias' => 'Enquiry2',
					'type' => 'LEFT',
					'conditions'=>array(
						'AND'=>array(
							'Enquiry2.project_id = Project.id',
							'Enquiry2.status=0',
							'Enquiry2.is_applicant=1'
						) 
					)
				)
			)
		));
	}
	
	/**
	 * 提供系统所有的和销售相关的数据，给管理员看，基本上就是不分任何的group，或者groupleader
	 */
	private function load_admin_statistics1(){
		$this->Group->unbindModel(array('hasMany'=>array('GroupUser','WorkingLog'),'belongsTo'=>array('Leader')));
		$options['conditions'] = array('Group.group_leader > '.$this->Session->read('my_group_leader'));
		$options['fields'] = array(
			'COUNT(Enquiry.id) as total_enquiries',
			'COUNT(Enquiry2.id) as total_applicants',
			'Project.name',
			'Project.target',
			'Task.deadline',
			'Task.target',
			'Task.id'
		);
		$options['group'] = array('group'=>'Enquiry.project_id');
		$options['recursive'] = 0;
		$options['joins'] = array(
			array(
				'table'=>'enquiries',
				'alias' => 'Enquiry',
				'type' => 'LEFT',
				'conditions'=>array(
					'AND'=>array(
						'Enquiry.group_id = Group.id',
						'Enquiry.status=0'
					) 
				)
			),
			array(
				'table'=>'enquiries',
				'alias' => 'Enquiry2',
				'type' => 'LEFT',
				'conditions'=>array(
					'AND'=>array(
						'Enquiry2.Group_id = Group.id',
						'Enquiry2.status=0',
						'Enquiry2.is_applicant=1'
					) 
				)
			),
			array(
				'table'=>'projects',
				'alias' => 'Project',
				'type' => 'LEFT',
				'conditions'=>array(
					'AND'=>array(
						'Enquiry.project_id = Project.id',
						'Enquiry.status=0'
					) 
				)
			),
			array(
				'table'=>'tasks',
				'alias' => 'Task',
				'type' => 'LEFT',
				'conditions'=>array(
					'AND'=>array(
						'Task.project_id = Project.id',
						'Task.status=0',
						'Task.user_id > '.$this->Session->read('my_group_leader')
					) 
				)
			)
		);
		return $this->Group->find('all',$options);
	}
}