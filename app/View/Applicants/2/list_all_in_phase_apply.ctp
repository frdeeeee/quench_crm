<?php 
	echo $this->Html->script('ajax_utils/send_multi_sms_utils',false); 
	echo $this->Html->script('ajax_utils/send_emails_utils',false); 
?>
<div class="flat_area grid_16">
	<h2>申请阶段用户列表</h2>
</div>
<?php 
	echo $this->element('search_forms/search_form_apply');
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
				<?php 
					echo $this->element('tables/'.$this->Session->read('my_project').'/'.$action_name);
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
			if ($value['Phase']['id']==PHASE_APPLY && $value['Applicant']['application_data']==2) {
				//“申请阶段”的学生手动转入签证资料准备阶段或安置阶段，系统条件是“提交外方”处显示“外方已通过”。
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