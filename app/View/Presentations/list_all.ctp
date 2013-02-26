<div class="flat_area grid_16">
	<h2>过往宣讲会记录</h2>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_green">宣讲会统计</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		<div class="block">
			<?php echo $this->Form->create(null,array('url'=>'/Presentations/statictic_report','type'=>'post')); ?>
				<div class="columns clearfix">
					<div class="col_25">
						<div class="section">
								<?php 
									echo $this->Form->input('Statistic.customer_id',array('options'=>$schools,'label'=>'','empty'=>'所有学校..'));
								?>
						</div>
					</div>
					<div class="col_25">
									<div class="section">
										<?php echo $this->Form->input('Statistic.from_date',array('label'=>'开始日期：','class'=>'datepicker','style'=>'border:solid 1px #E0E0E0')); ?>
									</div>
					</div>
					<div class="col_25">
									<div class="section">
										<?php echo $this->Form->input('Statistic.to_date',array('label'=>'截止日期：','class'=>'datepicker','style'=>'border:solid 1px #E0E0E0')); ?>
									</div>
					</div>
					<div class="col_25">
									<div class="section">
										<button class="light text_only has_text" style="margin-top:-5px;">
											<span>开始统计</span>
										</button>
									</div>
					</div>
				</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>

<div class="box grid_16">
	<?php 
		if (isset($msg_type)) {
			echo $this->Msg->output( $msg_type,$this->Session->flash() );
		}
	?>
	<?php 
		if (is_null($data)) {
			?>
			<p>您还没有任何记录</p>
			<?php
		}else{
			//pr($data);
			?>
			<div class="block">	
				<table class="static"> 
					<thead> 
						<tr> 
							<th>主题</th>
							<th>日期</th> 
							<th>学校</th>
							<th>项目</th>
							<th>联络人</th> 
							<th>到场人数</th>
							<th>报名人数</th>
							<th>报名率</th>
							<th>考试日期</th> 
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							
						foreach ($data as $value) {
								echo '<tr><td>',$value['Presentation']['name'],'</td>';
								echo '<td>',$value['Presentation']['hold_on'],'</td>';
								echo '<td>',$value['Customer']['name'],'</td>';
								$projs = '';
								if (strlen($value['Presentation']['projects'])==1) {
									$projs = $projects[$value['Presentation']['projects']];
								}elseif (strlen($value['Presentation']['projects'])>1){
									$temp = explode(',', $value['Presentation']['projects']);
									foreach ($temp as $v) {
										if ($v) {
											$projs .= $projects[$v].',';
										}
									}
								}
								echo '<td>',$projs,'</td>';
								echo '<td>',$value['Presentation']['contact_name'],'</td>';
								echo '<td>',$value['Presentation']['arrived_number'],'</td>';
								echo '<td>',$value['Presentation']['regist_number'],'</td>';
								echo '<td>',round($value['Presentation']['regist_number']/$value['Presentation']['arrived_number'],3)*100,'%</td>';
								echo '<td>',$value['Presentation']['exam_date'],'</td>';
								echo '<td>',
								$this->Html->link('查看',array('controller'=>'Presentations','action'=>'view_detail',$value['Presentation']['id'])).'&nbsp;&nbsp;',
								$this->Html->link('删除',array('controller'=>'Presentations','action'=>'remove',$value['Presentation']['id']),
									NULL,'您确认要删除这条宣讲会的纪录吗？').'&nbsp;&nbsp;'
								,'</td></tr>';
							}
						?>
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