		<div class="flat_area grid_16">
			<h2>运营数据汇总表</h2>
			<p>截止今天，项目的进展情况如下: </p>
		</div>
<div class="box grid_16">
	<div class="block">	
		<?php //pr($data); ?>
		<table class="static"> 
					<thead> 
						<tr> 
							<th>项目</th> 
							<th>任务</th>
							<th>截至日期</th>
							<th>报名</th>
							<th>参加考试</th>
							<th>通过考试</th>
							<th>有效销售</th>
							<th>申请资料</th>
							<th>安置资料</th>
							<th>签证资料</th> 
							<th>获得签证</th>
							<th>行前阶段</th>
							<th>赴美阶段</th>
							<th>回国阶段</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							if ($data) {
								$length = count($data['projects']);
								for ($i = 0; $i < $length; $i++) {
									
								//}
								//foreach ($data['projects'] as $value) {
									?>
							<tr>
								<td><?php 
									echo $data['projects'][$i+1];
								?></td>
								<td><?php //echo $value['Task']['target']?></td>
								<td><?php //echo $value['Task']['deadline']?></td>
								<td><?php echo $data['total_registions'][$i][0]['total_registions']?></td>
								<td><?php echo $data['total_examed'][$i][0]['total_examed'] ?></td>
								<td><?php echo $data['total_pass'][$i][0]['total_pass']  //$value[0]['total_pass']?></td>
								<td><?php 
									echo $data['total_applicants'][$i][0]['total_applicants']  //$value[0]['total_applicants'];
								?></td>
								<td><?php echo $data['total_app_data_done'][$i][0]['total_app_data_done']  //$value[0]['total_app_data_done'] ?></td>
								<td><?php echo $data['total_project_data_done'][$i][0]['total_project_data_done']  //$value[0]['total_project_data_done'] ?></td>
								<td><?php echo $data['total_visa_data_done'][$i][0]['total_visa_data_done']  //$value[0]['total_visa_data_done'] ?></td>
								<td><?php echo $data['total_get_visa'][$i][0]['total_get_visa']  //$value[0]['total_get_visa'] ?></td>
								<td><?php echo $data['total_before_leaving'][$i][0]['total_before_leaving']  //$value[0]['total_before_leaving'] ?></td>
								<td><?php echo $data['total_oversea'][$i][0]['total_oversea']  //$value[0]['total_oversea'] ?></td>
								<td><?php echo $data['total_return'][$i][0]['total_return']  //$value[0]['total_return'] ?></td>
							</tr>		
									<?php
								};
							}
						?>
					</tbody>
		</table>
	</div>
</div>	
<?php 
	if (isset($to_do_next_week)) {
		?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">近一周工作提醒</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle toggle_closed"></a>
		<div class="toggle_container"  style="display:none;">
			<?php 
				if (!empty($to_do_next_week)) {
					foreach ($to_do_next_week as $key=>$value) {
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
					}
				}else{
					?>
						<div class="block" style="opacity: 1;">
							<div class="section">
								<p>不会吧，没事可做！</p>
							</div>
						</div>
					<?php
				}
			?>
		</div>
</div>
		<?php
	}
?>	
<?php 
	if (isset($pendings)) {
		?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">待完成工作</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle toggle_closed"></a>
		<div class="toggle_container" style="display:none;">
			<?php 
				if ( !empty($pendings) ) {
					foreach ($pendings as $key=>$value) {
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
					}
				}else{
					?>
						<div class="block" style="opacity: 1;">
							<div class="section">
								<p>强！能做的都做了。</p>
							</div>
						</div>
					<?php
				}
			?>
		</div>
</div>
		<?php
	}
?>
</div>
<?php echo $this->element('general/notes_module'); ?>	