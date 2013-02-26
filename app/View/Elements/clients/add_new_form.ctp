<div class="box grid_16">
	<div style="display: none" id="is_form_updated">1</div>
	<?php
		echo $this->Form->create('Contact',array('id'=>'ContactListAllForm'));
		echo $this->Form->input('Contact.created_by',array('type'=>'hidden','value'=>$current_user['id']));
	?>
		<fieldset class="label_side">
				<label>Created/Updated</label>
				<div>
				<p id="contact_modified_text"></p>
				</div>
		</fieldset>
	<?php
		foreach ($contact_fields as $key=>$value) {
		if ($key=="Contact.type_id") {
			?>
			<fieldset class="label_side">
				<label><?php echo $value?> </label>
				<div>
				<?php
				echo $this->Form->input($key,array('label'=>'','div'=>false,'options'=>$contact_types));
				?>
				</div>
			</fieldset>
		<?php
		}else if($key=="Contact.lead_id"){
			?>
			<fieldset class="label_side">
				<label><?php echo $value?> </label>
				<div>
				<?php
				echo $this->Form->input($key,array('label'=>'','div'=>false,'options'=>$customer_types));
				?>
				</div>
			</fieldset>
			<?php
		}else if($key=="Contact.created_by"){
			?>
			<fieldset class="label_side">
				<label><?php echo $value?> </label>
				<div>
				<?php
					echo $this->Form->input($key,array('label'=>'','div'=>false,'options'=>$sales_person));
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
				<span>Save Now</span>
			</button>
		</div>
	</fieldset>
	<?php echo $this->Form->end();?>
</div>
<div style="display: none" id="contact_confirm_change_or_ignore" class="dialog_window">
	<p>
		<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
		The current contact info has been changed.
	</p>
</div>