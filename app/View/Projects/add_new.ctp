<div class="flat_area grid_16">
	<h2>Create new project</h2>
</div>
<div class="box grid_16">
	<?php 
		if (isset($msg_type)) {
			echo $this->Msg->output( $msg_type,$this->Session->flash() );
		};
	?>
	<div  class="box grid_16">
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
						echo $this->Form->input($key,array('label'=>'','div'=>false,'options'=>$clients_list));
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
						echo $this->Form->input($key,array('label'=>'','div'=>false,'options'=>$users_list));
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
							$project_status = array('Please Choose..','Staging','In progress','Completed');
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
							echo $this->Form->input($key,array('label'=>'','div'=>false,'type'=>'text','placeholder'=>$value));
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