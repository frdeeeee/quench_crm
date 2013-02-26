<?php 
	echo $this->Html->script('ajax_utils/send_multi_sms_utils',false); 
	echo $this->Html->script('ajax_utils/send_emails_utils',false); 
?>
<div class="flat_area grid_16">
	<h2>赴美阶段学生管理</h2>
</div>
<?php 
	echo $this->element('search_forms/search_form_oversea');
	echo $this->element('general/operation_shortcuts');
 ?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">用户列表</h2>
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
							<th>
								<?php 
								echo $this->Form->checkbox('select_all');//js会响应它的事件
								?>
							</th>
							<th>姓名</th>
							<th>学校</th> 
							<th>合同编号</th>
							<th>阶段</th>
							<th>机构</th> 
							<th>激活状态</th> 
							<th>雇主</th> 
							<th>所在地</th>
							<th>寄宿家庭</th> 
							<th>工作职位</th>
							<th>Check-in状态</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
						//pr($data);	
							$profile_status = array(0=>'等待审核',1=>'已通过');
							foreach ($data as $value) {
								echo '<tr><td>',
									$this->Form->checkbox('select_item_'.$value['Enquiry']['id'],
										array('class'=>'select_itmes',
											'title'=>$value['Enquiry']['mobile'],
											'style'=>'height:11px;line-height:0px;margin:0px;')),
									'</td>';
								echo '<td id="e_name'.$value['Enquiry']['id'].'">',$value['Enquiry']['name'],'</td>';
								echo '<td>',$value['Enquiry']['school'],'</td>';
								echo '<td>',$value['Enquiry']['contract_id'],'</td>';
								echo '<td>',$value['Phase']['name'],'</td>';
								echo '<td>',$value['Orgnization']['name'],'</td>';
								echo '<td style="display:none"><div id="email_addr_'.$value['Enquiry']['id'].'">',$value['Enquiry']['email'],'</div></td>';
								echo '<td style="display:none"><div id="mobile_nb_'.$value['Enquiry']['id'].'">',$value['Enquiry']['mobile'],'</div></td>';//给手机号一个特定的id，便于发短信的时候提取用
								if (strlen($value['Profile']['status'])>0) {
									if ($value['Profile']['status']==0) {
										echo '<td>等待审核</td>';
									}else{
										echo '<td>已通过</td>';
									}
								}else{
									echo '<td>等待提交</td>';
								}
								
								echo '<td>',$value['ApplicantJob']['company_name'],'</td>';
								if (strlen($value['ApplicantJob']['city_name'])) {
									echo '<td>',$value['ApplicantJob']['city_name'],
									', ',$states[$value['ApplicantJob']['state_id']],', USA</td>';
								}else{
									echo '<td>未知</td>';
								}
								
								echo '<td>',$value['ApplicantJob']['hf_family_name'],'</td>';
								
								echo '<td>',$value['ApplicantJob']['job_title'],'</td>';
								if (isset($value['Checkin'])) {
									$now = time();
									$last_time = strtotime($value['Checkin']['latest_create']);
									$interval = 30-round(($now-$last_time)/(1000*60*60*24),0);
									if($interval<0){
										echo '<td>逾期未提交</td>';
									}else{
										echo '<td>正常，还有',$interval,'天</td>';
									}
								}else{
									echo '<td>还没有过Check_in</td>';
								}
								echo '<td><div class="action_trigger" name="'.$value['Enquiry']['id'].'">更多操作</div></td></tr>';
							}
						?>
					</tbody>
				</table>
				<?php 
					if(!isset($no_pagi)){
						echo $this->element('pagination_bar');
					}
				?>
		</div>
	</div>
</div>
<?php 
	if ($current_user['role_id'] != SALES && $current_user['role_id'] != SALES_ASSISTANT) {
		foreach ($data as $value) {
			echo $this->ActionsBox->output_fancybox(
					$value['Enquiry']['id'],
					array('数据管理','发送手机短信','发送电子邮件'),
					array('','fancy_trigger_group','fancy_email_trigger_group'),
					array(
						'/Applicants/modify/'.$value['Applicant']['id'].'/'.PHASE_OVERSEA,
						'#send_sms_form',
						'#send_email_form'
					),
					array(
						NULL,NULL,NULL
					)
			);
		}
	}
?>