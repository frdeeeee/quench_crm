<?php
	class MessagesController extends AppController{
		public $name = 'Messages';
		public $uses = array('Message','User');
		public $helpers = array('Html','Form');
		
		public function add(){
			if (!empty($this->request->data)) {
				;
			}
		}
		public function list_all(){
			
		}
		public function remove($message_id = null){
			
		}
	}