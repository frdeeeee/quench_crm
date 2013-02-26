<?php
	class JobStatus extends AppModel{
		public $name = 'JobStatus';
		public $useTable = 'job_status';
		public $hasMany = array('Applicant');
	}