<?php
class VisaStatus extends AppModel{
	public $name = 'VisaStatus';
	public $useTable = 'visa_status';
	public $hasMany = array('Applicant');
}