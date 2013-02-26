<?php
class GroupUser extends AppModel{
	public $name = 'GroupUser';
	public $useTable = 'group_users';
	public $belongsTo = array('User','Group');
	public $validate = array(
			'name' => array(
					'Please enter your name' => array(
							'rule' => 'notEmpty',
							'message' => '请输入用户组的名称!'
					)
			)
	);
}