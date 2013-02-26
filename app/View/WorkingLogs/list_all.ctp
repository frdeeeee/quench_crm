<div class="flat_area grid_16">
	<h2>My Tasks</h2>
</div>

<div class="box grid_16">
	<?php 
		if (isset($msg_type)) {
			echo $this->Msg->output( $msg_type,$this->Session->flash() );
		}
		if (is_null($data)) {
			?>
			<p>There is no any task</p>
			<?php
		}else{
			//pr($data);
	?>
			<div class="block">	
				<table class="static"> 
					<thead> 
						<tr> 
									<th>Contact Info</th> 
									<th>Last Modified</th>
									<th>Subject</th> 
									<th>Next Appointment</th>
									<th>Actions</th> 
						</tr>  
					</thead> 
					<tbody>
						
						<?php 
							foreach ($data as $value) {
						?>
						<tr>
							<td><?php echo $value['Contact']['first_name'],' ',$value['Contact']['last_name'],' ',$value['Contact']['company'];?></td>
							<td><?php echo $value['WorkingLog']['modified']?></td>
							<td><?php echo $value['WorkingLog']['name']?></td>
							<td><?php echo $value['WorkingLog']['next_appointment_date']?></td>
							<td>
							<?php 
								echo $this->Html->link('View Detail',array('controller'=>'WorkingLogs','action'=>'view_detail',$value['WorkingLog']['id']));
							?>&nbsp;&nbsp;
							<?php 
								echo $this->Html->link('Modify',array('controller'=>'WorkingLogs','action'=>'modify',$value['WorkingLog']['id']));
							?>&nbsp;&nbsp;
							<?php 
								echo $this->Html->link(
									'Delete',
									array('controller'=>'WorkingLogs','action'=>'remove',$value['WorkingLog']['id']),
									NULL,
									'Are you sure?'
								);
							?>
							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
				<?php 
					echo $this->element('pagination_bar');
				?>
			</div>
			<?php
		}
	?>
</div>