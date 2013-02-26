<?php
class WorkingLog extends AppModel{
	public $name = 'WorkingLog';
	public $belongsTo = array('Contact');
	public $order = array('WorkingLog.modified DESC','WorkingLog.created DESC');
}