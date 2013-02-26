<div class="columns clearfix" id="app_progress_form">
				<div class="col_25">
					<div class="section">
						<?php 
						$applicant_files_status = array(0=>'未完成',1=>'已完成，等待外方安置',2=>'外方已通过');
						$visa_files_status = array(0=>'不全',1=>'已全，等待签证');
						$project_files_status = array(0=>'未完成',1=>'已完成');
				
						echo $this->Form->input(
							'Applicant.application_data',
							array('value'=>(isset($data['Applicant']['application_data']))?$data['Applicant']['application_data']:'',
							'label'=>'申请资料提交外方：','id'=>'application_data','options'=>$applicant_files_status)
						);
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
						/*
						echo $this->Form->input(
							'Applicant.porject_data',
							array('value'=>(isset($data['Applicant']['project_data']))?$data['Applicant']['project_data']:'',
							'label'=>'安置资料：','id'=>'project_data','options'=>$project_files_status)
						);
						*/
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
						echo $this->Form->input(
							'Applicant.visa_data',
							array('value'=>(isset($data['Applicant']['visa_data']))?$data['Applicant']['visa_data']:'',
							'label'=>'签证资料：','id'=>'visa_data','options'=>$visa_files_status)
						);
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
						echo $this->Form->input(
							'Applicant.visa_status',
							array('value'=>(isset($data['Applicant']['visa_status']))?$data['Applicant']['visa_status']:'',
							'label'=>'签证状态：','id'=>'visa_status','options'=>$visa_status,'empty'=>TRUE)
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
							'Applicant.orgnization_id',
							array('value'=>(isset($data['Applicant']['orgnization_id']))?$data['Applicant']['orgnization_id']:'',
							'label'=>'机构：','id'=>'orgnization_id','options'=>$orgnizations,'empty'=>'请选择..')
						);
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
						echo $this->Form->input(
							'Applicant.job_offer_upload_oversea_status',
							array('value'=>(isset($data['Applicant']['job_offer_upload_oversea_status']))?$data['Applicant']['job_offer_upload_oversea_status']:'',
							'label'=>'Job Offer上传外方：','id'=>'job_offer_upload_oversea_status','options'=>array(0=>'未上传',1=>'已上传外方机构'))
						);
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
						echo $this->Form->input(
							'Applicant.job_status',
							array('value'=>(isset($data['Applicant']['job_status']))?$data['Applicant']['job_status']:'',
							'label'=>'岗位：','id'=>'job_status','options'=>$job_status,'empty'=>'请选择..')
						);
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
						echo $this->Form->input(
							'Applicant.source_id',
							array('value'=>(isset($data['Applicant']['source_id']))?$data['Applicant']['source_id']:'',
							'label'=>'渠道：','id'=>'source_id','options'=>$sources,'empty'=>'请选择..')
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
									'Applicant.usa_informed',
									array('value'=>(isset($data['Applicant']['usa_informed']))?$data['Applicant']['usa_informed']:'',
									'label'=>'行程是否提交外方：','id'=>'usa_informed','options'=>array(0=>'否',1=>'是')));
						   ?>
						</div>
				</div>
				<div class="col_33">
					<div class="section">
						<?php 
						echo $this->Form->input(
									'Applicant.comments',
									array('value'=>(isset($itinerary['Applicant']['comments']))?$itinerary['Applicant']['comments']:'',
									'label'=>'备注：','id'=>'comments','size'=>50)
						);
						?>
					</div>
				</div>
				<div class="col_33">
							<div id="modify_progress_app_btn" class="short_message_btn">修改状态信息</div>
							<div id="save_progress_app_btn" class="short_message_btn">保存修改</div>
				</div>
			</div>