<div style="display:none">
	<div id="send_sms_form" style="width:700px;height:315px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		向报名学生发送手机短信
		<?php echo $this->Html->image('ajax_refresh.gif',array('style'=>'margin-top:-15px;float:right;display:none;','id'=>'icon_sms_sending_refresh')); ?>&nbsp;
		</h2>
		<?php 
			echo $this->Form->create();
		?>
		<fieldset class="label_side">
			<label>收信人</label>
				<div>
					<?php 
						echo $this->Form->input('Sms.receiver_id',array('label'=>'','div'=>false,'type'=>'text','disabled'=>'disabled'));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>内容：</label>
				<div>
					<?php 
						echo $this->Form->input('Sms.content',array('label'=>false,'div'=>false,'type'=>'textarea'));
					?>
				</div>
		</fieldset>
		<div id="sms_send_btn" class="short_message_btn">
				立即发送
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>