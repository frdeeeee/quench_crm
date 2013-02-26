<?php 
	echo $this->Html->script('ajax_utils/send_multi_sms_utils',false); 
	echo $this->Html->script('ajax_utils/send_emails_utils',false); 
?>
<div class="flat_area grid_16">
	<h2>报名学生回访登记表</h2>
</div>
<div class="box grid_16">
	<a id="load_multi_sms_send_form_btn" class="short_message_btn" href="/Applicants/add/<?php echo $data['Enquiry']['id']?>">确认为申请人</a>
	<a rel="fancy_trigger_group" class="short_message_btn" href="#send_sms_form" title="<?php echo $data['Enquiry']['id'];?>">发送短信</a>
	<a rel="fancy_email_trigger_group" class="short_message_btn" href="#send_email_form" title="<?php echo $data['Enquiry']['id'];?>">发送邮件</a>
	<a class="short_message_btn" href="/Enquiries/list_all_for_operator" title="<?php echo $data['Enquiry']['id'];?>">返回报名学生列表</a>
</div>		
				<div class="box grid_16">
					<h2 class="box_head grad_red">报名项目：<?php echo $data['Project']['name'];?></h2>	
					<div class="toggle_container">
									<div class="block">
										<div class="columns clearfix">
											<div class="col_25">
												<div class="section">
												姓名：<div id="e_name<?php echo $data['Enquiry']['id'];?>"><?php echo $data['Enquiry']['name']; ?></div>
												</div>
											</div>
											<div class="col_25">
												<div class="section">
												学校：<?php echo $data['Enquiry']['school']; ?>
												</div>
											</div>
											<div class="col_25">
												<div class="section">
												专业：<?php echo $data['Enquiry']['major']; ?>
												</div>
											</div>
											<div class="col_25">
												<div class="section">
												毕业年：<?php echo $data['Enquiry']['grade']; ?>
												</div>
											</div>
										</div>
										<div class="columns clearfix">	
											<div class="col_25">
												<div class="section">
												手机：<div id="mobile_nb_<?php echo $data['Enquiry']['id'];?>"><?php echo $data['Enquiry']['mobile']; ?></div>
												</div>
											</div>
											<div class="col_25">
												<div class="section">
												邮箱：<div id="email_addr_<?php echo $data['Enquiry']['id'];?>"><?php echo $data['Enquiry']['email']; ?></div>
												</div>
											</div>
											<div class="col_25">
												<div class="section">
												宣讲日期：<?php echo $data['Enquiry']['created']; ?>
												</div>
											</div>
											<div class="col_25">
												<div class="section">
												考试日期：<?php echo $data['Enquiry']['exam_date']; ?>
												</div>
											</div>
										</div>
										<div class="columns clearfix">
											<div class="col_100">
												<div class="section">
													<p>销售备注:&nbsp;<?php echo $data['Enquiry']['comments']?></p>
												</div>
											</div>
										</div>
									</div>
					</div>
</div>
<!--  -->
<div class="box grid_16">
	<h2 class="box_head grad_green">添加新的回访纪录</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">					
			<div class="block">
				<?php 
					echo $this->Form->create('EnquiryFeedback');
					echo $this->Form->input('EnquiryFeedback.enquiry_id',array('type'=>'hidden','value'=>$data['Enquiry']['id']));
					echo $this->Form->input('EnquiryFeedback.operator_id',array('type'=>'hidden','value'=>$current_user['id']));
					echo $this->Form->input('EnquiryFeedback.is_feedback',array('type'=>'hidden','value'=>$data['Enquiry']['is_feedback']));
				?>
				<div class="columns clearfix">
				<div class="col_50">
					<div class="section">
						<?php echo $this->Form->input('EnquiryFeedback.created',array('label'=>'回访日期：','div'=>false)); ?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php echo $this->Form->input('EnquiryFeedback.answer_id',array('options'=>$answers,'label'=>'学生回复：','class'=>'select_box','div'=>false)); ?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php echo $this->Form->input('EnquiryFeedback.reason_id',array('options'=>$reasons,'label'=>'原因：','class'=>'select_box','div'=>false)); ?>
					</div>
				</div>
				</div>
				<div class="columns clearfix">
				<div class="col_75">
					<div class="section">
						<?php 
							echo $this->Form->input('EnquiryFeedback.comments',
									array('label'=>'备注','type'=>'textarea','div'=>false,'cols'=>80,'rows'=>4,'style'=>'border:solid 1px #E0E0E0'));
						?>
					</div>
				</div>
				<div class="col_25">
					<br></br><input type="submit" class="short_message_btn" style="padding-bottom: 20px;" value="提交回复">
				</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
</div>
<!--  -->
<div class="box grid_16">
	<h2 class="box_head grad_blue">过去的回访纪录: <?php echo (count($data['EnquiryFeedback'])==0)?'还没有回访纪录':count($data['EnquiryFeedback']).'条'; ?></h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">					
			<div class="block">
				<?php //pr($data); ?>	
				<?php 
					foreach ($data['EnquiryFeedback'] as $value){
						?>
						<div class="col_25">
							<div class="section">
								回访日期：<?php echo $value['created']?>
							</div>
						</div>
						<div class="col_25">
							<div class="section">
								学生回复：<?php echo $value['Answer']['name']?>
							</div>
						</div>
						<div class="col_25">
							<div class="section">
								原因：<?php echo $value['Reason']['name']?>
							</div>
						</div>
						<div class="col_25">
							<div class="section">
								备注：<?php echo $value['comments']?>
							</div>
						</div>
						
						<?php
					}
				?>
			</div>
		</div>
</div>
<?php 
	echo $this->element('fancy_forms/send_sms_form');
	echo $this->element('fancy_forms/send_email_form');
?>