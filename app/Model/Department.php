<?php
	class Department extends AppModel{
		public $name = 'Department';
		public $hasMany = array('User');
		//暂时不添加belongsTo的属性
		public $validate = array(
				'name' => array(
						'rule' => 'notEmpty',
						'message' => 'A Department must have a name!'
						)
				);
	}