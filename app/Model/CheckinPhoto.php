<?php
	class CheckinPhoto extends AppModel{
		public $name = 'CheckinPhoto';
		public $belongsTo = array('Enquiry');
		public $validate = array(
			'title' => array(
				'Please enter your title' => array(
					'rule' => 'notEmpty',
					'message' => '上传的照片必须要有一个标题!'	
				)
			)
		);
	}