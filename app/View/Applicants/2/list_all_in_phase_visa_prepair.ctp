<?php 
	echo $this->Html->script('ajax_utils/send_multi_sms_utils',false); 
	echo $this->Html->script('ajax_utils/send_emails_utils',false); 
?>
<div class="flat_area grid_16">
	<h2>签证材料准备阶段学生管理</h2>
</div>
<?php 
	echo $this->element('search_forms/search_form_visa_prepair');
	echo $this->element('general/operation_shortcuts');
 ?>
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
							<th>机构</th> 
							<th>已提交签证资料</th> 
							<th>未提交签证资料</th> 
							<th>签证全部资料</th> 
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							$visa_files_status = array(0=>'不全',1=>'已全，等待签证');
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
								echo '<td>',$value['Orgnization']['name'],'</td>';
								//echo '<td>',($value['Applicant']['application_data']==1)?'<b style="color:green">完成，等待安置</b>':'<b style="color:red">未完成</b>','</td>';
								//已提交的签证资料列表
								$temp = array();
								for ($i = 0; $i < count($value['ApplicantFile']); $i++) {
									$txt = $total_file_needed[$value['ApplicantFile'][$i]['download_file_id']];
									if ($value['ApplicantFile'][$i]['is_passed']==1){
										$txt .= ' ->已通过';
									}else{
										if ($value['ApplicantFile'][$i]['is_readed']==1) {
											$txt .= ' ->已审核';
										}else{
											$txt .= ' ->未审核';
										}
									}
									$temp[]=$txt;
									unset($total_file_needed[$value['ApplicantFile'][$i]['download_file_id']]);
								}
								
								if (count($temp)>0) {
									echo '<td>',$this->Form->input('temp',array('options'=>$temp,'label'=>FALSE,'div'=>FALSE)),'</td>';
								}else{
									echo '<td>未提交任何资料</td>';
								}
								if (count($total_file_needed)>0) {
									echo '<td>',$this->Form->input('temp',array('options'=>$total_file_needed,'label'=>FALSE,'div'=>FALSE)),'</td>';
								}else{
									echo '<td>资料已全</td>';
								}
								echo '<td>',$visa_files_status[$value['Applicant']['visa_data']],'</td>';
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
			if ($value['Phase']['id']==PHASE_APPLY) {
				echo $this->ActionsBox->output_fancybox(
					$value['Enquiry']['id'],
					array('数据管理','发送手机短信','发送电子邮件','转为安置阶段','退出'),
					array('','fancy_trigger_group','fancy_email_trigger_group','','fancy_app_cancel_group'),
					array(
						'/Applicants/modify/'.$value['Applicant']['id'].'/'.PHASE_APPLY,
						'#send_sms_form',
						'#send_email_form',
						'/Applicants/phase_settle_confirmed/'.$value['Applicant']['id'], //发送短信的功能是通过fancybox来实现的
						'#applicant_cancel_form'
					),
					array(
						NULL,NULL,NULL,'确认转为安置阶段吗？','确认该学生要退出吗？'
					)
				);
			}else{
				echo $this->ActionsBox->output_fancybox(
					$value['Enquiry']['id'],
					array('数据管理','发送手机短信','发送电子邮件','退出'),
					array('','fancy_trigger_group','fancy_email_trigger_group','fancy_app_cancel_group'),
					array(
						'/Applicants/modify/'.$value['Applicant']['id'].'/'.PHASE_APPLY,
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