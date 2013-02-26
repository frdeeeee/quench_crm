<?php
	class Reason extends AppModel{
		public $name = 'Reason';
		public $hasMany = array('EnquiryFeedback');
	}