		<div class="flat_area grid_16">
			<h2><?php echo $project_name?>项目的统计报告</h2>
		</div>
<div class="box grid_16">
	<div class="block">	
		<table class="static"> 
					<thead> 
						<tr> 
							<th>任务</th> 
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
									echo $value['Task']['name'];
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
								<td><?php echo $value['Task']['target'] ?></td>
								<td><b style="color:red"><?php echo $value['Task']['target']-$value[0]['total_applicants'] ?></b></td>
								<td><?php echo $value['Task']['deadline'] ?></td>
								<td>
									<?php 
										if ($value['Task']['deadline'] ) {
											$today = time();
											echo round( (strtotime($value['Task']['deadline']) - time())/(60*60*24*7),0 ),'周';
										}
									?>
								</td>
								<td>
									<?php echo $this->Html->link('调整任务目标',array('controller'=>'Tasks','action'=>'modify',$value['Task']['id'])),'&nbsp;&nbsp',
										$this->Html->link('查看报名学生',array('controller'=>'Enquiries','action'=>'load_by_project',$project_id,0,$value['Task']['id'])),'&nbsp;&nbsp',
									 	$this->Html->link('查看有效销售',array('controller'=>'Applicants','action'=>'load_by_task',$value['Task']['id']));; ?>
								</td>
							</tr>		
									<?php
								};
							}
						?>
					</tbody>
		</table>
	</div>
</div>	

<div class="box grid_16">
	<h2 class="box_head grad_blue">今日工作提醒</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">
			
		</div>
</div>	