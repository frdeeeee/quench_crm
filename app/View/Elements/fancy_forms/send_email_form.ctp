<div style="display:none">
	<div id="send_email_form" style="width:700px;height:375px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		向报名学生发送电子邮件
		<?php echo $this->Html->image('ajax_refresh.gif',array('style'=>'margin-top:-15px;float:right;display:none;','id'=>'icon_email_sending_refresh')); ?>&nbsp;
		</h2>
		<?php 
			echo $this->Form->create();
		?>
		<fieldset class="label_side">
			<label>收信人邮件</label>
				<div>
					<?php 
						echo $this->Form->input('Email.address',array('label'=>'','div'=>false,'type'=>'text','disabled'=>'disabled'));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>邮件标题</label>
				<div>
					<?php 
						echo $this->Form->input('Email.subject',array('label'=>'','div'=>false,'type'=>'text'));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>内容：</label>
				<div>
					<?php 
						echo $this->Form->input('Email.content',array('label'=>false,'div'=>false,'type'=>'textarea'));
					?>
				</div>
		</fieldset>
		<div id="email_send_btn" class="short_message_btn">
				发送邮件
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>