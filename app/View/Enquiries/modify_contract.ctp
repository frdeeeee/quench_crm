<?php 
	if ($current_user['department_id'] != SALES_DEPARTMENT) {
		//销售部的人不提供修改的功能
		echo $this->Html->script('ajax_utils/utils_applicants',false); 
	}
?>
<div class="box grid_16">
	<?php 
	echo $this->Html->link(
		'返回学生列表',
		array('controller'=>'Enquiries','action'=>'list_all_for_operator',$this->Session->read('enquiry_id')),
		array('class'=>'short_message_btn')
	); 
	?>
</div>
<div class="box grid_16">
	<h2 class="box_head grad_navy">
		申请人缴费与协议信息
	</h2>
	<div class="toggle_container">
		 <div class="block" id="app_contract_form">
<?php echo $this->element('applicant_phases/contract_modify_form'); ?>		 
		 </div>
	</div>
</div>