<div style="display:none">
	<div id="short_message_send_form_wrapper" style="width:700px;height:315px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		New Message
		<?php echo $this->Html->image('ajax_refresh.gif',array('style'=>'margin-top:-15px;float:right;display:none;','id'=>'icon_message_sending_refresh')); ?>&nbsp;
		</h2>
		<?php 
			echo $this->Form->create();
		?>
		<fieldset class="label_side">
			<label>To:</label>
				<div>
					<?php 
						echo $this->Form->input('ShortMessage.sender_id',array('type'=>'hidden','value'=>$current_user['id']));
						echo $this->Form->input('ShortMessage.receiver_id',array('label'=>'','div'=>false,'options'=>$receivers,'empty'=>'Choose one...'));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>Content:</label>
				<div>
					<?php 
						echo $this->Form->input('ShortMessage.content',array('label'=>false,'div'=>false,'type'=>'textarea'));
					?>
				</div>
		</fieldset>
		<div id="short_message_send_btn" class="short_message_btn">
				Send
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>