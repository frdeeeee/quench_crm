<?php
class ProjectsController extends AppController{
	public $uses = array('Project','Task','Contact','User');
	public $name = 'Projects';
	
	public $paginate = array(
			'limit' => 20,
			'order' => array(
					'Project.deadline'=>'DESC',
					'Project.name'=>'ASC'
			)
	);

	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('project_status',array('Please Choose..','Staging','In progress','Completed'));
	}
	public function beforeRender(){
		$this->set('current_menu','Projects');
	}
	
	public function view_detail( $project_id = NULL, $msg_type=NULL ){
		$this->set('data',$this->Project->find('first',array('fields'=>array('id','name','comments','created'),'recursive'=>-1 ,'conditions'=>array('Project.id'=>$project_id))));
		$this->set('projects',$this->Project->find('list'));
		if ($msg_type) {
			$this->set('msg_type',$msg_type);
		}
		return;
	}
	
	//响应full calendar的load events的ajax调用的函数，
	//调用的url为/myfeed.php?start=1262332800&end=1265011200&_=1263178646
	public function ajax_load_project_tasks(){
		$this->layout = 'ajax';
		if ($this->request->is('ajax')) {
			$data = $this->Task->find('all',array(
				'conditions'=>array('Task.project_id'=>$this->request->data['project_id']),
				'fields'=>array('id','name','created','deadline_date','status','modified'),
				'recursive'=>-1
			));
			
			$this->set('data',$this->_full_calendar_event_data_transfer($data));
			$this->render('ajax');
		}
		return ;
	}
	
	private function _full_calendar_event_data_transfer( $data = array() ){
		$json_data_array = array();
		$class_name = array('calendar_red','calendar_blue','calendar_green');
		$one_day = 60*60*24;
		if (!is_null($data)) {
				foreach ($data as $value) {
					$d = array(
						'title'=>$value['Task']['name'],
						'id'=>$value['Task']['id'],
						'className'=> $class_name[$value['Task']['status']],
						'controller'=>'Tasks'
					);
					if ($value['Task']['status']==TASK_FINISHED) {
						$d['start'] = date('Y-m-d',strtotime($value['Task']['modified']));
					}else{
						
						$d['start'] = date('Y-m-d',strtotime($value['Task']['deadline_date']));
					}
					$json_data_array[] = $d;
				}
		}
		return $json_data_array;
	}
	
	public function search(){
		$data = $this->Project->find('all',array(
			'conditions'=>array(
				'Project.name LIKE "%'.$this->request->data['Project']['name'].'%"'
			)
		));
		$this->set('data',$data);
		$this->set('no_pagi',TRUE);//不需要pagination
		$this->render('list_all');
	}

	public function list_all($msg_type = null){
		$this->set('data',$this->paginate('Project'));
		//取出project需要的字段，用来給增加项目表格用
		$this->set('bean_fields',$this->_get_fields('Project'));
		$this->set('clients_list',$this->Contact->find('list',array('fields'=>array('id','name'))));
		$this->set('users_list',$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id != '.ADMIN))));
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);
		}
		return;
	}
	
	public function remove($project_id=NULL){
		if ($project_id) {
			$this->Project->id = $project_id;
			if ($this->Project->delete($project_id)) {
				$this->Session->setFlash('A project has been removed successfully!');
				$this->redirect(array('action'=>'list_all','success'));
			}else{
				$this->set('msg_type','error');
				$this->Session->setFlash('Can not remove this project, pelase try later');
			}
		}
		return ;
	}
	
	/**
	 * 专用的管理员增加项目的方法
	 */
	public function add_new(){
		if (empty($this->request->data)) {
			//
		}else{
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash('Project- '.$this->request->data['Project']['name'].'- has been created!');
				$this->redirect(array('action'=>'list_all','success'));
			}else{
				//更新失败
				//取出project需要的字段，用来給增加项目表格用
				$this->set('bean_fields',$this->_get_fields('Project'));
				$this->set('clients_list',$this->Contact->find('list',array('fields'=>array('id','name'))));
				$this->set('users_list',$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id != '.ADMIN))));
				$this->set('msg_type','error');
				$this->Session->setFlash('Can not create project "'.$this->request->data['Project']['name'].'", please try later.');
			}
		}
		return;
	}
	
	public function modify($project_id =null){
		if (empty($this->request->data)) {
			$this->set('data',$this->Project->findById($project_id));
		}else{
			$this->Project->id = $this->request->data['Project']['id'];
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['Project']['name'].' updated successfully!');
				$this->redirect(array('action'=>'list_all','success'));
			}else{
				//更新失败
				$this->set('msg_type','error');
				$this->Session->setFlash('Failed to updated project: '.$this->request->data['Project']['name'].', please try later!');
			}
		}
		return;
	}
	
}