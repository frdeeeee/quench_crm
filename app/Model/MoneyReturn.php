<?php
	class MoneyReturn extends AppModel{
		public $name = 'MoneyReturn';
		public $useTable = 'money_returns';
		
		public $belongsTo = array('Enquiry','Customer');
	}