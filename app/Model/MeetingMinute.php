<?php
class MeetingMinute extends AppModel{
	public $name = 'MeetingMinute';
	public $belongsTo = array('Meeting','User');
	public $useTable = 'meeting_minutes';
}