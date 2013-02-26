<?php
	class Tag extends AppModel{
		public $name = 'Tag';
		public $hasMany = array('Note');
	}