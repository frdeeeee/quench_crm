<?php
	class Orgnization extends AppModel{
		public $name = 'Orgnization';
		public $hasMany = array('Applicant');
	}