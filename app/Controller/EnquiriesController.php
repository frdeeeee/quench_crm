<?php
App::uses('Sanitize', 'Utility');
class EnquiriesController extends AppController{
	public $uses = array('Enquiry','User','Customer','Task','GroupUser','Presentation');
	public $name = 'Enquiries';

	public $paginate = array(
			'limit' => 20,
			'order' => array(
					'Enquiry.modified'=>'DESC',
					'Enquiry.id'=>'DESC',
			),
			'recursive' => 1
	);
	private $how_to_konw_youthedu = array(
			1=>'海报 ',2=>'校内BBS',3=>'同学',4=>'指导员',5=>'网站',6=>'其他'
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('how_to_konw_youthedu',$this->how_to_konw_youthedu);
		$this->set('controller_name',$this->name);
		$this->set('action_name',$this->action);	
		$this->set('current_menu','Enquiries');
		
	}
	
	public function remove_money_back($id=NULL){
		$this->loadModel('MoneyReturn');
		
		$this->MoneyReturn->id = $id;
		$enquiry_id = $this->MoneyReturn->field('enquiry_id');
		$this->MoneyReturn->delete($id);
		$this->redirect(array('action'=>'view_money_back',$enquiry_id));
		return;
	}
	
	/**
	 * 修改指定的返点纪录
	 * @param unknown_type $id
	 */
	public function modify_money_back($id=NULL){
		$this->loadModel('MoneyReturn');
		if (empty($this->request->data)) {
			$this->MoneyReturn->id = $id;
			$this->set('data',$this->MoneyReturn->read());
		}else{
			$this->MoneyReturn->save($this->request->data);
			$this->redirect(array('action'=>'view_money_back',$this->request->data['MoneyReturn']['enquiry_id']));
		}
		return;
	}
	
	/**
	 * 根据学生的id查看所有的返点纪录
	 * @param unknown_type $enquiry_id
	 */
	public function view_money_back($enquiry_id=NULL){
		$this->loadModel('MoneyReturn');
		$this->set('data',$this->MoneyReturn->find('all',array(
			'conditions'=>array('MoneyReturn.enquiry_id'=>$enquiry_id),
			'order'=>'MoneyReturn.id desc'
		)));
		return;
	}
	
	/**
	 * 针对某个报名学生添加返点纪录
	 * @param unknown_type $enquiry_id
	 */
	public function add_money_back($enquiry_id=NULL){
		if (!empty($this->request->data)) {
			$this->loadModel('MoneyReturn');
			$this->request->data['MoneyReturn']['group_id']=$this->Session->read('my_group');
			$this->request->data['MoneyReturn']['user_id']=$this->Auth->user('id');
			if ($this->MoneyReturn->save($this->request->data)) {
				$this->Session->setFlash('添加返点费用成功！');
				$this->redirect(array('action'=>'list_money_return',0,'success'));
			}else{
				$this->Session->setFlash('添加返点费用失败，请检查表格确保无误后稍后再试，或联系管理员！');
				$this->set('msg_type','error');
			}
		}
			$this->Enquiry->id = $enquiry_id;
			$this->Enquiry->unbindModel(array('hasMany'=>array('EnquiryFeedback','Checkin'),'belongsTo'=>array('Project','Group','Source','Presentation')));
			$d = $this->Enquiry->find('first',array(
				'conditions'=>array('Enquiry.id'=>$enquiry_id),
				'fields'=>array('Enquiry.id','Enquiry.name','Customer.name','Customer.id','Enquiry.task_id')
			));
			$this->set('data',$d);
		return;
	}
	
	/**
	 * 
	 * 查看返点纪录的专用方法
	 * @param Integer $customer_id
	 */
	public function list_money_return($customer_id = NULL,$msg_type=NULL){
		if ($customer_id && $customer_id!=0) {
			$this->paginate['conditions']=array(
				'and'=>array(
					'Enquiry.customer_id'=>$customer_id,
					'Enquiry.group_id'=>$this->Session->read('my_group'),
					'Enquiry.apply_fee_status_id'=>2
				)
			);
		}else{
			$this->paginate['conditions']=array(
				'and'=>array(
					'Enquiry.group_id'=>$this->Session->read('my_group'),
					'Enquiry.apply_fee_status_id'=>2
				)
			);
		}
		$this->Enquiry->unbindModel(array('hasMany'=>array('EnquiryFeedback','Checkin')));
		$this->paginate['fields']=array(
			'Enquiry.id','Enquiry.name','Enquiry.email','Enquiry.mobile','Enquiry.money_return_sum',
			'Customer.money_return_sum1','Customer.money_return_sum2','Customer.name',
			'Customer.customerType_id','Enquiry.comments'
		);
		$this->set('data',$this->paginate('Enquiry'));
		if ($msg_type) {
			$this->set('msg_type',$msg_type);
		}
		return;
	}
	
