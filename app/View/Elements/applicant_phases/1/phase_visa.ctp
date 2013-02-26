<div class="block" id="app_visa_form">
			 
			  <div class="columns clearfix">
					<div class="col_33">
						<div class="section">
							<?php 
								echo $this->Form->input(
									'ApplicantVisa.visa_traing_date',
									array(
										'default'=>(isset($data['ApplicantVisa']['visa_traing_date']))?$data['ApplicantVisa']['visa_traing_date']:'',
										'label'=>'签证培训日期：','before'=>'<div class="cake_input_date" name="visa_traing_date">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')),'empty'=>TRUE
								));	
							?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'ApplicantVisa.training_method_id',
								array('value'=>(isset($data['ApplicantVisa']['training_method_id']))?$data['ApplicantVisa']['training_method_id']:'',
								'label'=>'签证培训方式：','id'=>'training_method_id','options'=>$training_methods,'empty'=>'请选择...'));
							?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantVisa.last_training_address',
									array('value'=>(isset($data['ApplicantVisa']['last_training_address']))?$data['ApplicantVisa']['last_training_address']:'',
									'label'=>'培训地点：','id'=>'last_training_address','size'=>60));
							?>
						</div>
					</div>
					
			  </div>
			  <div class="columns clearfix">
					
					<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantVisa.visa_appointment_date',
									array(
										'default'=>(isset($data['ApplicantVisa']['visa_appointment_date']))?$data['ApplicantVisa']['visa_appointment_date']:'',
										'label'=>'签证日期：','before'=>'<div class="cake_input_date" name="visa_appointment_date">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')),'empty'=>TRUE
								));	
							?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php 
								echo $this->Form->input(
								'ApplicantVisa.embassy_id',
								array('value'=>(isset($data['ApplicantVisa']['embassy_id']))?$data['ApplicantVisa']['embassy_id']:'',
								'label'=>'签证领馆：','id'=>'embassy_id','options'=>$embassys,'empty'=>'请选择...'));
								
								echo $this->Form->input(
									'ApplicantVisa.embassy_address',
									array('value'=>(isset($data['ApplicantVisa']['embassy_address']))?$data['ApplicantVisa']['embassy_address']:'',
									'label'=>FALSE,'id'=>'embassy_address','size'=>50,'style'=>'display:none'));
							?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'ApplicantVisa.last_training_date',
									array(
										'default'=>(isset($data['ApplicantVisa']['last_training_date']))?$data['ApplicantVisa']['last_training_date']:'',
										'label'=>'行前培训日期：','before'=>'<div class="cake_input_date" name="last_training_date">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')),'empty'=>TRUE
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
								'ApplicantVisa.sevis',
								array('value'=>(isset($data['ApplicantVisa']['sevis']))?$data['ApplicantVisa']['sevis']:'',
								'label'=>'SEVIS费用：','id'=>'sevis','options'=>array(0=>'未交',1=>'已交')));
							?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php 
								echo $this->Form->input(
								'ApplicantVisa.ds2019',
								array('value'=>(isset($data['ApplicantVisa']['ds2019']))?$data['ApplicantVisa']['ds2019']:'',
								'label'=>'DS2019：','id'=>'ds2019','options'=>array(0=>'未收到',1=>'已收到')));
							?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php
							echo $this->Form->input(
								'ApplicantVisa.form160',
								array('value'=>(isset($data['ApplicantVisa']['form160']))?$data['ApplicantVisa']['form160']:'',
								'label'=>'160表：','id'=>'form160','options'=>array(0=>'未做好',1=>'已做好')));
							?>
						</div>
					</div>
			  </div>
			  <div class="columns clearfix">
					<div class="col_33">
						<div class="section">
							<?php 
								echo $this->Form->input(
									'ApplicantVisa.departure_date',
									array(
										'default'=>(isset($data['ApplicantVisa']['departure_date']))?$data['ApplicantVisa']['departure_date']:'',
										'label'=>'赴美时间：','before'=>'<div class="cake_input_date" name="departure_date">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE
								));	
							?>
						</div>
					</div>
						<div class="col_33">
							<div class="section">
							<?php //echo $this->Form->input('ApplicantVisa.return_date',
							//array('value'=>$data['ApplicantVisa']['return_date'],'label'=>'回国日期：',
							//'empty'=>TRUE,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1)));

							echo $this->Form->input(
									'ApplicantVisa.return_date',
									array(
										'default'=>(isset($data['ApplicantVisa']['return_date']))?$data['ApplicantVisa']['return_date']:'',
										'label'=>'回国日期：','before'=>'<div class="cake_input_date" name="return_date">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE
								));
							?>
							</div>
						</div>
						<div class="col_33">
								<div id="modify_app_visa_btn" class="short_message_btn">修改签证进度信息</div>
								<div id="save_app_visa_btn" class="short_message_btn">保存修改</div>
						</div>
			</div>
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
						</tr> 
					</thead> 
					<tbody>
						<?php 
							foreach ($applicants_visa_data as $value){
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
										<a class="applicant_leave_comments_btn" id="<?php echo $value['ApplicantFile']['id']; ?>" href="#applicant_leave_comment_form">留言</a>&nbsp;&nbsp;&nbsp;
										<a href="#applicant_submit_file_form" class="teacher_upload_app_job_offer_btn"
										 name="<?php echo $value['DownloadFile']['phase_id']?>" title="<?php echo $value['DownloadFile']['id']?>">上传</a>
										<?php
									}else{
										echo '<b>申请人没有提交</b>';
									}
								?>
								</td>
							</tr>
							<?php
							}
						?>
					</tbody>
				</table>
			
