<?php
	class Answer extends AppModel{
		public $name = 'Answer';
		public $hasMany = array('EnquiryFeedback');
	}