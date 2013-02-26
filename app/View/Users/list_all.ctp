<?php 
	echo $this->Html->script('ajax_utils/utils_admin_only',false); 
?>
<div class="flat_area grid_16">
	<h2>Accounts List</h2>
</div>
<div class="box grid_16">
	<?php 
		if (isset($msg_type)) {
			echo $this->Msg->output( $msg_type,$this->Session->flash() );
		}
	?>
	<div class="block">	
		<table class="static"> 
			<thead> 
				<tr> 
					<th>Title</th> 
					<th>Name</th>
					<th>Project Group</th> 
					<th>Email</th>
					<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody>
				<?php 
					foreach ($data as $value) {
						?>
						<tr> 
							<td>
								<?php echo $value['User']['title']; ?>
							</td> 
							<td>
								<?php echo $value['User']['name']; ?>
							</td> 
							<td>
								<?php
								if ($value['User']['department_id']==OPERATION_DEPARTMENT) {
									if (empty($value['UserProject'])) {
										echo 'None';
									}else{
										foreach ($value['UserProject'] as $up) {
											echo $projects[$up['project_id']],'(',
												$this->Html->link('Cancel',array('controller'=>'Users','action'=>'cancel_assigned_project',$value['User']['id'],$up['project_id']),array('style'=>'color:red')),')&nbsp;&nbsp;';
										}
									}
								}else{
									if (empty($value['GroupUser'])) {
										echo 'None';
									}else{
										foreach ($value['GroupUser'] as $v){
											echo $group_names_array[$v['group_id']].'&nbsp;&nbsp;';
										}
									}
								}
								?>
							</td>
							
							<td>
								<?php echo $value['User']['username']; ?>
							</td> 
							<td>
								<?php 
									echo $this->Html->link('Modify',array('controller'=>'Users','action'=>'modify',$value['User']['id'])),'&nbsp;&nbsp;';
									if ($value['User']['available']==1) {
										echo $this->Html->link('Cancel Account',array('controller'=>'Users','action'=>'remove',$value['User']['id'])),'&nbsp;&nbsp;';
									}else{
										echo $this->Html->link('Restore Account',array('controller'=>'Users','action'=>'restore',$value['User']['id'])),'&nbsp;&nbsp;';
									}
									echo $this->Html->link('Change Password',array('controller'=>'Users','action'=>'change_password',$value['User']['id'])),'&nbsp;&nbsp;';
								?>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php //echo $this->element('fancy_forms/admin_assign_project_to_user_form');?>
<?php 
	//echo $this->Html->script(array('DataTables/jquery.dataTables','adminica/adminica_datatables'));
?>