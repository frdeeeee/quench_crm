<div class="flat_area grid_16">
	<h2>Create a Task</h2>
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
				if(isset($project)){
					//表示指定了project
					echo $this->Form->input('Task.project_id',array('type'=>'hidden','value'=>$project_id));
				}
			?>
				
						<?php 
							if (isset($project_name)) {
								?>
								<fieldset class="label_side">
									<label>Project Name</label>
									<div>
										<?php echo $project_name['Project']['name'];?>
									</div>
								</fieldset>
								<?php
							}
						?>
				<?php 
						
						foreach ($bean_fields as $key=>$value) {
							if ($key=='Task.user_id') {
								?>
								<fieldset class="label_side">
									<label><?php echo $value?> </label>
									<div>
									<?php
									echo $this->Form->input($key,array('label'=>'','div'=>false,'options'=>$users_list,'empty'=>'Choose One ...','style'=>'width:100%;'));
									?>
									</div>
								</fieldset>
								<?php
							}else if ($key=='Task.priority') {
								?>
								<fieldset class="label_side">
									<label><?php echo $value?> </label>
									<div>
									<?php
										echo $this->Form->input($key,array('label'=>'','div'=>false,'options'=>$priority,'style'=>'width:100%;'));
									?>
									</div>
								</fieldset>
								<?php
							}else if ($key=='Task.task_type') {
								?>
								<fieldset class="label_side">
									<label><?php echo $value?> </label>
									<div>
									<?php
										echo $this->Form->input($key,array('label'=>'','div'=>false,'options'=>$task_types,'style'=>'width:100%;'));
									?>
									</div>
								</fieldset>
								<?php
							}else if($key=='Task.comments'){
								?>
									<fieldset class="label_side">
										<label><?php echo $value?> </label>
										<div>
										<?php
										echo $this->Form->input(
												$key,
												array('label'=>'','div'=>false,'class'=>'tooltip autogrow','title'=>"Auto size field",'placeholder'=>$value)
										);
										?>
										</div>
									</fieldset>
								<?php
							}else{
								?>
									<fieldset class="label_side">
										<label><?php echo $value?> </label>
										<div>
										<?php
										echo $this->Form->input($key,array('label'=>'','div'=>false,'placeholder'=>$value));
										?>
										</div>
									</fieldset>
								<?php
							}
						}
				?>
				<fieldset class="label_side">
					<p>&nbsp;</p>
					<button class="green full_width">
						<div class="ui-icon ui-icon-carat-1-n"></div>
						<span>Confirm</span>
					</button>
				</fieldset>
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>