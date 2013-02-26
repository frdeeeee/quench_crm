<?php
	class ClientAccounting extends AppModel{
		public $name = 'ClientAccounting';
		public $useTable = 'crm_clients_accoutings';
		public $belongsTo = array('Client');
	}