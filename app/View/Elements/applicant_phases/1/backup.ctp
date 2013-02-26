<div class="columns clearfix">
					<?php $the_options = array(1=>'准备好',0=>'未准备好')?>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'ApplicantVisa.is_passport_ok',
								array('value'=>(isset($data['ApplicantVisa']['is_passport_ok']))?$data['ApplicantVisa']['is_passport_ok']:'',
								'label'=>'护照：','id'=>'is_passport_ok','options'=>$the_options,'empty'=>'请选择...'));
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'ApplicantVisa.visa_fee_billing',
								array('value'=>(isset($data['ApplicantVisa']['visa_fee_billing']))?$data['ApplicantVisa']['visa_fee_billing']:'',
								'label'=>'签证费缴费单：','id'=>'visa_fee_billing','options'=>$the_options,'empty'=>'请选择...'));
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'ApplicantVisa.is_photo_ok',
								array('value'=>(isset($data['ApplicantVisa']['is_photo_ok']))?$data['ApplicantVisa']['is_photo_ok']:'',
								'label'=>'签证照：','id'=>'is_photo_ok','options'=>$the_options,'empty'=>'请选择...'));
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'ApplicantVisa.is_application_form_ok',
								array('value'=>(isset($data['ApplicantVisa']['is_application_form_ok']))?$data['ApplicantVisa']['is_application_form_ok']:'',
								'label'=>'签证申请表：','id'=>'is_application_form_ok','options'=>$the_options,'empty'=>'请选择...'));
							?>
						</div>
					</div>
			  </div>
			  <div class="columns clearfix">
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'ApplicantVisa.is_father_income_ok',
								array('value'=>(isset($data['ApplicantVisa']['is_father_income_ok']))?$data['ApplicantVisa']['is_father_income_ok']:'',
								'label'=>'父亲在职及收入证明：','id'=>'is_father_income_ok','options'=>$the_options,'empty'=>'请选择...'));
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'ApplicantVisa.is_mother_income_ok',
								array('value'=>(isset($data['ApplicantVisa']['is_mother_income_ok']))?$data['ApplicantVisa']['is_mother_income_ok']:'',
								'label'=>'母亲在职及收入证明：','id'=>'is_mother_income_ok','options'=>$the_options,'empty'=>'请选择...'));
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php
							echo $this->Form->input(
								'ApplicantVisa.is_bank_deposit1_ok',
								array('value'=>(isset($data['ApplicantVisa']['is_bank_deposit1_ok']))?$data['ApplicantVisa']['is_bank_deposit1_ok']:'',
								'label'=>'银行存款-1：','id'=>'is_bank_deposit1_ok','options'=>$the_options,'empty'=>'请选择...'));
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php
							echo $this->Form->input(
								'ApplicantVisa.is_bank_deposit2_ok',
								array('value'=>(isset($data['ApplicantVisa']['is_bank_deposit2_ok']))?$data['ApplicantVisa']['is_bank_deposit2_ok']:'',
								'label'=>'银行存款-2：','id'=>'is_bank_deposit2_ok','options'=>$the_options,'empty'=>'请选择...'));
							?>
						</div>
					</div>
			  </div>
			  <div class="columns clearfix">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantVisa.others',
									array('value'=>(isset($data['ApplicantVisa']['others']))?$data['ApplicantVisa']['others']:'',
									'label'=>'其它：','id'=>'others','size'=>100));
							?>
						</div>
			  </div>