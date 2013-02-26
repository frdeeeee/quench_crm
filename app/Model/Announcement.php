<?php 
	class Announcement extends AppModel{
		public $name = 'Announcement';
		
		public $validate = array(
			'name' => array(
					'Please enter your name' => array(
							'rule' => 'notEmpty',
							'message' => '请输入公告的名称!'
					)
			)
		);
	}
?>