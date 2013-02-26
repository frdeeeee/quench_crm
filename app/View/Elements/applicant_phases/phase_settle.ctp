<div class="block" id="app_job_form">
			 <div class="columns clearfix">
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'ApplicantJob.interview',
								array('value'=>(isset($data['ApplicantJob']['interview']))?$data['ApplicantJob']['interview']:'',
								'label'=>'参加JOBFAIR/雇主面试/自主申请：','id'=>'interview','options'=>array(0=>'否',1=>'是'))
							);
							?>
						</div>
					</div>
					
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantJob.job_title',
									array('value'=>(isset($data['ApplicantJob']['job_title']))?$data['ApplicantJob']['job_title']:'',
									'label'=>'工作职位：','id'=>'job_title')
							);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantJob.company_name',
									array('value'=>(isset($data['ApplicantJob']['company_name']))?$data['ApplicantJob']['company_name']:'',
									'label'=>'公司名称：','id'=>'company_name')
							);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'ApplicantJob.state_id',
								array('value'=>(isset($data['ApplicantJob']['state_id']))?$data['ApplicantJob']['state_id']:'',
								'label'=>'州名：','id'=>'state_id','options'=>$states)
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
									'ApplicantJob.city_name',
									array('value'=>(isset($data['ApplicantJob']['city_name']))?$data['ApplicantJob']['city_name']:'',
									'label'=>'城市：','id'=>'city_name')
							);
							?>
						</div>
					</div>
			  
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantJob.street_name',
									array('value'=>(isset($data['ApplicantJob']['street_name']))?$data['ApplicantJob']['street_name']:'',
									'label'=>'具体地址：','id'=>'street_name')
							);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantJob.employer_name',
									array('value'=>(isset($data['ApplicantJob']['employer_name']))?$data['ApplicantJob']['employer_name']:'',
									'label'=>'雇主姓名：','id'=>'employer_name')
							);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantJob.phone',
									array('value'=>(isset($data['ApplicantJob']['phone']))?$data['ApplicantJob']['phone']:'',
									'label'=>'雇主联系电话：','id'=>'phone')
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
								'ApplicantJob.provide_accom',
								array('value'=>(isset($data['ApplicantJob']['provide_accom']))?$data['ApplicantJob']['provide_accom']:'',
								'label'=>'是否提供住宿：','id'=>'provide_accom','options'=>array(0=>'雇主不提供',1=>'雇主提供'))
							);
							?>
						</div>
					</div>
			  
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantJob.email',
									array('value'=>(isset($data['ApplicantJob']['email']))?$data['ApplicantJob']['email']:'',
									'label'=>'雇主电子邮件：','id'=>'email','size'=>40)
							);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantJob.start_from',
									array(
										'default'=>(isset($data['ApplicantJob']['start_from']))?$data['ApplicantJob']['start_from']:'',
										'label'=>'开始日期：','before'=>'<div class="cake_input_date" name="start_from">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1)
							));
						?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantJob.end_by',
									array(
										'default'=>(isset($data['ApplicantJob']['end_by']))?$data['ApplicantJob']['end_by']:'',
										'label'=>'结束日期：','before'=>'<div class="cake_input_date" name="end_by">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1)
							));
							?>
						</div>
					</div>
			  </div>
			  <?php if ($this->Session->read('my_project')==PROJECT_STEP) {
			  	 ?>
			  	 
			  <div class="columns clearfix">
					<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantJob.hf_family_name',
									array('value'=>(isset($data['ApplicantJob']['hf_family_name']))?$data['ApplicantJob']['hf_family_name']:'',
									'label'=>'住宿家庭：','id'=>'hf_family_name','size'=>30)
							);
							?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantJob.family_address',
									array('value'=>(isset($data['ApplicantJob']['family_address']))?$data['ApplicantJob']['family_address']:'',
									'label'=>'家庭地址：','id'=>'family_address')
							);
							?>
						</div>
					</div>
			  		<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantJob.family_city_name',
									array('value'=>(isset($data['ApplicantJob']['family_city_name']))?$data['ApplicantJob']['family_city_name']:'',
									'label'=>'城市：','id'=>'family_city_name')
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
								'ApplicantJob.state_id',
								array('value'=>(isset($data['ApplicantJob']['state_id']))?$data['ApplicantJob']['state_id']:'',
								'label'=>'省份：','id'=>'state_id','options'=>$states)
							);
							?>
						</div>
					</div>
			  		
			  		<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'ApplicantJob.hf_status',
								array('value'=>(isset($data['ApplicantJob']['hf_status']))?$data['ApplicantJob']['hf_status']:'',
								'label'=>'HF状态：','id'=>'hf_status','options'=>array(0=>'否',1=>'是'))
							);
							?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantJob.hf_issue_date',
									array(
										'default'=>(isset($data['ApplicantJob']['hf_issue_date']))?$data['ApplicantJob']['hf_issue_date']:'',
										'label'=>'HF下发日期：','before'=>'<div class="cake_input_date" name="hf_issue_date">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1)
							));
						?>
						</div>
					</div>
			  </div>
			  <div class="columns clearfix">
			  		<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantJob.jf_issue_date',
									array(
										'default'=>(isset($data['ApplicantJob']['jf_issue_date']))?$data['ApplicantJob']['jf_issue_date']:'',
										'label'=>'JF下发日期：','before'=>'<div class="cake_input_date" name="jf_issue_date">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1)
							));
						?>
						</div>
					</div>
			  </div>
			  <?php
			  }?>
			  
			   <div class="columns clearfix">
						<fieldset class="label_side">
							<label>备注</label>
								<div>
									<?php 
									echo $this->Form->input('ApplicantJob.working_content',
												array(
													'label'=>'',
													'class'=>'tooltip autogrow',
													'title'=>'填写请细致，包含所有工作内容的细节',
													'placeholder'=>'点击开始输入',
													'type'=>'textarea',
													'div'=>false,
													'value'=>(isset($data['ApplicantJob']['working_content']))?$data['ApplicantJob']['working_content']:'',
													'id'=>'working_content'
												)
									);
								?>
							</div>
						</fieldset>
			   </div>
			  <div class="columns clearfix">
							<div id="modify_app_job_btn" class="short_message_btn">修改岗位资料</div>
							<div id="save_app_job_btn" class="short_message_btn">保存修改</div>
			  </div>
		  
		  
		  <table class="static"> 
					<thead> 
						<tr> 
							<th>要求的文件</th>
							<th>最后提交的文件</th>
							<th>上次提交日期</th>
							<th>审核结果</th> 
							<th>老师留言</th> 
							<th>资料状态</th> 
							<th>操作</th>
							<th>上传文档</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
						foreach ($applicants_settle_data as $value){
							?>
							<tr>
								<td>
								<?php echo (strlen($value['DownloadFile']['title'])>0)?$value['DownloadFile']['title']:$value['DownloadFile']['file_name']; ?>
								</td>
								<td><?php 
									echo is_null($value['ApplicantFile']['file_name'])?'未提交':$this->Html->link($value['ApplicantFile']['file_name'],array('controller'=>'ApplicantFiles','action'=>'download',$value['ApplicantFile']['id'])); 
								?></td>
								<td><?php 
									echo is_null($value['ApplicantFile']['modified'])?'无':$value['ApplicantFile']['modified']; 
								?></td>
								<td id="is_passed_<?php echo $value['ApplicantFile']['id']; ?>">
								<?php echo ($value['ApplicantFile']['is_passed']==1)?'<b style="color:green">通过</b>':'<b style="color:red">未通过</b>'; ?>
								</td>
								<td id="latest_comment_<?php echo $value['ApplicantFile']['id']; ?>">
								<?php echo is_null($value['ApplicantFile']['latest_comments'])?'没有留言':$value['ApplicantFile']['latest_comments']; ?>
								</td>
								<td id="is_readed_<?php echo $value['ApplicantFile']['id']; ?>">
								<?php echo ($value['ApplicantFile']['is_readed']==1)?'<b style="color:green">老师已阅</b>':'<b style="color:red">老师还没阅读</b>'; ?>
								</td>
								<td>
								<?php 
									if ($value['ApplicantFile']['id']) {
										echo $this->Html->link('查看文件',array('controller'=>'ApplicantFiles','action'=>'download',$value['ApplicantFile']['id'])),'&nbsp;&nbsp;&nbsp;';
										if ($value['ApplicantFile']['is_passed']==0) {
											echo $this->Html->link('通过',
											array('controller'=>'ApplicantFiles','action'=>'pass',$value['ApplicantFile']['id'],$data['Applicant']['id'],$phase_id),
											array(
												'title'=>'点击确认申请人提交的这个文件可以通过'
											),
											'您确认这个文件可以通过吗?'
											),'&nbsp;&nbsp;&nbsp;';
										}else{
											echo $this->Html->link('不通过',
											array('controller'=>'ApplicantFiles','action'=>'unpass',$value['ApplicantFile']['id'],$data['Applicant']['id'],$phase_id),
											array(
												'title'=>'点击确认申请人提交的这个文件需要重新提交',
												'style'=>'color:red'
											),
											'您确认这个文件需要申请人重新提交吗?'
											),'&nbsp;&nbsp;&nbsp;';
										}
										
										?>
										<a class="applicant_leave_comments_btn" id="<?php echo $value['ApplicantFile']['id']; ?>" href="#applicant_leave_comment_form">留言</a>
										<?php
									}else{
										echo '<b>申请人没有提交</b>';
									}
								?>
								</td>
								<td>
								<a href="#applicant_submit_file_form" class="teacher_upload_app_job_offer_btn"
										 name="<?php echo $value['DownloadFile']['phase_id']?>" title="<?php echo $value['DownloadFile']['id']?>">上传雇主的Job Offer</a>
								</td>
							</tr>
							<?php
							}
						?>
					</tbody>
				</table>
		</div>
<!-- 老师上传学生的job offer的表单 -->
<div style="display:none">
	<div id="applicant_submit_file_form" style="width:500px;height:300px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		上传雇主传回的学生Job Offer扫描件
		</h2>
		<?php 
			echo $this->Form->create(NULL,array('type'=>'file','url'=>'/ApplicantJobs/upload_job_offer')); 
			echo $this->Form->input('ApplicationFile.applicant_id',array('type'=>'hidden','value'=>$data['Applicant']['id']));
			echo $this->Form->input('ApplicationFile.download_file_id',array('type'=>'hidden','value'=>''));
			echo $this->Form->input('ApplicationFile.phase_id',array('type'=>'hidden','value'=>$phase_id));
		?>
		<fieldset class="label_side">
			<label>选择文件</label>
				<div>
					<?php echo $this->Form->file('Applicant.application_form',array('class'=>'uniform','id'=>'fileupload','type'=>'file')); ?>
				</div>
		</fieldset>
		<input type="submit" class="short_message_btn" value="上传Job Offer" />
		<?php echo $this->Form->end();?>
	</div>
</div>