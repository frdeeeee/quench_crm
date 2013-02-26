<?php
class Timesheet extends AppModel{
	public $name = 'Timesheet';
	public $useTable = 'crm_timesheets';
	public $belongsTo = array('User');
}