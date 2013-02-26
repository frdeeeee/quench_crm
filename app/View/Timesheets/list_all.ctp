<div class="flat_area grid_16">
	<h2>Timesheet</h2>
</div>
<div class="box grid_4">
	<h2 class="box_head grad_blue">Choose Employee</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">	
			<div class="block">
				<table class="static"> 
					<thead> 
						<tr> 
							<th>Name</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							foreach ( $receivers as $key=>$employee) {
								echo '<tr><td>',$this->Html->link($employee,array('controller'=>'Timesheets','action'=>'list_all',$key)),'</td></tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
</div>
<div class="box grid_12">
	<h2 class="box_head grad_blue">Checkin/Checkout History</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">					
			<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
			?>
			
			<div class="block">
				<table class="static"> 
					<thead> 
						<tr> 
							<th>#</th>
							<th>Employee</th> 
							<th>Time</th> 
							<th>Type</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							foreach ($data as $value) {
								echo '<tr><td>',$value['Timesheet']['id'],'</td>';
								echo '<td>',$value['User']['name'],'</td>';
								echo '<td>',$value['Timesheet']['stamp'],'</td>';
								echo '<td>',$value['Timesheet']['type'],'</td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
				<?php 
					echo $this->element('pagination_bar');
				?>
			</div>
		</div>
</div>