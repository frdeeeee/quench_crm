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
							<th>年级</th>
							<th>专业</th>
							<th>手机</th> 
							<th>邮箱</th> 
							<th>项目</th>
							<th>考试成绩</th> 
							<th>申请材料</th> 
							<th>项目材料</th>  
							<th>阶段</th> 
							<th>工作状态</th> 
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
								echo '<td>',$value['Applicant']['slep'],'</td>';
								echo '<td>',($value['Applicant']['application_data'])?'<b style="color:green">完成</b>':'<b style="color:red">等待</b>','</td>';
								echo '<td>',$value['Applicant']['project_data']?'<b style="color:green">完成</b>':'<b style="color:red">等待</b>','</td>';
								echo '<td>',$value['Phase']['name'],'</td>';
								echo '<td>',$value['JobStatus']['name'],'</td>';
								echo '<td>',$this->Html->link('查看',array('controller'=>'Applicants','action'=>'modify',$value['Applicant']['id'])),'</td></tr>';
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