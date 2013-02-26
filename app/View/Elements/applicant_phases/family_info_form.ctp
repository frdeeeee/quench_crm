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
						<div id="modify_family_app_btn" class="short_message_btn">修改家庭信息</div>
						<div id="save_family_app_btn" class="short_message_btn">保存修改</div>
				</div>
			</div>
		</div>