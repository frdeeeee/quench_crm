<div style="display:none">
	
	<div id="admin_add_new_project_form" style="width:700px;height:auto;overflow:auto;">
		<h2 style="margin-top: 10px;">
		New Project
		</h2>
		<?php 
			echo $this->Form->create('Project',array('action'=>'add_new')); 
			
			foreach ($bean_fields as $key=>$value) {
				if ($key=='Project.client_id') {
					?>
					<fieldset class="label_side">
						<label><?php echo $value?> </label>
						<div>
						<?php
						echo $this->Form->input($key,array('label'=>'','div'=>false,'options'=>$clients_list,'empty'=>'Choose One ...'));
						?>
						</div>
					</fieldset>
					<?php
				}else if ($key=='Project.user_id') {
					?>
					<fieldset class="label_side">
						<label><?php echo $value?> </label>
						<div>
						<?php
						echo $this->Form->input($key,array('label'=>'','div'=>false,'options'=>$users_list,'empty'=>'Choose One ...'));
						?>
						</div>
					</fieldset>
					<?php
				}else if ($key=='Project.status') {
					?>
					<fieldset class="label_side">
						<label><?php echo $value?> </label>
						<div>
						<?php
							echo $this->Form->input($key,array('label'=>'','div'=>false,'options'=>$project_status));
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
		<fieldset class="label_top">
			<p>&nbsp; </p>
			<div class="clearfix">
				<button class="green text_only has_text" id="save_contact_ajax">
					<span>Create Now</span>
				</button>
			</div>
		</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
	
</div>