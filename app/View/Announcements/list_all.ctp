<div class="flat_area grid_16">
	<h2>Announcements</h2>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_blue">All</h2>
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
							<th>ID</th>
							<th>Subject</th> 
							<th>To</th> 
							<th>Available to</th>
							<th>Prioirty</th>
							<th>Clicks</th> 
							<th>Action</th> 
						</tr> 
					</thead> 
					<tbody>
						<?php 
							$audiences = array('Anyone can see');
							$status = array('Important','Normal');
							foreach ($data as $value) {
								echo '<tr><td>',$value['Announcement']['id'],'</td>';
								echo '<td>',$value['Announcement']['name'],'</td>';
								echo '<td>',$audiences[$value['Announcement']['audience']],'</td>';
								echo '<td>',$value['Announcement']['deadline'],'</td>';
								echo '<td>',$status[$value['Announcement']['important']],'</td>';
								echo '<td>',$value['Announcement']['hits'],'</td>';
								echo '<td>'.$this->Html->link('Details',array('controller'=>'Announcements','action'=>'view_detail',$value['Announcement']['id'])).'&nbsp;&nbsp;';
								if ($current_user['role_id'] == ADMIN) {
									echo $this->Html->link('Modify',array('controller'=>'Announcements','action'=>'modify',$value['Announcement']['id'])).'&nbsp;&nbsp;'.
											$this->Html->link('Remove',array('controller'=>'Announcements','action'=>'remove',$value['Announcement']['id']));
								}
								echo '</td></tr>';
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