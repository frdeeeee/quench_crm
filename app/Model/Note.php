<?php
	class Note extends AppModel{
		public $name = 'Note';
		public $belongsTo = array('User','Tag');
		public $validate = array(
				'name' => array(
						'Please enter name' => array(
							'rule' => 'notEmpty',
							'message' => '便条必须要有一个标题!'	
							)
					),
			);
	}