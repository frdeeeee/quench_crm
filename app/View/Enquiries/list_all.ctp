<div class="flat_area grid_16">
	<h2>学生报名登记表统计</h2>
</div>
<?php echo $this->element('search_forms/search_form');?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">报名登记表汇总</h2>
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
							<th>编号</th>
							<th>姓名</th> 
							<th>学校</th> 
							<th>毕业年</th>
							<th>专业</th>
							<th>手机</th> 
							<th>邮箱</th> 
							<th>项目</th> 
							<th>渠道</th> 
							<th>途径</th> 
							<th>考试日期</th>
							<th>考试成绩</th>
							<th>已回访</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							foreach ($data as $value) {
								echo '<tr><td>',$value['Enquiry']['id'],'</td>';
								echo '<td>',$value['Enquiry']['name'],'</td>';
								echo '<td>',$value['Enquiry']['school'],'</td>';
								echo '<td>',$value['Enquiry']['grade'],'</td>';
								echo '<td>',$value['Enquiry']['major'],'</td>';
								echo '<td>',$value['Enquiry']['mobile'],'</td>';
								echo '<td>',$value['Enquiry']['email'],'</td>';
								echo '<td>',$value['Project']['name'],'</td>';
								echo '<td>',$value['Source']['name'],'</td>';
								echo '<td>',(is_null($value['Presentation']['name'])?'自主报名':$value['Presentation']['name']),'</td>';
								echo '<td>',$value['Enquiry']['exam_date'],'</td>';
								echo '<td>',$value['Enquiry']['slep_scores'],'</td>';
								echo '<td>'.(($value['Enquiry']['is_feedback']==1)?'是':'<b style="color:red">否</b>').'</td>';
								echo '<td>'.$this->Html->link('修改',array('controller'=>'Enquiries','action'=>'modify',$value['Enquiry']['id'])).'&nbsp;&nbsp;'.
								$this->Html->link('删除',
									array('controller'=>'Enquiries','action'=>'remove',$value['Enquiry']['id']),NULL,'您确认要删除这张报名表吗？').'</td></tr>';
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