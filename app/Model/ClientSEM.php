<?php
	class ClientSEM extends AppModel{
		public $name = 'ClientSEM';
		public $useTable = 'crm_clients_sem';
		public $belongsTo = array('Client');
	}