	/*
	 * 根据id来修改enquiry的内容
	 */
	public function modify($enquiry_id = null){
		
		if (empty($this->request->data)) {
			$this->Enquiry->id = $enquiry_id;
			if ($this->Enquiry->field('status') == 0) {
				//表示该纪录有效;
				$this->set('data',$this->Enquiry->read());
				/*
				if ($this->cached_data) {
					$this->set('sources',$this->cached_data['sources']);
				}else{
					$this->set('sources',$this->Source->find('list'));
				}
				*/
				$this->_set_customers();
				$this->set('presentations',$this->Presentation->find('list',array('conditions'=>array('Presentation.group_id'=>$this->Session->read('my_group')))));
			}else{
				//表示该纪录已经实效了，应该时被删除，或者被升级等
				$this->Session->setFlash('您申请修改的报名表已经失效，无法编辑，请联系管理员!');
				$this->redirect(array('action'=>'list_all','error'));
			}
		}else{
			//保存修改后的信息
			$this->Enquiry->id = $this->request->data['Enquiry']['id'];
			if ($this->Enquiry->exists() && $this->Enquiry->field('status')==0) {
				if($this->Enquiry->save($this->request->data)){
					$this->Session->setFlash('您申请修改的报名表已经成功修改!');
					if ($this->Auth->user('department_id')==SALES_DEPARTMENT) {
						$this->redirect(array('action'=>'list_all_for_operator','success'));
					}else{
						//如果当前操作的人不是销售部的，那就跳转到运营部页面
						$this->redirect(array('action'=>'list_all_for_operator','success'));
					}
				}else{
					$this->set('data',$this->Enquiry->read());
					
					$this->set('presentations',$this->Presentation->find('list',array('conditions'=>array('Presentation.group_id'=>$this->Session->read('my_group')))));
					$this->_set_customers();
					$this->Session->setFlash('您申请修改报名表的操作失败，请联系管理员!');
					$this->set('msg_type','error');
				}
			}else{
				//表示该纪录已经实效了，应该时被删除，或者被升级等
				$this->Session->setFlash('您申请修改的报名表已经实效，无法编辑，请联系管理员!');
				$this->redirect(array('action'=>'list_all','error'));
			}
		}
		return;
	}
	
