<?php
	class ClientWebhosting extends AppModel{
		public $name = 'ClientWebhosting';
		public $useTable = 'crm_clients_web_hostings';
		public $belongsTo = array('Client');
	}