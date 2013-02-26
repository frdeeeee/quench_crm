<div class="flat_area grid_16">
	<h2>客户报名登记表统计</h2>
</div>
<div class="box grid_16">
	<h2 class="box_head grad_blue">销售记录</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">					
			<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
			?>
			<div class="block">
				<?php pr($data); ?>
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
							<th>渠道</th> 
							<th>途径</th> 
							<th>考试日期</th>
							<th>考试成绩</th>
							<th>回访</th>
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
								echo '<td>',$value['Channel']['name'],'</td>';
								echo '<td>',$value['Enquiry']['exam_date'],'</td>';
								echo '<td></td>';
								echo '<td>'.(($value['Enquiry']['is_feedback']==0)?'<b style="color:red">无</b>':'<b style="color:green">有</b>').'</td>';
								echo '<td><div class="action_trigger" name="'.$value['Enquiry']['id'].'">更多操作</div></td></tr>';
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
<?php 
	foreach ($data as $value) {
		if($value['Enquiry']['is_feedback']==0){
			echo $this->ActionsBox->output(
				$value['Enquiry']['id'],
				array('添加回复纪录','发送手机短信'),
				array('EnquiryFeedbacks','ShortMessages'),
				array('add','add','send')
			);
		}else{
			echo $this->ActionsBox->output(
				$value['Enquiry']['id'],
				array('回复纪录管理','确认为申请人','发送手机短信'),
				array('EnquiryFeedbacks','Applicants','ShortMessages'),
				array('add','add','send')
			);
		}
	}
?>
