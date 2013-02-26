<div class="flat_area grid_16">
	<h2>Project Statistic Report</h2>
</div>
<div class="flat_area grid_16">
	<div class="block">	
		<table class="static"> 
					<thead> 
						<tr> 
							<th>Project name</th> 
							<th>Contacts</th>
							<th>Customers</th>
							<th>Success Rates</th>
							<th>Target</th> 
						</tr> 
					</thead> 
					<tbody>
						<?php 
							if ($all_sales_data) {
								foreach ($all_sales_data as $value) {
									?>
							<tr>
								<td><?php 
									echo $this->Html->link($value['Project']['name'],array('controller'=>'Tasks','action'=>'load_statistic',$value['Project']['id']) );
								?></td>
								<td><?php echo $value[0]['total_enquiries']?></td>
								<td><?php echo $value[0]['total_applicants']?></td>
								<td><?php 
									if ($value[0]['total_enquiries']==0) {
										echo 'N';
									}else{
										echo round($value[0]['total_applicants']/$value[0]['total_enquiries'],2)*100,'%';
									}
									?></td>
								<td><?php echo $value['Project']['target'] ?></td>
							</tr>		
									<?php
								};
							}
						?>
					</tbody>
		</table>
		</div>
</div>
<div class="flat_area grid_16">
			<h2>System Notifications</h2>
			<?php 
				if (!$latest_applicant || empty($latest_applicant) ) {
					?>
					<p>No CRON action required.</p>
					<?php
				}else{
					?>
					<p>Action name: SEO reports required</p>
					<p>Action name: Hosting fee collection required</p>
					<?php
				}
			?>
		</div>

<div class="box grid_16">
	<h2 class="box_head grad_blue">Tasks of today</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">
			<?php 
				if ($to_do) {
					foreach ($to_do as $key=>$value) {
						?>
						<div class="block" style="opacity: 1;">
							<div class="section">
								<p><b><?php echo $key+1;?>:</b>
								<?php echo $value['WorkingLog']['next_appointment']?>,联系
								<?php echo $value['Customer']['name']?>的
								<?php echo $value['Contact']['name']?>,讨论关于"<?php echo $value['WorkingLog']['next_title']?>"的问题.
								<?php 
									if ($value['WorkingLog']['new_feedback']==1) {
										echo '<b style="color:red">有新的领导批示。</b>';
									}
									echo $this->Html->link('点击查看详细纪录',array('controller'=>'WorkingLogs','action'=>'view_detail',$value['WorkingLog']['id']));
								?>
								</p>
							</div>
						</div>
						<?php
					};
				}
			?>
		</div>
</div>	
</div>
<?php echo $this->element('general/notes_module'); ?>	