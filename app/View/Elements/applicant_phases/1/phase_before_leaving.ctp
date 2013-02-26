<div class="block"  id="app_itineray_form">
	<div class="columns clearfix">
					<div class="col_66">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.depart_datetime',
									array(
										'default'=>(isset($data['ApplicantItinerary']['depart_datetime']))?$data['ApplicantItinerary']['depart_datetime']:'',
										'label'=>'从中国出发时间：','before'=>'<div class="cake_input_datetime" name="depart_datetime">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1)
									));
						   ?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.depart_city',
									array('default'=>(isset($data['ApplicantItinerary']['depart_city']))?$data['ApplicantItinerary']['depart_city']:'','label'=>'从中国出发城市：','id'=>'depart_city'));
						   ?>
						</div>
					</div>
	</div>
	<div class="columns clearfix">
					<div class="col_33">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.arrive_datetime',
									array('default'=>(isset($data['ApplicantItinerary']['arrive_datetime']))?$data['ApplicantItinerary']['arrive_datetime']:'',
									'label'=>'到达美国时间：','before'=>'<div class="cake_input_datetime" name="arrive_datetime">','after'=>'</div>'
									,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1)
									));
						   ?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.arrive_city',
									array('value'=>(isset($data['ApplicantItinerary']['arrive_city']))?$data['ApplicantItinerary']['arrive_city']:'',
									'label'=>'到达美国的第一个城市：','id'=>'arrive_city'));
						   ?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'ApplicantItinerary.air_port_pick_status',
								array('value'=>(isset($data['ApplicantItinerary']['air_port_pick_status']))?$data['ApplicantItinerary']['air_port_pick_status']:'',
								'label'=>'接机是否安排：','id'=>'air_port_pick_status','options'=>array(0=>'等待',1=>'已安排'))
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
									'ApplicantItinerary.air_company_go',
									array('value'=>(isset($data['ApplicantItinerary']['air_company_go']))?$data['ApplicantItinerary']['air_company_go']:'','label'=>'去程航空公司：','id'=>'air_company_go'));
						   ?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_code_go',
									array('value'=>(isset($data['ApplicantItinerary']['air_code_go']))?$data['ApplicantItinerary']['air_code_go']:'','label'=>'去程航班号：','id'=>'air_code_go'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.is_pick_up',
									array('value'=>(isset($data['ApplicantItinerary']['is_pick_up']))?$data['ApplicantItinerary']['is_pick_up']:'','label'=>'雇主是否来接，如不来接是否提供指示：','id'=>'is_pick_up'));
						   ?>
						</div>
					</div>
	</div>
	
	<div class="columns clearfix">
		<fieldset class="label_side">
			<label>到达雇主处的方式</label>
				<div>
					<?php 
					echo $this->Form->input('ApplicantItinerary.how_to_meet',
												array(
													'label'=>'',
													'class'=>'tooltip autogrow',
													'title'=>'填写请细致，如预定了火车、巴士请注明时间。如城市间转乘飞机请注明航班号；出发、到达城市；出发、到达时间',
													'placeholder'=>'点击开始输入',
													'type'=>'textarea',
													'div'=>false,
													'value'=>(isset($data['ApplicantItinerary']['how_to_meet']))?$data['ApplicantItinerary']['how_to_meet']:'',
													'id'=>'how_to_meet'
												)
					);
				?>
			</div>
		</fieldset>
	</div>
	
	<div class="columns clearfix">
					<div class="col_66">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_arrive_date',
									array('default'=>(isset($data['ApplicantItinerary']['return_arrive_date']))?$data['ApplicantItinerary']['return_arrive_date']:'',
									'label'=>'回程到达日期（当地）：','before'=>'<div class="cake_input_datetime" name="return_arrive_date">','after'=>'</div>'
									,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1)
									));
						   ?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_depart_city',
									array('value'=>(isset($data['ApplicantItinerary']['return_depart_city']))?$data['ApplicantItinerary']['return_depart_city']:'',
									'label'=>'回程出发城市：','id'=>'return_depart_city'));
						   ?>
						</div>
					</div>
	</div>
	
	<div class="columns clearfix">
					<div class="col_33">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_arrive_city',
									array('value'=>(isset($data['ApplicantItinerary']['return_arrive_city']))?$data['ApplicantItinerary']['return_arrive_city']:'',
									'label'=>'回程抵达城市：','id'=>'return_arrive_city'));
						   ?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_code_return',
									array('value'=>(isset($data['ApplicantItinerary']['air_code_return']))?$data['ApplicantItinerary']['air_code_return']:'',
									'label'=>'回程航班号：','id'=>'air_code_return'));
						   ?>
						</div>
					</div>
					
					<div class="col_33">
						<div id="modify_app_itinerary_btn" class="short_message_btn">修改行程单</div>
						<div id="save_app_itinerary_btn" class="short_message_btn">保存行程单</div>
					</div>
	</div>
<!--  -->
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
							foreach ($applicants_before_leaving_data as $value){
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
										&nbsp;&nbsp;&nbsp;
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
</div>