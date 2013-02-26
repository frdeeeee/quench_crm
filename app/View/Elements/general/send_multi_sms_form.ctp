<div style="display:none">
	<div id="sms_send_all_selected_form" style="width:700px;height:450px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		向所有选择的报名学生发送手机短信
		<?php echo $this->Html->image('ajax_refresh.gif',array('style'=>'margin-top:-15px;float:right;display:none;','id'=>'icon_sms_sending_multi_refresh')); ?>&nbsp;
		</h2>
		<?php 
			echo $this->Form->create();
		?>
		<fieldset class="label_side">
			<label>选择短信模板</label>
				<div>
					<?php 
						echo $this->Form->input('Sms.texting_template_id',array('label'=>false,'div'=>false,'empty'=>'请选择模板...','options'=>array(),'disabled'=>'disabled'));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>短信内容：</label>
				<div>
					<?php 
						echo $this->Form->input('Sms.texting_template_content',array('label'=>false,'div'=>false,'type'=>'textarea'));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>收信人列表：</label>
				<div id="receivers_wrapper">
					
				</div>
		</fieldset>
		<div id="sms_multi_send_btn" class="short_message_btn">
				开始发送
		</div>
		<div id="sms_load_template_btn" class="short_message_btn">
				加载短信模板
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>
<!-- the hiding form for multiple emails sending  -->