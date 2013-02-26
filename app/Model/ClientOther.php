<?php
	class ClientOther extends AppModel{
		public $name = 'ClientOther';
		public $useTable = 'crm_clients_other';
		public $belongsTo = array('Client');
	}