	/**
	 * 生成统计结果时，根据给定的项目和task，为管理员生成报名学生和成功销售的信息列表，如果taskId为空时，表示生成针对整个project的列表
	 * @param Integer $project_id
	 * @param Integer $task_id
	 * @return Array
	 */
	public function load_by_project($project_id = null,$task_id = null){
		if ($task_id>0) {
			if ($this->Auth->user('role_id')==SALES_DIRECTOR || $this->Auth->user('role_id') == ADMIN) {
				$conditions = array(
					'AND'=>array(
						'Enquiry.is_applicant' => 0,
						'Enquiry.status'=>NORMAL,
						'Enquiry.project_id'=>$project_id,
						'Enquiry.task_id'=>$task_id,
					)
				);
			}else{
				//从结构上来看时这样的，可是这么做可能没有任何的用处，而且也没有地方会调用到这个方法
				$conditions = array(
					'AND'=>array(
						'Enquiry.group_id'=>$this->Session->read('my_group'),
						'Enquiry.is_applicant' => 0,
						'Enquiry.status'=>NORMAL,
						'Enquiry.project_id'=>$project_id,
						'Enquiry.task_id'=>$task_id,
					)
				);
			}
		}else{
			if ($this->Auth->user('role_id')==SALES_DIRECTOR || $this->Auth->user('role_id') == ADMIN) {
				$conditions = array(
					'AND'=>array(
						'Enquiry.is_applicant' => 0,
						'Enquiry.status'=>NORMAL,
						'Enquiry.project_id'=>$project_id
					)
				);
			}else{
				$conditions = array(
					'AND'=>array(
						'Enquiry.group_id'=>$this->Session->read('my_group'),
						'Enquiry.is_applicant' => 0,
						'Enquiry.status'=>NORMAL,
						'Enquiry.project_id'=>$project_id
					)
				);
			}
		}
		if (!empty($this->request->data)) {
			//array_merge($conditions,$this->add_search_options(&$conditions));
			$this->add_search_options(&$conditions);
			$this->set('no_pagi',1);
		}
		$this->paginate['conditions'] = $conditions;
			
			$this->paginate['joins'] = array(
				array(
					'table'=>'applicants',
					'alias'=>'Applicant',
					'type'=>'LEFT',
					'conditions'=>array(
						'Enquiry.id=Applicant.enquiry_id'
					)
				),
				array(
					'table'=>'phases',
					'alias'=>'Phase',
					'type'=>'LEFT',
					'conditions'=>array('Applicant.phase_id=Phase.id')
				)
			);
			$this->paginate['fields']=array(
				'Enquiry.id','Enquiry.name','Enquiry.school','Enquiry.grade','Enquiry.major','Enquiry.email','Enquiry.mobile',
				'Enquiry.email','Enquiry.exam_date','Enquiry.is_feedback','Enquiry.slep_scores','Enquiry.apply_fee_status_id',
				'Enquiry.apply_fee','Enquiry.project_fee','Enquiry.presentation_id',
				'Project.name','Presentation.name','Presentation.hold_on','Source.name','Phase.name','ApplyFeeStatus.name',
				'ContractStatus.name','ProjectFeeStatus.name'
			);
			//$this->Enquiry->unbindModel(array('hasMany'=>array('EnquiryFeedback')));
		$this->paginate['recursive'] = 2;
		$this->set('data',$this->paginate('Enquiry'));
			
		//设置本组的还没有回访的学生数量
			$this->set('unfeedback_enquiry',$this->Enquiry->find('count',array(
				'conditions'=>array(
					'AND'=>array(
						'Enquiry.group_id'=>$this->Session->read('my_group'),
						'Enquiry.is_feedback'=>0,
						'Enquiry.is_applicant'=>0,
						'Enquiry.status'=>NORMAL
					)
				)
			)));
			
		$this->set('by_group_id',$this->Session->read('my_group'));
		$this->set('is_applicant',0);
		//加入本组的宣讲会list，给搜索表单用
			$this->set('presentations',
				$this->Presentation->find('list',array(
					'conditions'=>array('Presentation.group_id'=>$this->Session->read('my_group'))))
			);
			
		$this->init_auto_complete_data();
		$this->render('list_all_for_operator');
		return;
	}
	
	/**
	 * 用户添加新的工作记录的方法
	 */
	public function add(){
		if (empty($this->request->data)) {
			if ($this->Auth->user('department_id')==SALES_DEPARTMENT) {
				//For sales department
				$this->set('tasks',$this->Task->find_my_tasks($this->Session->read('my_group')));
				//Will use the cached data
				$this->set('presentations',$this->Presentation->find('list',
					array('conditions'=>array(
						'and'=>array(
							'Presentation.group_id IN('.implode(',', $this->get_my_groups()).')',
							'Presentation.available'=>1
					))))
				);
				$this->set('t_projects',$this->get_my_projects($this->get_my_groups()));
				
				//把当前组的客户的纪录找出来放到页面上
				$this->_set_customers();
				//根据操作的用户所属的组找到今天输入的新申请
				if ($this->Auth->user('role_id')==SALES_DIRECTOR || $this->Auth->user('role_id')==OPERATION_DERECTOR ||$this->Auth->user('role_id') == ADMIN) {
					$this->set('data',$this->Enquiry->get_today_enquiries());
				}else{
					$this->set('data',$this->Enquiry->get_today_enquiries($this->Session->read('my_group')));
				}
			}else{
				
			}
		}else{
			$this->Customer->id = $this->request->data['Enquiry']['customer_id'];
			$money_return_sum = NULL;
			if ($this->Customer->exists()) {
				$money_return_sum = $this->Customer->field('money_return_sum1')+$this->Customer->field('money_return_sum2');
			}
			//取出包含group_id和project_id的对应值对的数组
			$possible_project_group_pair = $this->get_my_projects($this->get_my_groups(),FALSE);
			
			if($this->Enquiry->add_new_enquiry($this->request->data,$money_return_sum,$possible_project_group_pair)){
				$this->Session->setFlash('工作记录添加成功!');
				//Sales and operation will use the save list view for enquiries
				$this->redirect(array('action'=>'list_all_for_operator','success'));
			}else{
				//添加失败
				$this->set('msg_type','error');
				$this->Session->setFlash('无法添加您的工作记录, 请稍候再试!');
				$this->set('tasks',$this->Task->find_by_leader_id($this->Session->read('my_group_leader')));
				
				$this->set('presentations',$this->Presentation->find(
					'list',array('conditions'=>array('Presentation.group_id'=>$this->Session->read('my_group'))))
				);
				$this->_set_customers();
				//$this->set('t_projects',$this->Project->find('list'));
				$this->set('t_projects',$this->get_my_projects($this->get_my_groups()));
				
				//根据操作的用户所属的组找到今天输入的新申请
				if ($this->Auth->user('role_id')==SALES_DIRECTOR || $this->Auth->user('role_id')==OPERATION_DERECTOR || $this->Auth->user('role_id') == ADMIN) {
					$this->set('data',$this->Enquiry->get_today_enquiries());
				}else{
					$this->set('data',$this->Enquiry->get_today_enquiries($this->Session->read('my_group')));
				}
			}
		}
		return;
	}
	
