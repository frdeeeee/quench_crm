<?php
	class MeetingUser extends AppModel{
		public $name = 'MeetingUser';
		public $belongsTo = array('Meeting','User');
		public $useTable = 'meeting_users';
	}