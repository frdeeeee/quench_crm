<div class="block" id="app_basic_form">
			<div class="columns clearfix">
				
				<div class="col_25">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Enquiry.name',
									array('value'=>(isset($data['Enquiry']['name']))?$data['Enquiry']['name']:'',
									'label'=>'学生姓名：','id'=>'name')
							);
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Enquiry.customer_id',
									array('value'=>(isset($data['Enquiry']['customer_id']))?$data['Enquiry']['customer_id']:'',
									'label'=>'学校：','id'=>'customer_id')
							);
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Enquiry.major',
									array('value'=>(isset($data['Enquiry']['major']))?$data['Enquiry']['major']:'',
									'label'=>'专业：','id'=>'major')
							);	
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Enquiry.grade',
									array('value'=>(isset($data['Enquiry']['grade']))?$data['Enquiry']['grade']:'',
									'label'=>'毕业年：','id'=>'major')
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
							'Enquiry.gender',
							array('value'=>(isset($data['Enquiry']['gender']))?$data['Enquiry']['gender']:'',
							'label'=>'性别：','id'=>'gender','options'=>array('女','男'))
						);
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Enquiry.mobile',
									array('value'=>(isset($data['Enquiry']['mobile']))?$data['Enquiry']['mobile']:'',
									'label'=>'手机：','id'=>'mobile')
							);
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Enquiry.email',
									array('value'=>(isset($data['Enquiry']['email']))?$data['Enquiry']['email']:'',
									'label'=>'邮件：','id'=>'email','size'=>30)
							);
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Enquiry.slep_scores',
									array('value'=>(isset($data['Enquiry']['slep_scores']))?$data['Enquiry']['slep_scores']:'',
									'label'=>'SLEP成绩：','id'=>'slep_scores','type'=>'text')
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
							'Enquiry.province_id',
							array('value'=>(isset($data['Enquiry']['province_id']))?$data['Enquiry']['province_id']:'',
							'label'=>'学校所在省：','id'=>'province_id','options'=>$provinces,'empty'=>'请选择...')
						);
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Enquiry.city_name',
									array('value'=>(isset($data['Enquiry']['city_name']))?$data['Enquiry']['city_name']:'',
									'label'=>'学校所在城市：','id'=>'city_name')
							);
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
							echo $this->Form->input(
									'Enquiry.identification',
									array('value'=>(isset($data['Enquiry']['identification']))?$data['Enquiry']['identification']:'',
									'label'=>'身份证号：','id'=>'identification','size'=>20)
							);
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
						echo $this->Form->input(
							'Enquiry.presentation_id',
							array('value'=>(isset($data['Enquiry']['presentation_id']))?$data['Enquiry']['presentation_id']:'',
							'label'=>'报名途径：','id'=>'presentation_id','options'=>$presentations,'empty'=>'自主报名')
						);
						?>
					</div>
				</div>
			</div>
			<div class="columns clearfix">
				<div class="col_25">
						<div id="modify_basic_app_btn" class="short_message_btn">修改基础信息</div>
						<div id="save_basic_app_btn" class="short_message_btn">保存修改</div>
				</div>
			</div>
		</div>