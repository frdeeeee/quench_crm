<?php 
	echo $this->Html->script('ajax_utils/utils_students',false); 
 
				echo $this->Form->input('Applicant.id',array('type'=>'hidden','value'=>$data['Applicant']['id']));
				echo $this->Form->input('Enquiry.id',array('type'=>'hidden','value'=>$data['Enquiry']['id']));
				$yes_no = array(0=>'未完成',1=>'已完成');
?>
<div class="flat_area grid_16">
	<h2>我的个人信息管理
	</h2>
</div>
<div class="box grid_16">
	<h2 class="box_head grad_navy">申请人基础信息 - 申请人：
		<?php echo $data['Enquiry']['name']?>
		, 报名项目：
		<?php echo $data['Project']['name'];?></h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle"></a>
	<div class="toggle_container">
		<div class="block">
			<div class="columns clearfix">
				
				<div class="col_25">
					<div class="section">
						<?php echo $this->Form->input('Enquiry.name',array('value'=>$data['Enquiry']['name'],'label'=>'学生姓名：')); ?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php echo $this->Form->input('Enquiry.school',array('value'=>$data['Enquiry']['school'],'label'=>'学校：')); ?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php echo $this->Form->input('Enquiry.major',array('value'=>$data['Enquiry']['major'],'label'=>'专业：')); ?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php echo $this->Form->input('Enquiry.grade',array('value'=>$data['Enquiry']['grade'],'label'=>'毕业年：')); ?>
					</div>
				</div>
			</div>
			<div class="columns clearfix">
				<div class="col_25">
					<div class="section">
						<?php echo $this->Form->input('Enquiry.gender',array('value'=>$data['Enquiry']['gender'],'label'=>'性别：','options'=>array('女','男'),'empty'=>'请选择...')); ?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php echo $this->Form->input('Enquiry.mobile',array('value'=>$data['Enquiry']['mobile'],'label'=>'手机：')); ?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php echo $this->Form->input('Enquiry.email',array('value'=>$data['Enquiry']['email'],'label'=>'邮件：')); ?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php echo $this->Form->input('Enquiry.province_id',array('value'=>$data['Enquiry']['province_id'],'label'=>'学校所在省：','options'=>$provinces,'empty'=>'请选择...')); ?>
					</div>
				</div>
			</div>
			<div class="columns clearfix">
				
				<div class="col_25">
					<div class="section">
						<?php echo $this->Form->input('Enquiry.city_name',array('value'=>$data['Enquiry']['city_name'],'label'=>'学校所在城市：')); ?>
					</div>
				</div>
				<div class="col_50">
					<div class="section">
						<?php echo $this->Form->input('Enquiry.identification',array('value'=>$data['Enquiry']['identification'],'label'=>'身份证号：','size'=>40)); ?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<a id="modify_basic_app_btn" class="short_message_btn" href="#short_message_send_form_wrapper">修改基础信息</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_green">申请人家庭信息</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle"></a>
	<div class="toggle_container">
		<div class="block" id="app_family_form">
			<div class="columns clearfix">
				<div class="col_33">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Applicant.father_name',
									array('value'=>(isset($data['Applicant']['father_name']))?$data['Applicant']['father_name']:'',
									'label'=>'父亲姓名：','id'=>'father_name')
							);
						?>
					</div>
				</div>
				<div class="col_33">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Applicant.father_mobile',
									array('value'=>(isset($data['Applicant']['father_mobile']))?$data['Applicant']['father_mobile']:'',
									'label'=>'父亲手机：','id'=>'father_mobile')
							);
						?>
					</div>
				</div>
				<div class="col_33">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Applicant.father_company',
									array('value'=>(isset($data['Applicant']['father_company']))?$data['Applicant']['father_company']:'',
									'label'=>'父亲工作单位：','id'=>'father_company')
							);
						?>
					</div>
				</div>
			</div>
			<div class="columns clearfix">
				<div class="col_33">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Applicant.mother_name',
									array('value'=>(isset($data['Applicant']['mother_name']))?$data['Applicant']['mother_name']:'',
									'label'=>'母亲姓名：','id'=>'mother_name')
							);
						?>
					</div>
				</div>
				<div class="col_33">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Applicant.mother_mobile',
									array('value'=>(isset($data['Applicant']['mother_mobile']))?$data['Applicant']['mother_mobile']:'',
									'label'=>'母亲手机：','id'=>'mother_mobile')
							);
						?>
					</div>
				</div>
				<div class="col_33">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Applicant.mother_company',
									array('value'=>(isset($data['Applicant']['mother_company']))?$data['Applicant']['mother_company']:'',
									'label'=>'母亲工作单位：','id'=>'mother_company')
							);
						?>
					</div>
				</div>
			</div>
			<div class="columns clearfix">
				<div class="col_33">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Applicant.emergency_contact',
									array('value'=>(isset($data['Applicant']['emergency_contact']))?$data['Applicant']['emergency_contact']:'',
									'label'=>'紧急联系人：','id'=>'emergency_contact')
							);
						?>
					</div>
				</div>
				<div class="col_33">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Applicant.emergency_mobile',
									array('value'=>(isset($data['Applicant']['emergency_mobile']))?$data['Applicant']['emergency_mobile']:'',
									'label'=>'紧急联系人手机：','id'=>'emergency_mobile')
							);
						?>
					</div>
				</div>
				<div class="col_33">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Applicant.emergency_speak_en',
									array('value'=>(isset($data['Applicant']['emergency_speak_en']))?$data['Applicant']['emergency_speak_en']:'',
									'label'=>'紧急联系人是否会英语：','id'=>'emergency_speak_en')
							);
						?>
					</div>
				</div>
			</div>
			<div class="columns clearfix">
				<div class="col_25">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Applicant.emergency_relation',
									array('value'=>(isset($data['Applicant']['emergency_relation']))?$data['Applicant']['emergency_relation']:'',
									'label'=>'紧急联系人关系：','id'=>'emergency_relation')
							);
						?>
					</div>
				</div>
				<div class="col_50">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Applicant.address',
									array('value'=>(isset($data['Applicant']['address']))?$data['Applicant']['address']:'',
									'label'=>'通信地址：','id'=>'address','size'=>80)
							);
						?>
					</div>
				</div>
				<div class="col_25">
						<a id="modify_family_app_btn" class="short_message_btn" href="#short_message_send_form_wrapper">修改基础信息</a>
				</div>
			</div>
		</div>
	</div>
</div>