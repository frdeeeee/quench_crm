<div id="loading_overlay">
	<div class="loading_message round_bottom">
		<?php echo $this->Html->image('loading.gif',array('alt'=>'页面加载中')); ?>
	</div>
</div>
<div style="display:none">
	<div id="short_message_send_form_wrapper" style="width:700px;height:315px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		站内短信
		<?php echo $this->Html->image('ajax_refresh.gif',array('style'=>'margin-top:-15px;float:right;display:none;','id'=>'icon_message_sending_refresh')); ?>&nbsp;
		</h2>
		<?php 
			echo $this->Form->create();
		?>
		<fieldset class="label_side">
			<label>收件人</label>
				<div>
					<?php 
						echo $this->Form->input('ShortMessage.sender_id',array('type'=>'hidden','value'=>$this->Session->read('enquiry_id')));
						echo $this->Form->input('ShortMessage.receiver_id',array('type'=>'hidden','value'=>$this->Session->read('teacher_id')));
					?>
					<p style="color: red"><b><?php echo $this->Session->read('teacher_name');?></b></p>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>内容：</label>
				<div>
					<?php 
						echo $this->Form->input('ShortMessage.content',array('label'=>false,'div'=>false,'type'=>'textarea','value'=>'您好，我是'.$this->Session->read('enquiry_name')));
					?>
				</div>
		</fieldset>
		<div id="short_message_send_btn" class="short_message_btn">
				立即发送
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>
