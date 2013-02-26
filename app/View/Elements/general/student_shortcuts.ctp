<div class="box grid_16">
	<?php 
	echo $this->Html->link(
		'我的相册',
		array('controller'=>'Profiles','action'=>'add_photo',$this->Session->read('enquiry_id')),
		array('class'=>'short_message_btn')
	); 
	echo $this->Html->link(
		'我的Check-in',
		array('controller'=>'Profiles','action'=>'list_checkins'),
		array('class'=>'short_message_btn')
	); 
	echo $this->Html->link(
		'回国登记',
		array('controller'=>'Profiles','action'=>'return_request_form'),
		array('class'=>'short_message_btn')
	);
	?>
</div>