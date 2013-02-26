<?php
	class ShortMessage extends AppModel{
		public $name = 'ShortMessage';
		public $useTable = 'messages';
		
		public $belongsTo = array(
			'Sender'=>array(
				'className'=>'User',
				'foreignKey'=>'sender_id'
			),
			'Receiver'=>array(
				'className'=>'User',
				'foreignKey'=>'receiver_id'
			));
		
		public function send($bean = null){
			if ($bean) {
				return $this->save($bean);
			}else{
				return false;
			}
		}
	}