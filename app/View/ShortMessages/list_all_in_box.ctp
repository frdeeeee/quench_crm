<?php 
	echo $this->Html->script('ajax_utils/send_multi_sms_utils',false); 
	echo $this->Html->script('ajax_utils/send_emails_utils',false); 
?>
		<div class="flat_area grid_16">
			<h2>Inbox</h2>
		</div>
<div class="box grid_16">
	<div class="block">	
		<table class="static"> 
					<thead> 
						<tr> 
							<th>From</th>
							<th>Date</th> 
							<th>Status</th>
							<th>Content</th>
							<th>Action</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							if ($data) {
								foreach ($data as $value) {
									?>
							<tr>
								<td><?php echo is_null($value['Sender']['name'])?$value['Enquiry']['name']:$value['Sender']['name']; ?></td>
								<td><?php echo $value['ShortMessage']['created'] ?></td>
								<td>
									<?php 
										if ($value['ShortMessage']['is_read']==0 ) {
											echo '<b style="color:red">New</b>';
										}else{
											echo '<b style="color:green">Readed</b>';
										}
									?>
								</td>
								<td width="50%"><?php 
										echo '<p>',$value['ShortMessage']['content'],'</p>';
								?></td>
								<td>
								<?php 
									 echo $this->Html->link('Set to readed',array('controller'=>'ShortMessages','action'=>'mark_as_readed',$value['ShortMessage']['id'])),'&nbsp;&nbsp';
									 if (!is_null($value['Enquiry']['id'])) {
									 	?>
									 	<a title="<?php echo $value['Enquiry']['id']?>" href="#send_sms_form" rel="fancy_trigger_group">Reply</a>
									 	<div style="display: none;" id="mobile_nb_<?php echo $value['Enquiry']['id']?>"><?php echo $value['Enquiry']['mobile']; ?></div>
									 	<a title="<?php echo $value['Enquiry']['id']?>" href="#send_email_form" rel="fancy_email_trigger_group">Write email</a>
									 	<div style="display: none;" id="email_addr_<?php echo $value['Enquiry']['id']?>"><?php echo $value['Enquiry']['email']; ?></div>
									 	<div style="display: none;" id="e_name<?php echo $value['Enquiry']['id']?>"><?php echo $value['Enquiry']['name']; ?></div>
									 	<?php
									 }
									 echo $this->Html->link(
									 	'Remove',
									 	array('controller'=>'ShortMessages','action'=>'remove',$value['ShortMessage']['id']),
									 	array(),
									 	'Are you sure you want to delete this？'
									 );
								?>
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
<?php 
	echo $this->element('fancy_forms/send_sms_form');
	echo $this->element('fancy_forms/send_email_form');
?>