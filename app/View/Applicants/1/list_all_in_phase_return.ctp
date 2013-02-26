<?php 
	echo $this->Html->script('ajax_utils/send_multi_sms_utils',false); 
	echo $this->Html->script('ajax_utils/send_emails_utils',false); 
?>
<div class="flat_area grid_16">
	<h2>回国阶段用户列表</h2>
</div>
<?php 
	echo $this->element('search_forms/search_form_return');
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
				echo $this->ActionsBox->output_fancybox(
						$value['Enquiry']['id'],
						array('数据管理','发送手机短信','发送电子邮件'),
						array('','fancy_trigger_group','fancy_email_trigger_group'),
						array(
							'/Applicants/modify/'.$value['Applicant']['id'].'/'.PHASE_OVERSEA,
							'#send_sms_form',
							'#send_email_form'
						)
				);
		}
	}
	echo $this->element('fancy_forms/applicant_cancel_form');
?>