<?php 
	if ($current_user['department_id'] != SALES_DEPARTMENT) {
		//销售部的人不提供修改的功能
		echo $this->Html->script('ajax_utils/utils_applicants',false); 
		echo $this->Html->script('ajax_utils/floating_box',false); 
	}
?>
<div id="floating_box">
	<div id="toggle_floating_box">x</div>	
		<p>申请人：<?php echo $data['Enquiry']['name']?></p>
		<p>项目编号：<?php echo $data['Enquiry']['contract_id'];?></p>
		<p>学校：<?php echo $data['Enquiry']['school']; ?></p>
		<p>机构：<?php echo $data['Orgnization']['name']; ?></p>
		<p>当前阶段：<?php echo $data['Phase']['name']; ?></p>
</div>
<div class="flat_area grid_16">
	<h2>更新学生申请进度纪录</h2>
</div>
<div class="box grid_16">
	<input type="hidden" value="" id="target_app_id" >
	<input type="text" id="find_by_name_input_trigger" size="40" style="margin-top:10px;margin-bottom: 10px;margin-right: 0px;margin-left: 10px;height:25px;color:#ccc;float:left" value="输入学生姓名开始搜索...">
	<div class="short_message_btn" id="switch_to_this_btn">
		确定
	</div>
		<div style="display:none" id="availble_enquiry_names">
				<?php 
					foreach ($enquiry_names as $value) {
						echo '<a class="enq_name" title="',$value['Enquiry']['id'],'">',$value['Enquiry']['name'],' @ ',$value['Enquiry']['school'],'</a>';
					}
				?>
		</div>
</div>
			<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
				echo $this->Form->input('Applicant.id',array('type'=>'hidden','value'=>$data['Applicant']['id']));
				echo $this->Form->input('Enquiry.id',array('type'=>'hidden','value'=>$data['Enquiry']['id']));
			?>
<div class="box grid_16">
	<h2 class="box_head grad_navy">申请人基础信息 - 申请人：
		<?php echo $data['Enquiry']['name']?>
		, 项目编号：
		<?php echo $data['Enquiry']['contract_id'];?>
		, 学校：<?php echo $data['Enquiry']['school']; ?>
		, 机构：<?php echo $data['Orgnization']['name']; ?>
		, 当前阶段：<?php echo $data['Phase']['name']; ?>
		</h2>
		
	<div class="toggle_container">
	<?php echo $this->element('applicant_phases/basic_info'); ?>	
	</div>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_green">申请人家庭信息</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		<?php echo $this->element('applicant_phases/family_info_form'); ?>
	</div>
</div>
<div class="box grid_16">
	<h2 class="box_head grad_navy">
		申请人缴费与协议信息
	</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		 <div class="block" id="app_contract_form">
<?php echo $this->element('applicant_phases/contract_modify_form'); ?>
		  </div>
	</div>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_green">阶段相关的状态信息</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		<div class="block" id="app_progress_form">
		  <?php echo $this->element('applicant_phases/application_data_job_offer'); ?> 
		</div>
	</div>
</div>
<!-- ********************************************************************************** -->
<div class="box grid_16">
	<h2 class="box_head grad_navy">申请人申请资料管理</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
	<?php echo $this->element('applicant_phases/phase_apply'); ?>
	</div>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_green">申请人岗位信息管理</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
	<?php echo $this->element('applicant_phases/phase_settle'); ?>
	</div>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_navy">签证资料和进度管理</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		<?php echo $this->element('applicant_phases/'.$this->Session->read('my_project').'/phase_visa'); ?>
	</div>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_green">行前阶段管理</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		<?php 
			echo $this->element('applicant_phases/'.$this->Session->read('my_project').'/phase_before_leaving'); 
		?>
	</div>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_navy">赴美阶段管理</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		<?php echo $this->element('applicant_phases/phase_oversea'); ?>
	</div>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_green">回国阶段管理</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		<?php echo $this->element('applicant_phases/phase_return'); ?>
	</div>
</div>

<div style="display:none">
	<div id="applicant_leave_comment_form" style="width:500px;height:300px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		给申请人撰写留言
		</h2>
		<?php 
			echo $this->Form->create(NULL,array('url'=>'/ApplicantFiles/leave_comments')); 
			echo $this->Form->input('ApplicationFile.id',array('type'=>'hidden','value'=>''));
		?>
		<fieldset class="label_side">
			<label>您的留言</label>
				<div>
					<?php echo $this->Form->input('ApplicantFile.latest_comments',array('label'=>'','div'=>false)); ?>
				</div>
		</fieldset>
		<div id="applicant_leave_comment_send_btn" class="short_message_btn">
				提交我的留言
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>
