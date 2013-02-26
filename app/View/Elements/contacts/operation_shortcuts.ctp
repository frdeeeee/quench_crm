<div class="box grid_16">
	<button class="blue text_only has_text" id="clear_contact_form" style="margin-top: 11px;margin-left:10px;">
				<span>Add New Contact</span>
	</button>
	<a id="add_new_task_log_btn" class="short_message_btn" href="#add_new_task_log_form">
		Add new task log
	</a>
	<a id="view_all_task_logs_btn" class="short_message_btn" href="#view_all_task_logs">
		View all task logs
	</a>
	<a id="view_current_contact_task_logs_btn" class="short_message_btn" href="#view_all_task_logs">
		Current task logs
	</a>
	<?php 
		echo $this->element('contacts/add_new_task_log'); 
		echo $this->element('contacts/view_all_task_logs'); 
	?>
</div>