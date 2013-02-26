<?php
	class Message extends AppModel{
		public $name = 'Message';
		public $belongsTo = array(
			'Sender'=>array(
				'class'=>'User',
				'foreignKey'=>'sender_id'
			),
			'receiver'=>array(
				'class'=>'User',
				'foreignKey'=>'receiver_id'
			));
	}