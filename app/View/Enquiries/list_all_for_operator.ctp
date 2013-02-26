<?php 
	echo $this->Html->script('ajax_utils/send_multi_sms_utils',false); 
	echo $this->Html->script('ajax_utils/send_emails_utils',false); 
	echo $this->Html->script('ajax_utils/util_transfer_enq',false); 
?>
<div class="flat_area grid_16">
	<h2>客户报名表统计</h2>
</div>
<?php 
	echo $this->element('search_forms/search_form_registration');
	echo $this->element('general/operation_shortcuts');
 ?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">报名表记录</h2>
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
					//pr($data);
					echo $this->element('tables/list_all_for_operator');
					if(!isset($no_pagi)){
						echo $this->element('pagination_bar');
					}
				?>
		</div>
	</div>
</div>
<?php 
	
	foreach ($data as $value) {
		$transfer_title = '';
		$transfer_to_project_id = PROJECT_STEP;
		if ($value['Enquiry']['project_id']==PROJECT_STEP) {
			$transfer_title='转为SWT项目';
			$transfer_to_project_id = PROJECT_SWT;
		}elseif ($value['Enquiry']['project_id']==PROJECT_SWT){
			$transfer_title='转为STEP项目';
		}
		if($value['Enquiry']['slep_scores']>=42 && $value['Enquiry']['apply_fee_status_id']==2 &&
		 	$value['Enquiry']['project_fee_status_id']==2 && $current_user['department_id']!=SALES_DEPARTMENT
		){
			/*
			 * 只有报名阶段的学生，才会出现在“报名阶段学生管理”中。只有手动“转为申请人”并系统认定 slep考试42以上+B 报名费项目费已交，才能到申请阶段
			 */
			echo $this->ActionsBox->output_fancybox(
					$value['Enquiry']['id'],
					array('查看与回访','修改报名表','修改合同信息','进入申请阶段','发送手机短信','发送电子邮件','删除纪录',$transfer_title),
					array('','','','','fancy_trigger_group','fancy_email_trigger_group','','fancy_enq_transfer_group'),
					array(
						'/EnquiryFeedbacks/add/'.$value['Enquiry']['id'],
						'/Enquiries/modify/'.$value['Enquiry']['id'],
						'/Enquiries/modify_contract/'.$value['Enquiry']['id'],
						'/Applicants/add/'.$value['Enquiry']['id'],
						'#send_sms_form',
						'#send_email_form',
						'/Enquiries/remove/'.$value['Enquiry']['id'],
						'#transfer_enq_form'
						//'/Enquiries/transfer/'.$value['Enquiry']['id'].'/'.$transfer_to_project_id
					)
			);
		}else{
			echo $this->ActionsBox->output_fancybox(
					$value['Enquiry']['id'],
					array('查看与回访','修改报名表','修改合同信息','发送手机短信','发送电子邮件','删除纪录',$transfer_title),
					array('','','','fancy_trigger_group','fancy_email_trigger_group','','fancy_enq_transfer_group'),
					array(
						'/EnquiryFeedbacks/add/'.$value['Enquiry']['id'],
						'/Enquiries/modify/'.$value['Enquiry']['id'],
						'/Enquiries/modify_contract/'.$value['Enquiry']['id'],
						'#send_sms_form',
						'#send_email_form','/Enquiries/remove/'.$value['Enquiry']['id'],
						'#transfer_enq_form'
						//'/Enquiries/transfer/'.$value['Enquiry']['id'].'/'.$transfer_to_project_id
					)
			);
		}
			
	}
	echo $this->element('fancy_forms/transfer_enq_form');
	//echo $this->element('fancy_forms/send_email_form');
?>