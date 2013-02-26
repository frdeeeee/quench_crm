<?php
/**
 * task表示的是一项销售任务，根据特定的project来建立，每个task有特定的任务值，也同时分配给特定的user，一般应该是项目经理级别的员工
 * @author justin
 *
 */
App::import('model','Project');
class Task extends AppModel{
	public $name = 'Task';
	public $belongsTo = array('Project','User');
	//暂时不添加belongsTo的属性
	public $validate = array(
			'name' => array(
					'rule' => 'notEmpty',
					'message' => 'Plase input the task name!'
			),
			'user_id' => array(
					'rule' => 'notEmpty',
					'message' => 'Assign to can not be blank!'
			)
	);
	
	public function find_my_tasks($group_id = NULL){
		$this->unbindModel(array('belongsTo'=>array('User')));
		return $this->find('all',array(
			'conditions'=>array('Task.group_id'=>$group_id)
		));
	}
	
	
	/**
	 * 功能：在添加销售任务之后，要更新Project的assigned字段，表示该Project规定的总的销售任务已经分配出去了多少
	 * @param mixed $data
	 */
	public function saveAndUpdate($data=null){
		if (!is_null($data)) {
			$dataSource = $this->getDataSource();
			$dataSource->begin();
			
			if ( $this->save($data)) {
				$dataSource->commit();
				return true;
			}else{
				$dataSource->rollback();
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function deleteAndUpdate($task_id=NULL){
		if (!is_null($task_id)) {
			$this->id = $task_id;
			if ( $this->delete($task_id)) {
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}