<?php 
	echo $this->Html->script('ajax_utils/utils_admin_only',false); 
?>
<div class="flat_area grid_16">
	<h2>Project Management</h2>
</div>
<div class="box grid_16">
	<?php if ($current_user['role_id']==ADMIN): ?>
	<a id="admin_add_new_project" class="short_message_btn" href="#admin_add_new_project_form">
		Add a new project
	</a>
	<?php endif; ?>
	
	<?php 
		 echo $this->Html->link('List My Tasks',array('controller'=>'Tasks','action'=>'list_all'),array('class'=>'short_message_btn')) ;
	?>
	
	<div class="quick_search_form_wrapper">
		<?php 
			echo $this->Form->create('Project',array('action'=>'search'));
			echo $this->Form->input('Project.name',array('label'=>'','div'=>false,'placeholder'=>'Project Name'));
			?>
				<button class="black text_only has_text">
					<span>Search</span>
				</button>
			<?php
			echo $this->Form->end();
		?>
	</div>
</div>

<div class="box grid_16">
	<?php 
		if (isset($msg_type)) {
			echo $this->Msg->output( $msg_type,$this->Session->flash() );
		}
		//pr($data);
	?>
	<div class="block">	
		<table class="static"> 
			<thead> 
				<tr> 
					<th>Project Name</th>
					<th>Client</th> 
					<th>Manager</th>
					<th>Created On</th>
					<th>Deadline</th>
					<th>Status</th>
					<th>Actions</th>
				</tr> 
			</thead> 
			<tbody>
				<?php 
					foreach ($data as $value) {
						?>
						<tr> 
							<td>
								<?php echo $value['Project']['name']; ?>
							</td> 
							<td>
								<?php echo isset($value['Client']['name'])?$value['Client']['name']:''; ?>
							</td> 
							<td>
								<?php echo $value['User']['name']; ?>
							</td>
							<td>
								<?php echo $value['Project']['created']; ?>
							</td> 
							<td>
								<?php echo $value['Project']['deadline_date']; ?>
							</td>
							<td>
								<?php echo $project_status[$value['Project']['status']]; ?>
							</td> 
							<td>
								<?php 
									echo $this->Html->link('View Details',array('controller'=>'Projects','action'=>'view_detail',$value['Project']['id'])),'&nbsp;&nbsp;';
									echo $this->Html->link('Add task',array('controller'=>'Tasks','action'=>'add',$value['Project']['id'])),'&nbsp;&nbsp;';
									if ($current_user['role_id']==ADMIN) {
										echo $this->Html->link('Modify',array('controller'=>'Projects','action'=>'modify',$value['Project']['id'])),'&nbsp;&nbsp;';
										echo $this->Html->link('Remove',array('controller'=>'Projects','action'=>'remove',$value['Project']['id']));
									}
								?>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
				<?php 
					if(!isset($no_pagi)){
						echo $this->element('pagination_bar');
					}
				?>
	</div>
</div>
<?php echo $this->element('fancy_forms/admin_add_new_project_form');?>