<div class="block"  id="app_itineray_form">
<h3 class="section" style="color: red">去程</h3>
	<h4 class="section">第一段</h4>
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.depart_datetime',
									array(
										'default'=>(isset($itinerary['ApplicantItinerary']['depart_datetime']))?$itinerary['ApplicantItinerary']['depart_datetime']:'',
										'label'=>'从中国出发时间：','before'=>'<div class="cake_input_datetime" name="depart_datetime">','after'=>'</div>',
										'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.arrive_datetime',
									array('value'=>(isset($itinerary['ApplicantItinerary']['arrive_datetime']))?$itinerary['ApplicantItinerary']['arrive_datetime']:'',
									'label'=>'到达时间：','before'=>'<div class="cake_input_datetime" name="arrive_datetime">','after'=>'</div>',
									'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE));
						   ?>
						</div>
					</div>
					
	</div>
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.depart_city',
									array('default'=>(isset($itinerary['ApplicantItinerary']['depart_city']))?$itinerary['ApplicantItinerary']['depart_city']:'','label'=>'从中国出发城市：','id'=>'depart_city'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.arrive_city',
									array('value'=>(isset($itinerary['ApplicantItinerary']['arrive_city']))?$itinerary['ApplicantItinerary']['arrive_city']:'','label'=>'到达的第一个城市：','id'=>'arrive_city'));
						   ?>
						</div>
					</div>
	</div>
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_company_go',
									array('value'=>(isset($itinerary['ApplicantItinerary']['air_company_go']))?$itinerary['ApplicantItinerary']['air_company_go']:'','label'=>'去程航空公司：','id'=>'air_company_go'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_code_go',
									array('value'=>(isset($itinerary['ApplicantItinerary']['air_code_go']))?$itinerary['ApplicantItinerary']['air_code_go']:'','label'=>'去程航班号：','id'=>'air_code_go'));
						   ?>
						</div>
					</div>
					
	</div>
	
	<h4 class="section">第二段（转机）</h4>
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.depart_datetime2',
									array(
										'default'=>(isset($itinerary['ApplicantItinerary']['depart_datetime2']))?$itinerary['ApplicantItinerary']['depart_datetime2']:'',
										'label'=>'出发时间：','before'=>'<div class="cake_input_datetime" name="depart_datetime2">','after'=>'</div>',
										'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.arrive_datetime2',
									array('value'=>(isset($itinerary['ApplicantItinerary']['arrive_datetime2']))?$itinerary['ApplicantItinerary']['arrive_datetime2']:'',
									'label'=>'到达时间：','before'=>'<div class="cake_input_datetime" name="arrive_datetime2">','after'=>'</div>',
									'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE));
						   ?>
						</div>
					</div>
					
	</div>
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.depart_city2',
									array('default'=>(isset($itinerary['ApplicantItinerary']['depart_city2']))?$itinerary['ApplicantItinerary']['depart_city2']:'',
									'label'=>'出发城市：','id'=>'depart_city2'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.arrive_city2',
									array('value'=>(isset($itinerary['ApplicantItinerary']['arrive_city2']))?$itinerary['ApplicantItinerary']['arrive_city2']:'',
									'label'=>'到达城市：','id'=>'arrive_city2'));
						   ?>
						</div>
					</div>
	</div>
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_company2',
									array('value'=>(isset($itinerary['ApplicantItinerary']['air_company2']))?$itinerary['ApplicantItinerary']['air_company2']:'','label'=>'去程航空公司：','id'=>'air_company2'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_code2',
									array('value'=>(isset($itinerary['ApplicantItinerary']['air_code2']))?$itinerary['ApplicantItinerary']['air_code2']:'','label'=>'去程航班号：','id'=>'air_code2'));
						   ?>
						</div>
					</div>
					
	</div>
	
	<h4 class="section">最终抵达</h4>
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.depart_datetime3',
									array(
										'default'=>(isset($itinerary['ApplicantItinerary']['depart_datetime3']))?$itinerary['ApplicantItinerary']['depart_datetime3']:'',
										'label'=>'出发时间：','before'=>'<div class="cake_input_datetime" name="depart_datetime3">','after'=>'</div>',
										'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.arrive_datetime3',
									array('value'=>(isset($itinerary['ApplicantItinerary']['arrive_datetime3']))?$itinerary['ApplicantItinerary']['arrive_datetime3']:'',
									'label'=>'到达时间：','before'=>'<div class="cake_input_datetime" name="arrive_datetime3">','after'=>'</div>',
									'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE));
						   ?>
						</div>
					</div>
					
	</div>
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.depart_city3',
									array('default'=>(isset($itinerary['ApplicantItinerary']['depart_city3']))?$itinerary['ApplicantItinerary']['depart_city3']:'',
									'label'=>'出发城市：','id'=>'depart_city3'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.arrive_city3',
									array('value'=>(isset($itinerary['ApplicantItinerary']['arrive_city3']))?$itinerary['ApplicantItinerary']['arrive_city3']:'',
									'label'=>'到达美国城市：','id'=>'arrive_city3'));
						   ?>
						</div>
					</div>
	</div>
	
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_company3',
									array('value'=>(isset($itinerary['ApplicantItinerary']['air_company3']))?$itinerary['ApplicantItinerary']['air_company3']:'',
									'label'=>'去程航空公司：','id'=>'air_company3'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_code3',
									array('value'=>(isset($itinerary['ApplicantItinerary']['air_code3']))?$itinerary['ApplicantItinerary']['air_code3']:'',
									'label'=>'去程航班号：','id'=>'air_code3'));
						   ?>
						</div>
					</div>
					
	</div>
	
	<div class="columns clearfix">
		<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_port_pick_status',
									array('value'=>(isset($itinerary['ApplicantItinerary']['air_port_pick_status']))?$itinerary['ApplicantItinerary']['air_port_pick_status']:'',
									'label'=>'接机是否安排：','id'=>'air_port_pick_status','options'=>array(0=>'等待安排',1=>'已安排')));
						   ?>
						</div>
		</div>
	</div>
	<hr>
	<h3 class="section" style="color: red">回程</h3>
	<h4 class="section">第一段</h4>	
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_depart_datetime',
									array('default'=>(isset($itinerary['ApplicantItinerary']['return_depart_datetime']))?$itinerary['ApplicantItinerary']['return_depart_datetime']:'',
									'label'=>'从美国出发时间：','before'=>'<div class="cake_input_datetime" name="return_depart_datetime">','after'=>'</div>',
									'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_arrive_date',
									array('default'=>(isset($itinerary['ApplicantItinerary']['return_arrive_date']))?$itinerary['ApplicantItinerary']['return_arrive_date']:'',
									'label'=>'到达时间：','before'=>'<div class="cake_input_datetime" name="return_arrive_date">','after'=>'</div>',
									'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE));
						   ?>
						</div>
					</div>
					
	</div>
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_depart_city',
									array('value'=>(isset($itinerary['ApplicantItinerary']['return_depart_city']))?$itinerary['ApplicantItinerary']['return_depart_city']:'',
									'label'=>'从美国出发城市：','id'=>'return_depart_city'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_arrive_city',
									array('value'=>(isset($itinerary['ApplicantItinerary']['return_arrive_city']))?$itinerary['ApplicantItinerary']['return_arrive_city']:'',
									'label'=>'抵达城市：','id'=>'return_arrive_city'));
						   ?>
						</div>
					</div>
	</div>
	
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_air_company',
									array('value'=>(isset($itinerary['ApplicantItinerary']['return_air_company']))?$itinerary['ApplicantItinerary']['return_air_company']:'',
									'label'=>'回程航空公司：','id'=>'return_air_company'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_code_return',
									array('value'=>(isset($itinerary['ApplicantItinerary']['air_code_return']))?$itinerary['ApplicantItinerary']['air_code_return']:'',
									'label'=>'回程航班号：','id'=>'air_code_return'));
						   ?>
						</div>
					</div>
					
	</div>
	
	<h4 class="section">第二段（转机）</h4>	
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_depart_datetime2',
									array('default'=>(isset($itinerary['ApplicantItinerary']['return_depart_datetime2']))?$itinerary['ApplicantItinerary']['return_depart_datetime2']:'',
									'label'=>'出发时间：','before'=>'<div class="cake_input_datetime" name="return_depart_datetime2">','after'=>'</div>',
									'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_arrive_date2',
									array('default'=>(isset($itinerary['ApplicantItinerary']['return_arrive_date2']))?$itinerary['ApplicantItinerary']['return_arrive_date2']:'',
									'label'=>'到达时间：','before'=>'<div class="cake_input_datetime" name="return_arrive_date2">','after'=>'</div>',
									'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE));
						   ?>
						</div>
					</div>
					
	</div>
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_depart_city2',
									array('value'=>(isset($itinerary['ApplicantItinerary']['return_depart_city2']))?$itinerary['ApplicantItinerary']['return_depart_city2']:'',
									'label'=>'出发城市：','id'=>'return_depart_city2'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_arrive_city2',
									array('value'=>(isset($itinerary['ApplicantItinerary']['return_arrive_city2']))?$itinerary['ApplicantItinerary']['return_arrive_city2']:'',
									'label'=>'抵达城市：','id'=>'return_arrive_city2'));
						   ?>
						</div>
					</div>
	</div>
	
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_air_company2',
									array('value'=>(isset($itinerary['ApplicantItinerary']['return_air_company2']))?$itinerary['ApplicantItinerary']['return_air_company2']:'',
									'label'=>'回程航空公司：','id'=>'return_air_company2'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_code_return2',
									array('value'=>(isset($itinerary['ApplicantItinerary']['air_code_return2']))?$itinerary['ApplicantItinerary']['air_code_return2']:'',
									'label'=>'回程航班号：','id'=>'air_code_return2'));
						   ?>
						</div>
					</div>
					
	</div>
	
	<h4 class="section">最终抵达</h4>	
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_depart_datetime3',
									array('default'=>(isset($itinerary['ApplicantItinerary']['return_depart_datetime3']))?$itinerary['ApplicantItinerary']['return_depart_datetime3']:'',
									'label'=>'出发时间：','before'=>'<div class="cake_input_datetime" name="return_depart_datetime3">','after'=>'</div>',
									'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_arrive_date3',
									array('default'=>(isset($itinerary['ApplicantItinerary']['return_arrive_date3']))?$itinerary['ApplicantItinerary']['return_arrive_date3']:'',
									'label'=>'到达时间：','before'=>'<div class="cake_input_datetime" name="return_arrive_date3">','after'=>'</div>',
									'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE));
						   ?>
						</div>
					</div>
					
	</div>
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_depart_city3',
									array('value'=>(isset($itinerary['ApplicantItinerary']['return_depart_city3']))?$itinerary['ApplicantItinerary']['return_depart_city3']:'',
									'label'=>'出发城市：','id'=>'return_depart_city3'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_arrive_city3',
									array('value'=>(isset($itinerary['ApplicantItinerary']['return_arrive_city3']))?$itinerary['ApplicantItinerary']['return_arrive_city3']:'',
									'label'=>'抵达中国城市：','id'=>'return_arrive_city3'));
						   ?>
						</div>
					</div>
	</div>
	
	<div class="columns clearfix">
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_air_company3',
									array('value'=>(isset($itinerary['ApplicantItinerary']['return_air_company3']))?$itinerary['ApplicantItinerary']['return_air_company3']:'',
									'label'=>'回程航空公司：','id'=>'return_air_company3'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_code_return3',
									array('value'=>(isset($itinerary['ApplicantItinerary']['air_code_return3']))?$itinerary['ApplicantItinerary']['air_code_return3']:'',
									'label'=>'回程航班号：','id'=>'air_code_return3'));
						   ?>
						</div>
					</div>
					
	</div>
	
	
	<div class="columns clearfix">
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