	public function list_all($msg_type = null){
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);;
		}
		if ($this->Auth->user('role_id')==SALES_DIRECTOR || $this->Auth->user('role_id') == ADMIN) {
			$this->set('data',$this->paginate('Enquiry'));
		}else{
			$this->paginate['conditions'] = array(
				'AND'=>array(
						'Enquiry.group_id'=>$this->Session->read('my_group'),
						'Enquiry.is_applicant'=>0,
						'Enquiry.status'=>NORMAL
						) 
			);
			$this->set('data',$this->paginate('Enquiry'));
		}
		$this->set('is_applicant',0);
		return;
	}
	
	/**
	 * for Admin and Director use only
	 * @param Integer $group_id
	 */
	public function list_all_by_group_id($group_id = null){
		$this->paginate['conditions'] = array(
				'AND'=>array(
						'Enquiry.group_id'=>$group_id,
						'Enquiry.is_applicant'=>0,
						'Enquiry.status'=>NORMAL
					) 
			);	
		$this->set('data',$this->paginate('Enquiry'));
		$this->set('is_applicant',0);
		$this->set('by_group_id',$group_id);
		$this->render('list_all');
		return;
	}
	
	public function list_all_applicants(){
		if ($this->Auth->user('role_id')==SALES_DIRECTOR || $this->Auth->user('role_id') == ADMIN) {
			$this->paginate['conditions'] = array('AND' => array('Enquiry.is_applicant=1','Enquiry.status'=>NORMAL));
			$this->set('data',$this->paginate('Enquiry'));
		}else{
			$this->Enquiry->unbindModel(
				array(
					'hasMany'=>array('EnquiryFeedback'),
					'belongsTo'=>array('Group','Project','Source','Channel')
				));
			$this->paginate['joins']=array(
				array(
					'table'=>'applicants',
					'alias'=>'Applicant',
					'type'=>'left',
					'conditions'=>array(
						'Applicant.enquiry_id=Enquiry.id'
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
					'table'=>'projects',
					'alias'=>'Project',
					'type'=>'left',
					'conditions'=>array(
						'Enquiry.project_id=Project.id'
					)
				),
				array(
					'table'=>'job_status',
					'alias'=>'JobStatus',
					'type'=>'left',
					'conditions'=>array(
						'Applicant.job_status=JobStatus.id'
					)
				)
			);
			$this->paginate['recursive'] = -1;
			$this->paginate['fields']=array(
				'Enquiry.id','Enquiry.name','Enquiry.mobile','Enquiry.email','Enquiry.school','Enquiry.grade','Enquiry.major',
				'Project.name','Applicant.id','Applicant.slep',
				'Applicant.project_data','Applicant.application_data','Applicant.visa_data',
				'JobStatus.name','Phase.name'
			);
			$this->paginate['conditions'] = array(
				'AND'=>array(
					'Enquiry.group_id'=>$this->Session->read('my_group'),
					'Enquiry.is_applicant=1',
					'Enquiry.status'=>NORMAL
				)
			);
			$this->set('data',$this->paginate('Enquiry'));
		}
		$this->set('is_applicant',1);
		$this->set('by_group_id',$this->Session->read('my_group'));
		return;
	}
	
	/**
	 * 显示所有被标记为删除的报名表
	 */
	public function list_all_removed($msg_type=NULL,$to_excel=0){
		
		if ($this->Auth->user('role_id')==SALES_DIRECTOR || $this->Auth->user('role_id') == ADMIN) {
			$conditions = array('Enquiry.status'=>DELETED);
		}else{
			$conditions = array(
				'AND'=>array(
					'Enquiry.group_id'=>$this->Session->read('my_group'),
					'Enquiry.status'=>DELETED
				)
			);
		}
		$fields = array(
			'Enquiry.id','Enquiry.name','Enquiry.school','Enquiry.grade','Enquiry.major','Enquiry.email','Enquiry.mobile',
			'Enquiry.email','Enquiry.comments','Project.name','Source.name'
		);
		
		$d = $this->_do_query_enquiry($to_excel, $fields, $conditions);
		
		$this->set('data',$d);
		$this->set('is_applicant',0);
		$this->set('by_group_id',$this->Session->read('my_group'));
		//加入本组的宣讲会list，给搜索表单用
			$this->set('presentations',
				$this->Presentation->find('list',array(
					'conditions'=>array('Presentation.group_id'=>$this->Session->read('my_group'))))
			);
			
		$this->init_auto_complete_data();
		if($to_excel==0){
			$render_view = $this->action;
		}else{
			$render_view = 'to_excel';
		}
		$this->render($render_view);
		return;
	}
	
	public function restore($enquiry_id = NULL){
		$this->Enquiry->id = $enquiry_id;
		$msg_type = 'success';
		if ($this->Enquiry->exists()) {
			if($this->Enquiry->restore($enquiry_id)){
				$this->Session->setFlash('恢复成功');
				if ($this->Auth->user('department_id')==SALES_DEPARTMENT) {
					$this->redirect(array('action'=>'list_all',$msg_type));
				}else{
					$this->redirect(array('action'=>'list_all_for_operator',$msg_type));
				}
			}else{
				$this->Session->setFlash('恢复失败，请稍候再试');
				$msg_type = 'error';
				$this->redirect(array('action'=>'list_all_removed',$msg_type));
			}
		}else{
			$this->Session->setFlash('恢复失败，请稍候再试');
			$msg_type = 'error';
			$this->redirect(array('action'=>'list_all_removed',$msg_type));
		}
		return;
	}
	
	/**
	 * 列出所有的enquiry，为了运营部的视图展示
	 * @param string $msg_type
	 */
	public function list_all_for_operator($msg_type = null,$to_excel=0,$current_query_id=NULL){
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);;
		}
		
		$conditions = array(
					'AND'=>array(
						//'Enquiry.group_id'=>$this->Session->read('my_group'),  //运营部不在根据group来找学生
						'Enquiry.project_id'=>$this->Session->read('my_project'),
						'Enquiry.is_applicant' => 0,
						'Enquiry.status'=>NORMAL
					)
		);
		//需要根据运营部的角色来看，如果是助理，需要加上被指定的运营助理userid的条件
		if ($this->Auth->user('role_id')==OPERATION_ASSISTANT) {
			$conditions['AND']['Enquiry.user_id']=$this->Auth->user('id');
		}
		
		$joins = array(
			array(
						'table'=>'applicants',
						'alias'=>'Applicant',
						'type'=>'LEFT',
						'conditions'=>array(
							'Enquiry.id=Applicant.enquiry_id'
						)
					),
			array(
						'table'=>'phases',
						'alias'=>'Phase',
						'type'=>'LEFT',
						'conditions'=>array('Applicant.phase_id=Phase.id')
					)
		);
		$fields = array(
					'Enquiry.id','Enquiry.name','Enquiry.school','Enquiry.grade','Enquiry.major','Enquiry.email','Enquiry.mobile','Enquiry.project_id',
					'Enquiry.email','Enquiry.exam_date','Enquiry.is_feedback','Enquiry.slep_scores','Enquiry.apply_fee_status_id','Enquiry.accom_fee_status_id',
					'Enquiry.project_fee_status_id','Enquiry.apply_fee','Enquiry.project_fee','Enquiry.presentation_id','Enquiry.is_app_form_submit',
					'Enquiry.user_id',
					'Presentation.name','Presentation.hold_on','Source.name','Phase.name','ApplyFeeStatus.name',
					'ContractStatus.name','ProjectFeeStatus.name'
				);
		
		if (!empty($this->request->data)) {
				$this->add_search_options(&$conditions,$fields,$joins);
				$this->set('no_pagi',1);
		}else{
			if ($current_query_id) {
				$arr = $this->parse_query_id($current_query_id);
				$fields = $arr['fields'];
				$conditions = $arr['conditions'];
			}
		}
		$this->Enquiry->unbindModel(array('belongsTo'=>array('Project')));
		if ($to_excel==0) {
			$this->paginate['conditions'] = $conditions;
			$this->paginate['joins'] = $joins;
			$this->paginate['fields']= $fields;
			$this->paginate['recursive'] = 2;
			$this->paginate['order'] = array('Enquiry.user_id'=>'asc','Enquiry.id'=>'desc');
			$this->set('data',$this->paginate('Enquiry'));
			$this->set('current_menu','Applicants');
			$this->_set_common_variables();
		}else{
			$this->layout = 'excel';
			$d= $this->Enquiry->find('all',array(
				'conditions'=>$conditions,
				'joins'=>$joins,
				'fields'=>$fields,
				'recursive'=>2,
				'order'=>array('Enquiry.user_id'=>'asc','Enquiry.id'=>'desc')
			));
			$this->set('data',$d);
			$this->set('output_file_name','youthedu_report_enquiry_'.date('Y-m-d',time()).'.xls');
		}
		if($to_excel==0){
			$render_view = $this->action;
		}else{
			$render_view = 'to_excel';
			$this->layout = 'excel';
		}
		//为了提供学生转到别的项目而需要的表单变量
		$this->loadModel('Group');
		$this->set('other_groups',$this->Group->find('list'));
		
		if ($this->Auth->user('role_id')==OPERATION) {
			//找出还没有被指定运营老师的学生的数量
			$not_assign_number = $this->Enquiry->find('count',
				array('conditions'=>array('and'=>array( 'Enquiry.user_id'=>NOT_ASSIGNED,  'Enquiry.project_id'=>$this->Session->read('my_project')))));
			$this->set('not_assign_number',$not_assign_number);
			$operator_assistants = $this->User->find('list',array('conditions'=>array('User.department_id'=>OPERATION_DEPARTMENT)));
			$this->set('operator_assistants',$operator_assistants);
		}
		
		$this->render($render_view);
		return;
	}
	
	/**
	 * 管理员根据员工id查看运营部人员的报名跟踪情况
	 */
	public function list_all_by_user_id($operator_id = NULL,$current_query_id=NULL){
		$conditions = array(
					'AND'=>array(
						'Enquiry.user_id'=>$operator_id,
						'Enquiry.is_applicant' => 0,
						'Enquiry.status'=>NORMAL
					)
		);
		
		$joins = array(
			array(
						'table'=>'applicants',
						'alias'=>'Applicant',
						'type'=>'LEFT',
						'conditions'=>array(
							'Enquiry.id=Applicant.enquiry_id'
						)
					),
			array(
						'table'=>'phases',
						'alias'=>'Phase',
						'type'=>'LEFT',
						'conditions'=>array('Applicant.phase_id=Phase.id')
					)
		);
		$fields = array(
					'Enquiry.id','Enquiry.name','Enquiry.school','Enquiry.grade','Enquiry.major','Enquiry.email','Enquiry.mobile','Enquiry.project_id',
					'Enquiry.email','Enquiry.exam_date','Enquiry.is_feedback','Enquiry.slep_scores','Enquiry.apply_fee_status_id','Enquiry.accom_fee_status_id',
					'Enquiry.project_fee_status_id','Enquiry.apply_fee','Enquiry.project_fee','Enquiry.presentation_id','Enquiry.is_app_form_submit',
					'Enquiry.user_id',
					'Presentation.name','Presentation.hold_on','Source.name','Phase.name','ApplyFeeStatus.name',
					'ContractStatus.name','ProjectFeeStatus.name'
				);
		
		if (!empty($this->request->data)) {
				$this->add_search_options(&$conditions,$fields,$joins);
				$this->set('no_pagi',1);
		}else{
			if ($current_query_id) {
				$arr = $this->parse_query_id($current_query_id);
				$fields = $arr['fields'];
				$conditions = $arr['conditions'];
			}
		}
		$this->Enquiry->unbindModel(array('belongsTo'=>array('Project')));

			$this->paginate['conditions'] = $conditions;
			$this->paginate['joins'] = $joins;
			$this->paginate['fields']= $fields;
			$this->paginate['recursive'] = 2;
			$this->paginate['order'] = array('Enquiry.user_id'=>'asc','Enquiry.id'=>'desc');
			$this->set('data',$this->paginate('Enquiry'));
			$this->set('current_menu','Applicants');
			$this->_set_common_variables();

			$render_view = 'list_all_for_operator';
		
		//为了提供学生转到别的项目而需要的表单变量
		$this->loadModel('Group');
		$this->set('other_groups',$this->Group->find('list'));
		
		$this->render($render_view);
		return;
	}
	
	/**
	 * Enquiry可能需要的一些变量全部设置在这里
	 */
	private function _set_common_variables(){
		$this->set('by_group_id',$this->Session->read('my_group'));
		$this->set('is_applicant',0);
			//加入本组的宣讲会list，给搜索表单用
				$this->set('presentations',
					$this->Presentation->find('list',array(
						'conditions'=>array('Presentation.group_id'=>$this->Session->read('my_group'))))
				);
		//设置本组的还没有回访的学生数量
				$this->set('unfeedback_enquiry',$this->Enquiry->find('count',array(
					'conditions'=>array(
						'AND'=>array(
							'Enquiry.group_id'=>$this->Session->read('my_group'),
							'Enquiry.is_feedback'=>0,
							'Enquiry.is_applicant'=>0,
							'Enquiry.status'=>NORMAL
						)
					)
				)));
		
		$this->init_auto_complete_data();		
	}
	/*
	 * 运营部用这个方法来更新申请人的一些基本信息, ajax only.
	 */
	public function ajax_save_basic(){
		if ($this->request->is('ajax')) {
			$this->Enquiry->id = $this->request->data['enquiry_id'];
			$bean=array('Enquiry');
			foreach ($this->request->data as $key=>$value) {
				$bean['Enquiry'][$key]=$value;
			}
			if ($this->Enquiry->save($bean)) {
				$this->set('data',1);
			}else{
				$this->set('data',0);
			}
			$this->render('ajax_save_basic','ajax');
		}
		return;
	}
	
	public function remove($id=NULL){
		$this->Enquiry->id = $id;
		$msg_type = 'success';
		if ($this->Enquiry->exists()) {
			if($this->Enquiry->saveField('status',DELETED)){
				$this->Session->setFlash('删除成功');
			}else{
				$this->Session->setFlash('删除失败，请稍候再试');
				$msg_type = 'error';
			}
		}
		$this->redirect(array('action'=>'list_all_for_operator',$msg_type));
		return;
	}
	
	public function modify_contract($enquiry_id){
		if ($enquiry_id) {
			$this->Enquiry->id = $enquiry_id;
				//表示该纪录有效;
			$this->set('data',$this->Enquiry->read());
			/*
			$this->set('fee_types',$this->FeeType->find('list'));
			$this->set('apply_fee_status',$this->ApplyFeeStatus->find('list'));
			$this->set('contract_status',$this->ContractStatus->find('list'));
			$this->set('project_fee_status',$this->ProjectFeeStatus->find('list'));
			*/
		}
		return;
	}
	
	//运营部修改报名客户的合同和申请费信息的ajax方法
	public function ajax_save_contract(){
		if ($this->request->is('ajax')) {
			$this->Enquiry->id = $this->request->data['enquiry_id'];
			$bean=array('Enquiry');
			foreach ($this->request->data as $key=>$value) {
				$bean['Enquiry'][$key]=$value;
			}
			if ($this->Enquiry->save($bean)) {
				$this->set('data',1);
			}else{
				$this->set('data',0);
			}
			$this->render('ajax_save_basic','ajax');
		}
		return;
	}
	//销售部用来更新单个用户的money return返点的方法
	public function ajax_modify_money_return(){
		if ($this->request->is('ajax')) {
			$this->Enquiry->id = $this->request->data['enq_id'];
			
			if ($this->Enquiry->saveField('money_return_sum',$this->request->data['mr'])) {
				$this->set('data',1);
			}else{
				$this->set('data',0);
			}
			$this->render('ajax_save_basic','ajax');
		}
	}
	
	public function ajax_modify_app_form_status(){
		if ($this->request->is('ajax')) {
			$this->Enquiry->id = $this->request->data['enq_id'];
			if ($this->Enquiry->saveField('is_app_form_submit',$this->request->data['is_app_form_submit'])) {
				$data=1;
			}else{
				$data=0;
			}
			$this->set('data',$data);
			$this->render('ajax_save_basic','ajax');
		}
		return;
	}
	public function ajax_modify_slep_score(){
		if ($this->request->is('ajax')) {
			$this->Enquiry->id = $this->request->data['enq_id'];
			if ($this->Enquiry->saveField('slep_scores',$this->request->data['slep_scores'])) {
				$data=1;
			}else{
				$data=0;
			}
			$this->set('data',$data);
			$this->render('ajax_save_basic','ajax');
		}
		return;
	}
	
	public function ajax_modify_slep_exam_date(){
		if ($this->request->is('ajax')) {
			$this->Enquiry->id = $this->request->data['enq_id'];
			if ($this->Enquiry->saveField('exam_date',$this->request->data['exam_date'])) {
				$data=1;
			}else{
				$data=0;
			}
			$this->set('data',$data);
			$this->render('ajax_save_basic','ajax');
		}
		return;
	}
	
	/**
	 * 根据运营部的统计表中的数字，响应点击的方法
	 */
	public function show($name=NULL){
		$d = $this->Enquiry->$name($this->Session->read('my_group'),$this->Session->read('my_project'),FALSE);
		$this->set('data',$d);
		$this->set('no_pagi',1);
		$this->_set_common_variables();
		$this->set('action_name','list_all_for_operator');//为了导出文件的当前视图而设置
		$this->render('list_all_for_operator');
		return;
	}
	
	/**
	 * 申请人转为$project_id_to_be制定的项目
	 * @param Integer $enquiry_id 被转的申请人id
	 * @param Integer $project_id_to_be 被转到的project的id
	 */
	public function transfer(){
		$flag = TRUE;
		if ($this->request->data['Enquiry']['id']) {
			if ($this->Enquiry->exists($this->request->data['Enquiry']['id'])) {
				$ds = $this->Enquiry->getDataSource();
				$ds->begin();
				$this->Enquiry->id = $this->request->data['Enquiry']['id'];
				if($this->Enquiry->save($this->request->data)){
					if ($this->Enquiry->field('is_applicant')==1) {
						//this one has been an applicant
						$this->loadModel('Applicant');
						$temp_app = $this->Applicant->find('first',array('conditions'=>array('Applicant.enquiry_id'=>$this->request->data['Enquiry']['id']),'recursive'=>-1));
						if ($temp_app['Applicant']['id']) {
							$this->Applicant->id = $temp_app['Applicant']['id'];
							$bean = array();
							$bean['Applicant']['project_id']=$this->request->data['Enquiry']['project_id'];
							$bean['Applicant']['group_id']=$this->request->data['Enquiry']['group_id'];
							if (!$this->Applicant->save($bean)) {
								//update applicant project_id failed
								$flag=FALSE;
							}
						}
					}
				}else{
					//can not update the enquiry's project_id field
					$flag = FALSE;
				};
				if ($flag) {
					$ds->commit();
				}else{
					$ds->rollback();
				}
			}else{
				//no enquiry found
				$flag = FALSE;
			}
		}else{
			//no enquiry id
			$flag = FALSE;
		}
		if ($flag) {
			$msg_type = 'success';
			$this->Session->setFlash($this->Enquiry->field('name').'已经成功的被转到另外一个项目');
		}else{
			$msg_type = 'error';
			$this->Session->setFlash($this->Enquiry->field('name').'无法被转到另外一个项目');
		}
		$this->redirect(array('action'=>'list_all_for_operator',$msg_type));
		return;
	}
	
	/**
	 * 运营经理为运营助理分配任务的方法
	 */
	public function assign_to_operator_assistant(){
		$this->Enquiry->unbindModel(array(
			'belongsTo'=>array('Group','User','Project','Source','Presentation','Customer','ApplyFeeStatus','ContractStatus','ProjectFeeStatus'),
			'hasMany'=>array('EnquiryFeedback','MoneyReturn','Checkin'),
			'hasOne'=>array('Profile')
		));
		$assigned = $this->Enquiry->updateAll(
			array('Enquiry.user_id'=>$this->request->data['Enquiry']['user_id']),
			array('Enquiry.id IN('.$this->request->data['Enquiry']['student_ids'].')')
		);
		if ($assigned) {
			$msg_type = 'success';
			$this->Session->setFlash('分配成功。');
		}else{
			$msg_type = 'error';
			$this->Session->setFlash('分配失败，请稍候再试！');
		}
		$this->redirect(array('action'=>'list_all_for_operator',$msg_type));
		return ;
	}
}