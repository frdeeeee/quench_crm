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
				$months = array('01','02','03','04','05','06','07','08','09','10','11','12');
				$data_set = array();
							foreach ($months as $key=>$month) {
								foreach ($data as $value){
									if($month==$value[0]['month']){
										$data_set[$month][]=$value;
										//unset($value);
									}
								}
							}
				$total = 0;
				foreach ($data_set as $key=>$value) {
					?>
						<fieldset class="label_side">
							<label><?php echo $key ?>月份</label>
							<div>
								<table  class="static">
									<tr>
										<td>场次/累计</td>
										<td><?php echo count($value),'/',count($value); ?></td>
										<td>
											<?php 
												foreach ($value as $k=>$v) {
													echo $v['Presentation']['hold_on'],'第',$k+1,'场;&nbsp;';
												}
											?>
										</td>
									</tr>
									<tr>
										<td>到场/登记/回访/考试/通过/有效销售</td>
										<td><?php 
											$total_arrive = 0;
											$total_regist = 0;
											$total_slep = 0;
											$total_feedback = 0;
											$total_pass = 0;
											$total_app = 0;
											foreach ($value as $v) {
												$total_arrive += $v['Presentation']['arrived_number'];
												$total_regist += $v[0]['register_number'];
												$total_feedback += $v[0]['feedback_number'];
												$total_slep += $v[0]['slep_number'];
												$total_pass += $v[0]['slep_pass'];
												$total_app += $v[0]['app_number'];
											}
											echo $total_arrive,'/&nbsp;',$total_regist,'/&nbsp;',$total_feedback,'/&nbsp;',$total_slep,'/&nbsp;',$total_pass,'/&nbsp;',$total_app;
										?></td>
										<td>考试率: <?php echo round($total_slep/$total_arrive,3)*100,'%';?></td>
									</tr>
								</table>
							</div>
						</fieldset>
					<?php
				}
			?>
			
			<div class="block">	
				<table class="static"> 
					<thead> 
						<tr> 
							<th>主题</th> 
							<th>月份</th> 
							<th>日期</th> 
							<th>学校</th>
							<th>到场</th>
							<th>登记</th>
							<th>回访</th>
							<th>考试</th>
							<th>考试率</th>
							<th>考试通过</th>
							<th>有效销售</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							foreach ($data as $value) {
								echo '<tr><td>',$value['Presentation']['name'],'</td>';
								echo '<td>',$value[0]['month'],'</td>';
								echo '<td>',$value['Presentation']['hold_on'],'</td>';
								echo '<td>',$value['Customer']['name'],'</td>';
								echo '<td>',$value['Presentation']['arrived_number'],'</td>';
								echo '<td>',$value[0]['register_number'],'</td>';
								echo '<td>',$value[0]['feedback_number'],'</td>';
								echo '<td>',$value[0]['slep_number'],'</td>';
								if ($value['Presentation']['arrived_number']==0) {
									echo '<td>0%</td>';
								}else{
									echo '<td>',round($value[0]['register_number']/$value['Presentation']['arrived_number'],3)*100,'%</td>';
								}
								
								echo '<td>',$value[0]['slep_pass'],'</td>';
								echo '<td>',$value[0]['app_number'],'</td>';
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
					if (isset($no_pagi)) {
						
					}else{
						echo $this->element('pagination_bar');
					}
				?>
			</div>
			<?php
		}
	?>
</div>