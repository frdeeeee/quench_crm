<?php
	class ClientSocial extends AppModel{
		public $name = 'ClientSocial';
		public $useTable = 'crm_clients_socials';
		public $belongsTo = array('Client');
	}