<div style="display:none">
	<div id="leave_teacher_notes_form" style="width:700px;height:325px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		关于赴美系统的激活问题给学生留言
		<?php echo $this->Html->image('ajax_refresh.gif',array('style'=>'margin-top:-15px;float:right;display:none;','id'=>'icon_email_sending_refresh')); ?>&nbsp;
		</h2>
		<fieldset class="label_side">
			<label>留言内容</label>
				<div>
					<?php 
						echo $this->Form->input('Profile.teacher_notes',array('label'=>'','div'=>false,'type'=>'textarea'));
					?>
				</div>
		</fieldset>
		<div class="short_message_btn" id="leave_teacher_note_submit">提交</div>
	</div>
</div>