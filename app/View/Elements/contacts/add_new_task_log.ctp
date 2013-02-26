<div style="display:none">
	<div id="add_new_task_log_form" style="width:700px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		Add a New Task
		<?php echo $this->Html->image('ajax_refresh.gif',array('style'=>'margin-top:-15px;float:right;display:none;','id'=>'icon_note_adding_refresh')); ?>&nbsp;
		</h2>
		<?php 
			echo $this->Form->create('WorkingLog');
			echo $this->Form->input('WorkingLog.user_id',array('type'=>'hidden','value'=>$current_user['id']));
		?>
		<fieldset class="label_side">
			<label>Contact Info</label>
				<div>
					<?php 
						echo $this->Form->input('WorkingLog.contact_id',array('type'=>'hidden'));
					?>
					<p id="working_log_current_contact_info" style="color: red"></p>
				</div>
		</fieldset>
		<?php 
			foreach ($task_fields as $key=>$value) {
				?>
						<fieldset class="label_side">
							<label><?php echo $value?> </label>
							<div>
							<?php echo $this->Form->input($key,array('label'=>'','div'=>false,'placeholder'=>$value)); ?>
							</div>
						</fieldset>
				<?php
			}
		?>
		<fieldset class="label_top">
			<p>&nbsp; </p>
			<div class="clearfix">
				<button class="green text_only has_text" id="save_working_log_ajax">
					<span>Save Now</span>
				</button>
			</div>
		</fieldset>
		<?php echo $this->Form->end();?>
	</div>
</div>