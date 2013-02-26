<div class="flat_area grid_16">
	<h2>Task's detail</h2>
</div>

<div class="box grid_16 tabs">
	<div id="tabs-1" class="block">
		<div class="box grid_16">
			<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
			?>
			<h2>&nbsp;</h2>
			<?php 
				echo $this->Form->create('Task');
				echo $this->Form->input('Task.id',array('type'=>'hidden','value'=>$data['Task']['id']));
			?>
				
				<fieldset class="label_side">
					<label>Project Name</label>
					<div><?php echo $data['Project']['name']; ?></div>
				</fieldset>
				<fieldset class="label_side">
					<label>Task Name</label>
					<?php 
						if ($current_user['role_id']==ADMIN) {
							?>
							<div>
								<?php echo $this->Form->input('Task.name',array('label'=>'','div'=>false,'value'=>$data['Task']['name'])); ?>
							</div>
							<?php
						}else{
							?>
							<div>
								<?php echo $data['Task']['name']; ?>
							</div>
							<?php
						}
					?>
				</fieldset>
				<fieldset class="label_side">
					<label>Assigned To</label>
					<?php 
						if ($current_user['role_id']==ADMIN) {
							?>
							<div>
								<?php echo $this->Form->input('Task.user_id',array('label'=>'','div'=>false,'value'=>$data['Task']['user_id'],'options'=>$users)); ?>
							</div>
							<?php
						}else{
							?>
							<div>
								<?php echo $data['User']['name']; ?>
							</div>
							<?php
						}
					?>
				</fieldset>
				<fieldset class="label_side">
					<label>Deadline</label>
					<?php 
						if ($current_user['role_id']==ADMIN) {
							?>
							<div>
								<?php echo $this->Form->input('Task.deadline_date',array('label'=>'','div'=>false,'default'=>$data['Task']['deadline_date'])); ?>
							</div>
							<?php
						}else{
							?>
							<div>
								<?php echo $data['Task']['deadline_date']; ?>
							</div>
							<?php
						}
					?>
				</fieldset>
				<fieldset class="label_side">
					<label>Priority</label>
					<?php 
						if ($current_user['role_id']==ADMIN) {
							?>
							<div>
								<?php echo $this->Form->input('Task.priority',array('label'=>'','div'=>false,'options'=>$priority,'value'=>$priority[$data['Task']['priority']])); ?>
							</div>
							<?php
						}else{
							?>
							<div>
								<?php echo $priority[$data['Task']['priority']]; ?>
							</div>
							<?php
						}
					?>
				</fieldset>
				<fieldset class="label_side">
					<label>Status</label>
					<div>
						<?php echo $this->Form->input('Task.status',array('label'=>'','div'=>false,'options'=>$task_status,'value'=>$data['Task']['status'])); ?>
					</div>
				</fieldset>
				<fieldset>
					<label>Description：<span>Anything important</span></label>
					<div class="clearfix">
						<?php 
							echo $this->Form->input(
									'Task.comments',
									array('label'=>'',
											'class'=>'tooltip autogrow',
											'title'=>"Auto size text area",
											'placeholder'=>'Click to input',
											'type'=>'textarea',
											'value'=>$data['Task']['comments'],
											'div'=>false));
						?>
					</div>
				</fieldset>
				<fieldset class="label_top">
					<p>&nbsp; </p>
					<div class="clearfix">
						<button class="green text_only has_text">
							<span>Save Now</span>
						</button>
					</div>
				</fieldset>
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>