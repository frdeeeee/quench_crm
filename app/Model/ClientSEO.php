<?php
	class ClientSEO extends AppModel{
		public $name = 'ClientSEO';
		public $useTable = 'crm_clients_seo';
		public $belongsTo = array('Client');
	}