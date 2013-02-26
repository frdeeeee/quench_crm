<?php
class WorkingLogsController extends AppController{
	public $uses = array('WorkingLog');
	public $name = 'WorkingLogs';
	
	public $paginate = array(
			'limit' => 20,
			'order' => array(
				'WorkingLog.created'=>'DESC',
				'WorkingLog.id'=>'DESC'
			),
			'recursive' => 1
	);

	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function remove($id = NULL){
		if (!is_null($id)) {
			$this->WorkingLog->id = $id;
			if ($this->WorkingLog->delete($id)) {
				$this->Session->setFlash('The task has been removed successfully!');
				$this->redirect(array('action'=>'list_all','success'));;
			}else{
				$this->set('msg_type','error');
				$this->Session->setFlash('Can not remove the task info, please try later or contact Administrator.');
			}
		}
		return;
	}
	
	public function modify($id = NULL){
		if (empty($this->request->data)) {
			$this->set("data",$this->WorkingLog->findById($id));
		}else{
			$this->WorkingLog->id = $this->request->data['WorkingLog']['id'];
			if ($this->WorkingLog->save($this->request->data)) {
				$this->Session->setFlash('The task has been updated successfully!');
				$this->redirect(array('action'=>'list_all','success'));;
			}else{
				$this->set('msg_type','error');
				$this->Session->setFlash('Can not update the task info, please try later or contact Administrator.');
			}
		}
		return;
	}
	
	public function ajax_add_new(){
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			if($this->WorkingLog->save($this->request->data)){
				/**
					如果出入成功，则返回最新的20个task到客户端，让客户端进行刷新
				 */
				
				$this->set('data',array(
					'result'=>$this->WorkingLog->getID(),
					'tasks'=>$this->_load_tasks_for_ajax()
					)
				);
			}else{
				$this->set('data',array('result'=>0));
			}
			$this->render('ajax');
		}
		return;
	}
	
	public function ajax_list_current_contact_task_logs(){
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			$this->set('data',array(
					'tasks'=>$this->_load_tasks_for_ajax($this->request->data['current_contact_id'])
				)
			);
			$this->render('ajax');
		}
		return;
	}
	
	public function ajax_list_all(){
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			$this->set('data',array(
					'tasks'=>$this->_load_tasks_for_ajax()
				)
			);
			$this->render('ajax');
		}
		return;
	}
	private function _load_tasks_for_ajax($contact_id = NULL){
		$this->paginate['fields']=array(
					'WorkingLog.id','WorkingLog.name','WorkingLog.created','WorkingLog.next_appointment_date',
					'Contact.id','Contact.first_name','Contact.last_name','Contact.company'
				);
		if (is_null($contact_id)) {
			$this->paginate['conditions']=array(
				'WorkingLog.user_id'=>$this->Auth->user('id')
			);
		}else{
			$this->paginate['conditions']=array(
			   'and'=>array(
					'WorkingLog.user_id'=>$this->Auth->user('id'),
					'WorkingLog.contact_id'=>$contact_id
				)
			);
		}
		return $this->paginate('WorkingLog');
	}
	
	
	public function view_detail($workingLog_id = NULL){
		if (!is_null($workingLog_id)) {
			$data = $this->WorkingLog->findById($workingLog_id);
			$this->set('data',$data);
		}
		return;
	}
	
	public function add_feedback($workingLog_id = NULL){
		if ( !empty($this->request->data)) {
			$bean = array(
				'WorkingLogFeedback'=>array(
					'working_log_id'=>$this->request->data['WorkingLog']['id'],
					'content'=>$this->request->data['WorkingLog']['feedback_content'],
					'user_id'=>$this->Auth->user('id')
				)
			);
			if ($this->WorkingLogFeedback->add_feedback($bean)) {
				$this->Session->setFlash('工作记录批示添加成功!');
				$this->redirect(array('action'=>'list_all','success'));
			}else{
				$this->set('msg_type','error');
				$this->Session->setFlash('无法添加您的批示, 请稍候再试!');
			}
		}else{
			$this->set('data',$this->WorkingLog->findById($workingLog_id));
		}
		return ;
	}
		
	/**
	 * For admin and Director use only
	 * @param Integer $group_id
	 */
	public function list_all_by_group_id( $group_id){
		$this->list_all_common_tasks();
		$this->paginate['conditions'] = array('WorkingLog.group_id'=>$group_id);
		$this->set('data',$this->paginate('WorkingLog'));
		$this->render('list_all');
		return;
	}

	/**
	 * 这个方法是根据指定的c id，列出指定的user的所有工作记录,如果没有指定，则表示列出自己的
	 * @param Integer $contact_id
	 */
	public function list_all_by_contact( $contact_id = NULL ){
		$this->paginate['conditions']=array(
			'AND'=>array(
				'WorkingLog.user_id'=>$this->Auth->user('id'),
				'WorkingLog.contact_id'=>$contact_id
			)	
		);
		$this->set('data',$this->paginate('WorkingLog'));
		$this->render('list_all');
		return;
	}
	
	/**
	 * 这个方法是根据指定的用户id，列出指定的user的所有工作记录,如果没有指定，则表示列出自己的
	 * @param Integer $user_id
	 */
	public function list_all( $msg_type = null){
		//$this->list_all_common_tasks();
		$this->set('data',$this->paginate('WorkingLog'));
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);
		}
		return;
	}
	
	private function list_all_common_tasks(){
		//找到所属的组，需要字符串形式来构建 IN 查询子句
		if ($this->Auth->user('role_id') == SALES_DIRECTOR || $this->Auth->user('role_id')==ADMIN) {
			//管理员或者总监可以直接提取所有纪录
			$this->set('tasks',$this->Task->find('list'));
			$this->set('customers',$this->Customer->find('list'));
		}else{
			$this->set('tasks',$this->Task->find(
					'list',
					array(
						'conditions' => array('Task.user_id'=>$this->Session->read('my_group_leader'))
					)
				));
			$this->set('customers',$this->Customer->find('list',array('conditions'=>array('Customer.group_id'=>$this->Session->read('my_group')))));
			$this->paginate['conditions'] = array('WorkingLog.group_id'=>$this->Session->read('my_group'));
		}
		//$this->set('provinces',$this->Province->find('list'));
		//$this->set('customer_types',$this->CustomerType->find('list'));
	}
	
}