<div class="flat_area grid_16">
	<h2>All Contacts</h2>
	<?php 
			if (isset($msg_type)) {
				echo $this->Msg->output( $msg_type,$this->Session->flash() );
			}
		?>
</div>
<div class="box grid_16">
	<div class="block">	
		<table class="static"> 
			<thead> 
				<tr> 
					<th>Contact Name</th> 
					<th>Status</th>
					<th>Owner</th> 
					<th>State</th> 
					<th>Type</th>
					<th>Contract Value</th>
					<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
				<?php 
					$share = array(1=>'Public',0=>'Private');
					foreach ($data as $value) {
						?>
						<tr> 
							<td><?php echo $value['Customer']['name']; ?></td> 
							<td><?php echo $share[$value['Customer']['is_shared']]; ?></td> 
							<td><?php echo $value['Group']['name']; ?></td> 
							<td>
								<?php echo $value['Province']['name']; ?>
							</td> 
							<td><?php echo $value['CustomerType']['name']; ?></td> 
							<td><?php echo $value['Customer']['money_return_sum1'],';',$value['Customer']['money_return_sum2']; ?></td> 
							<td>
								<?php 
									echo $this->Html->link('Details',array('controller'=>'Customers','action'=>'view_detail',$value['Customer']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
									echo $this->Html->link('Modify',array('controller'=>'Customers','action'=>'modify',$value['Customer']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
									echo $this->Html->link('Remove',array('controller'=>'Customers','action'=>'remove',$value['Customer']['id']),NULL,'Are you sure to delete "'.$value['Customer']['name'].'"？'),'&nbsp;&nbsp;&nbsp;&nbsp;';
									echo $this->Html->link('Add new client',array('controller'=>'Contacts','action'=>'add',$value['Customer']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
									echo $this->Html->link('Working logs',array('controller'=>'WorkingLogs','action'=>'find_by_customer',$value['Customer']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
								?>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
		<?php echo $this->element('pagination_bar'); ?>
	</div>
</div>
<?php 
	//echo $this->Html->script(array('DataTables/jquery.dataTables','adminica/adminica_datatables'));
?>