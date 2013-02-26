<?php
	/**
	 * 一个实际的项目，需要包括的信息有，客户信息，时间，项目状态，被分配的负责人
	 * @author  Justin Wang
	 *
	 */
	class Project extends AppModel{
		public $name = 'Project';
		public $hasMany = array('Task');
		public $belongsTo = array('User','Client'=>array());
		public $recursive = 1;
		
		public $validate = array(
			'name' => array(
						'Please enter your name' => array(
							'rule' => 'notEmpty',
							'message' => 'Please enter the project name!'	
							)
			)
		);
	}