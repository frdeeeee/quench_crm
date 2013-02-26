		<div class="flat_area grid_16">
			<h2>总体销售数据汇总表</h2>
			<?php 
				if (!$latest_applicant || empty($latest_applicant) ) {
					?>
					<p>截止今天的销售数据如下:<strong>还没有任何销售业绩!</strong></p>
					<?php
				}else{
					?>
					<p>截止今天销售数据如下:<strong>已经<?php echo '';?>天没有销售业绩了，请加油!</strong></p>
					<?php
				}
			?>
		</div>
<div class="box grid_16">
	<div class="block">	
		<?php //pr($data); ?>
		<table class="static"> 
					<thead> 
						<tr> 
							<th>项目</th> 
							<th>报名人员</th>
							<th>最终人员</th>
							<th>转化率</th>
							<th>总目标</th> 
							<th>差距</th> 
							<th>招生截止</th>
							<th>剩余周数</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							if ($data) {
								foreach ($data as $value) {
									?>
							<tr>
								<td><?php 
									echo $this->Html->link($value['Project']['name'],array('controller'=>'Tasks','action'=>'load_statistic',$value['Project']['id']) );
								?></td>
								<td><?php echo $value[0]['total_enquiries']?></td>
								<td><?php echo $value[0]['total_applicants']?></td>
								<td><?php 
									if ($value[0]['total_enquiries']==0) {
										echo '无';
									}else{
										echo round($value[0]['total_applicants']/$value[0]['total_enquiries'],2)*100,'%';
									}
									?></td>
								<td><?php echo $value['Project']['target'] ?></td>
								<td><b style="color:red"><?php echo $value['Project']['target']-$value[0]['total_applicants'] ?></b></td>
								<td><?php echo $value['Project']['deadline'] ?></td>
								<td>
									<?php 
										if ($value['Project']['deadline'] ) {
											$today = time();
											echo round( (strtotime($value['Project']['deadline']) - time())/(60*60*24*7),0 ),'周';
										}
									?>
								</td>
								<td>
									<?php 
									echo $this->Html->link('调整总目标',array('controller'=>'Projects','action'=>'modify',$value['Project']['id'])),'&nbsp;&nbsp',
										$this->Html->link('查看报名学生',array('controller'=>'Enquiries','action'=>'load_by_project',$value['Project']['id'],0)),'&nbsp;&nbsp',
									 	$this->Html->link('查看有效销售',array('controller'=>'Applicants','action'=>'load_by_project',$value['Project']['id']));
									?>
								</td>
							</tr>		
									<?php
								};
							}
						?>
					</tbody>
		</table>
		<div class="block">
			<div class="section">
				<p>到目前为止的宣讲会次数: <?php echo $total_presentations; ?></p>
			</div>
		</div>
	</div>
</div>	

<div class="box grid_16">
	<h2 class="box_head grad_blue">今日工作提醒</h2>
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