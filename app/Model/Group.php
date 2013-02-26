<?php
class Group extends AppModel{
	public $name = 'Group';
	public $hasMany = array(
		'GroupUser'=>array(
			'recursive'=>-1
		),
		'WorkingLog',
		'Presentation'=>array(
			'conditions'=>array('available=1'),
			'order'=>array('hold_on DESC')
			),
		'Enquiry','Task');
			
	public $belongsTo = array('Leader'=>array(
				'className'=>'User',
				'foreignKey' => 'group_leader',
				'recursive' => 1,
			));
			
	public $validate = array(
			'name' => array(
					'Please enter your name' => array(
							'rule' => 'notEmpty',
							'message' => '请输入用户组的名称!'
					)
			)
	);
	
	/**
	 * All group's info for admin, recursive set to 2 if for get the user's name 
	 */
	public function get_groups_info(){
		$this->unbindModel(array('hasMany'=>array('WorkingLog','Presentation','Enquiry')));
		return $this->find('all',array('conditions'=>array('Group.available'=>1),'order'=>array('Group.modified DESC'),'recursive'=>2));
	}
	
	public function get_detail($group_id = NULL){
		//$this->unbindModel(array('hasMany'=>array('WorkingLog','Enquiry')));
		$this->unbindModel(array('belongsTo'=>array('Leader'),'hasMany'=>'GroupUser'));
		return $this->find('first',array(
			'conditions'=>array('Group.id'=>$group_id),
			'recursive'=>1
		));
	}
}