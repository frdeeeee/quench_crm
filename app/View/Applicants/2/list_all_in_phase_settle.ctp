<?php 
	echo $this->Html->script('ajax_utils/send_multi_sms_utils',false); 
	echo $this->Html->script('ajax_utils/send_emails_utils',false); 
?>
<div class="flat_area grid_16">
	<h2>安置阶段学生管理STEP</h2>
</div>
<?php 
	echo $this->element('search_forms/search_form_settle');
	echo $this->element('general/operation_shortcuts');
?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">申请学生列表</h2>
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
							<th>合同编号</th>
							<th>姓名</th>
							<th>学校</th>
							<th>当前阶段</th>
							<th>机构名称</th>
							<th>JF状态</th>
								<th>HF状态</th>
							<th>雇主</th> 
							<th>雇主所在地</th> 
							<th>工作职位</th>
							<th>工作期</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
						$job_offer_status_option = array(0=>'未上传',1=>'已上传外方机构');	
						
						foreach ($data as $value) {
							echo '<tr><td>',
									$this->Form->checkbox('select_item_'.$value['Enquiry']['id'],
										array('class'=>'select_itmes',
											'title'=>$value['Enquiry']['mobile'],
											'style'=>'height:11px;line-height:0px;margin:0px;')),
									'</td>';
								echo '<td>',$value['Enquiry']['contract_id'],'</td>';
								echo '<td id="e_name'.$value['Enquiry']['id'].'">',$value['Enquiry']['name'],'</td>';
								echo '<td>',$value['Enquiry']['school'],'</td>';
								echo '<td>',$value['Phase']['name'],'</td>';
								echo '<td style="display:none"><div id="email_addr_'.$value['Enquiry']['id'].'">',$value['Enquiry']['email'],'</div></td>';
								echo '<td style="display:none"><div id="mobile_nb_'.$value['Enquiry']['id'].'">',$value['Enquiry']['mobile'],'</div></td>';//给手机号一个特定的id，便于发短信的时候提取用
								echo '<td>',($value['Orgnization']['name'])?$value['Orgnization']['name']:'<b style="color:red">无</b>','</td>';
								echo '<td>',$job_offer_status_option[$value['Applicant']['job_offer_upload_oversea_status']],'</td>';
									echo '<td>',$job_offer_status_option[1],'</td>';//$value['ApplicantJob']['hf_status']
									//pr($value['ApplicantJob']['hf_status']);
								echo '<td>',$value['ApplicantJob']['company_name'],'</td>';
								if (isset($value['ApplicantJob']['State']['name'])) {
									echo '<td>',$value['ApplicantJob']['city_name'],
									', ',$value['ApplicantJob']['State']['name'],', USA</td>';
								}else{
									echo '<td>无状态</td>';
								}
								
								echo '<td>',$value['ApplicantJob']['job_title'],'</td>';
								echo '<td>',$value['ApplicantJob']['start_from'],'至',$value['ApplicantJob']['end_by'],'</td>';
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
			if ($value['Phase']['id']==PHASE_SETTLE && $value['Applicant']['job_offer_upload_oversea_status']==JOB_OFFER_UPLOADED) {
				echo $this->ActionsBox->output_fancybox(
					$value['Enquiry']['id'],
					array('数据管理','发送手机短信','发送电子邮件','转为签证阶段','退回申请阶段','退出'),
					array('','fancy_trigger_group','fancy_email_trigger_group','','','fancy_app_cancel_group'),
					array(
						'/Applicants/modify/'.$value['Applicant']['id'].'/'.PHASE_SETTLE,
						'#send_sms_form',
						'#send_email_form',
						'/Applicants/phase_visa_confirmed/'.$value['Applicant']['id'], //发送短信的功能是通过fancybox来实现的
						'/Applicants/return_to_phase_apply/'.$value['Applicant']['id'],
						'#applicant_cancel_form'
					),
					array(
						NULL,NULL,NULL,'确认转为签证阶段吗？','确认将该学生退回申请阶段吗？','确认该学生要退出吗？'
					)
				);
			}else{
				echo $this->ActionsBox->output_fancybox(
					$value['Enquiry']['id'],
					array('数据管理','发送手机短信','发送电子邮件','退出'),
					array('','fancy_trigger_group','fancy_email_trigger_group','fancy_app_cancel_group'),
					array(
						'/Applicants/modify/'.$value['Applicant']['id'].'/'.PHASE_SETTLE,
						'#send_sms_form',
						'#send_email_form',
						'#applicant_cancel_form'
					),
					array(
						NULL,NULL,NULL,'确认该学生要退出吗？'
					)
				);
			}
			
		}
	}
?>