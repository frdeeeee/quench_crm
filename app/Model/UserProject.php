<?php
	class UserProject extends AppModel{
		public $name = 'UserProject';
		public $belongsTo = array('User','Project');
		public $useTable = 'user_projects';
	}