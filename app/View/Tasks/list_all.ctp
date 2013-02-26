<div class="flat_area grid_16">
	<h2>Task list</h2>
</div>
<div class="box grid_16">
	<?php 
		if (isset($msg_type)) {
			echo $this->Msg->output( $msg_type,$this->Session->flash() );
		}
	?>
	<?php 
		if (is_null($data)) {
			?>
			<p>There is no tasks. </p>
			<?php
		}else{
			?>
			<div class="block">	
				<table class="static"> 
					<thead> 
						<tr> 
							<th>Project Name</th> 
							<th>Task Name</th> 
							<th>Assign To</th> 
							<th>Deadline</th>
							<th>Priority</th>
							<th>Status</th> 
							<th>Action</th> 
						</tr> 
					</thead> 
					<tbody>
						<?php 
							foreach ($data as $value) {
								?>
								<tr>
									<td><?php echo $value['Project']['name']?></td>
									<td><?php echo $value['Task']['name']?></td>
									<td><?php echo $value['User']['name']?></td>
									<td><?php echo $value['Task']['deadline_date']?></td>
									<td><?php echo $priority[$value['Task']['priority']]?></td>
									<td><?php echo $task_status[$value['Task']['status']]?></td>
									<td>
									<?php echo $this->Html->link('View detail',array('controller'=>'Tasks','action'=>'modify',$value['Task']['id'])); ?>
									</td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</div>
			<?php
		}
	?>
	
</div>