<?php
class TasksController extends AppController{
	public $uses = array('Project','Task','User');
	public $name = 'Tasks';
	
	private $task_status = array('Not Start','In Progress','Finished');
	private $task_types = array('Data Entry','Development','Graphic Design','Trouble Shooting');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('ajax_get_tasks_by_group'));
		$this->set('priority',array('Normal','Urgent'));
		$this->set('task_status',$this->task_status);
		$this->set('task_types',$this->task_types);
	}
	public function beforeRender(){
		$this->set('current_menu','Projects');
	}
	
	public function update_deadline($project_id = NULL){
		$this->layout = 'ajax';
		if ($this->request->is('ajax')) {
			$result = array();
			$this->Task->id = $this->request->data['id'];
			if ($this->Task->exists()) {
				$current_deadline = $this->Task->field('deadline_date');
				$diff = 60*60*24*$this->request->data['dayDelta'];
				$t_data = date('Y-m-d',strtotime($current_deadline)+$diff);
				if ($this->Task->saveField('deadline_date',$t_data)) {
					$result['deadline_date'] = $t_data;
				}else{
					$result['deadline_date'] = 0;
				}
			}
			$this->set('data',$result);
			$this->render('ajax_view');
		}
		return;
	}
	
	/**
	 * 这个方法是在拥护登陆得时候，即时根据拥护选择的工作组找出对应的任务的
	 * Enter description here ...
	 */
	public function ajax_get_tasks_by_group(){
		if ($this->request->is('ajax')) {
			$this->set('data',$this->Task->find('all',array(
				'conditions'=>array(
					'Task.group_id'=>$this->request->data['group_id']
				),
				'fields'=>array('Project.id','Task.name')
			)));
			$this->render('ajax_view','ajax');
		}else{
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		return;
	}
	

	public function list_all($msg_type=null){
		$conditions = array('Task.status != '.TASK_FINISHED);
		if ($this->Auth->user('role_id')!=ADMIN) {
			$conditions = array(
				'and'=>array(
					'Task.user_id'=>$this->Auth->user('id'),
					'Task.status != '.TASK_FINISHED
				)
			);
		}
		$data = $this->Task->find('all',array(
			'conditions'=>$conditions,
			'order'=>array('Task.id ASC')
		));
		$this->set('data',$data);
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);
		}
		return;
	}
	
	/*
	 * 创建一个task，根据给定的project id
	 */
	public function add($project_id = 0){
		if (empty($this->request->data)) {
			if ($project_id != 0) {
				$this->set('project',$this->Project->findById($project_id));
			}
			$this->set('project_id',$project_id);
			$this->set('project_name',$this->Project->find('first',array('fields'=>array('Project.name'),'conditions'=>array('Project.id'=>$project_id))));
			$this->set('users_list',$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id != '.ADMIN))));
			$this->set('bean_fields',$this->_get_fields('Task'));
		}else{
			if ($this->Task->saveAndUpdate($this->request->data)) {
				$this->Session->setFlash('New task has been created successfully!');
				$this->redirect(array('controller'=>'Projects', 'action'=>'list_all','success'));
			}else{
				//ADD失败
				$this->set('project_id',$project_id);
				$this->set('project_name',$this->Project->find('first',array('fields'=>array('Project.name'),'conditions'=>array('Project.id'=>$project_id))));
				$this->set('users_list',$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id != '.ADMIN))));
				$this->set('msg_type','error');
				$this->Session->setFlash('Add new task failed, please try again.!');
				$this->set('bean_fields',$this->_get_fields('Task'));
			}
		}
		return;
	}
	
	public function modify($task_id = null){
		if (empty($this->request->data)) {
			$this->set('data',$this->Task->findById($task_id));
			$this->set('users',$this->User->find('list',array('fields'=>array('id','name'))));
		}else{
			$this->Task->id = $this->request->data['Task']['id'];
			if ($this->Task->saveAndUpdate($this->request->data)) {
				$this->Session->setFlash('Task has been updated successfully!');
				$this->redirect(array('controller'=>'Projects', 'action'=>'list_all','success'));
			}else{
				$this->set('msg_type','error');
				//$this->set('projects',$this->Project->find('list'));
				$this->set('data',$this->Task->findById($task_id));
				$this->Session->setFlash('Can not update the task, please try later!');
			}
		}
		return;
	}
	
	public function remove($task_id = null){
		if (!is_null($task_id)) {
			$this->Task->id = $task_id;
			if($this->Task->deleteAndUpdate($task_id)){
				$this->Session->setFlash('One task has been deleted successfully!');
				$this->redirect(array('controller'=>'Projects', 'action'=>'view_detail',$task_id,'success'));
			}else{
				$this->Session->setFlash('Can not delete this task, please try later!');
				$this->redirect(array('controller'=>'Projects', 'action'=>'view_detail',$task_id,'error'));
			}
		}
		return;
	}
}