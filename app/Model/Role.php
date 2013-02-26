<?php
	class Role extends AppModel{
		public $name = 'Role';
		public $hasMany = array('User');
		//暂时不添加belongsTo的属性
		public $validates = array(
				'name' => array(
						'rule' => 'notEmpty',
						'message' => 'A Role must have a name!'
						)
				);
	}