		<div class="flat_area grid_16">
			<h2>Outbox</h2>
		</div>
<div class="box grid_16">
	<div class="block">	
		<table class="static"> 
					<thead> 
						<tr> 
							<th>Send to</th> 
							<th>Date</th> 
							<th>Date of read</th> 
							<th>Status</th>
							<th>Content</th>
							<th>Actions</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							if ($data) {
								foreach ($data as $value) {
									?>
							<tr>
								<td><?php echo $value['Receiver']['name'] ?></td>
								<td><?php echo $value['ShortMessage']['created'] ?></td>
								<td><?php echo $value['ShortMessage']['modified'] ?></td>
								<td>
									<?php 
										if ($value['ShortMessage']['is_read']==0 ) {
											echo '<b style="color:red">New</b>';
										}else{
											echo '<b style="color:green">Readed</b>';
										}
									?>
								</td>
								<td><?php 
									if (strlen($value['ShortMessage']['content']) > 80) {
										echo '<p title="'.$value['ShortMessage']['content'].'">',substr($value['ShortMessage']['content'], 0,80),'</p>';
									}else{
										echo $value['ShortMessage']['content']; 
									}
								?></td>
								<td>
								<?php echo $this->Html->link('Remove',array('controller'=>'ShortMessages','action'=>'remove',$value['ShortMessage']['id'])); ?>
								</td>
							</tr>		
									<?php
								};
							}
						?>
					</tbody>
		</table>
		<?php echo $this->element('pagination_bar'); ?>
	</div>
</div>