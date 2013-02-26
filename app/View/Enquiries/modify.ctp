
<div class="flat_area grid_16">
	<h2>修改学生报名登记表</h2>
			<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
			?>
</div>
<div class="box grid_16 tabs">
		<h2 class="box_head grad_red">报名表信息</h2>	
			<a href="#" class="grabber"></a> <a href="#" class="toggle"></a>
					<div class="toggle_container">
									<div class="block">
											<?php 
												echo $this->Form->create('Enquiry');
												echo $this->Form->input('Enquiry.id',array('type'=>'hidden','value'=>$data['Enquiry']['id']));
											?>
										<div class="columns clearfix">
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.name',array('label'=>'姓名(必填)：','value'=>$data['Enquiry']['name'])); ?>
												</div>
											</div>
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.gender',array('label'=>'性别：','options'=>array('女','男'),'value'=>$data['Enquiry']['gender'])); ?>
												</div>
											</div>
											<div class="col_25">
												<div class="section">
												<?php 
													$Customers[-1]='手工输入学校名称';//输入特殊的－1值来表示需要手工输入学校的名称
													echo $this->Form->input('Enquiry.customer_id',
														array('label'=>'学校(必填)：','options'=>$Customers,'value'=>$data['Enquiry']['customer_id'],'empty'=>'手工输入')
													); 
													if ($data['Enquiry']['customer_id']==0) {
														echo $this->Form->input(
															'Enquiry.school',
															array(
																'label'=>FALSE,'div'=>false,'value'=>$data['Enquiry']['school'],
																'onclick'=>'this.value=""',
																'type'=>'text','size'=>40
															)
														);
													}else{
														echo $this->Form->input(
															'Enquiry.school',
															array(
																'label'=>FALSE,'div'=>false,'value'=>$data['Enquiry']['school'],
																'onclick'=>'this.value=""',
																'style'=>'display:none','type'=>'text','size'=>40
															)
														);
													}
												?>
												</div>
											</div>
											
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.grade',array('label'=>'毕业年：','value'=>$data['Enquiry']['grade'])); ?>
												</div>
											</div>
											
										</div>
										<div class="columns clearfix">
											
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.major',array('label'=>'专业：','value'=>$data['Enquiry']['major'])); ?>
												</div>
											</div>
											
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.mobile',array('label'=>'手机(必填)：','value'=>$data['Enquiry']['mobile'])); ?>
												</div>
											</div>
											
											<div class="col_50">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.email',array('label'=>'邮箱(必填)：','size'=>50,'value'=>$data['Enquiry']['email'])); ?>
												</div>
											</div>
										</div>
										<div class="columns clearfix">
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.source_id',array('label'=>'渠道：','options'=>$sources,'value'=>$data['Enquiry']['source_id'])); ?>
												</div>
											</div>
											
											<div class="col_25">
												<div class="section">
												<?php 
												$presentations[OPERATION_OWNED_STUDENT]='自主报名';	
												echo $this->Form->input('Enquiry.presentation_id',
													array('label'=>'途径：','options'=>$presentations,'value'=>$data['Enquiry']['presentation_id'])); 
												?>
												</div>
											</div>
											
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.intention_oversea',array('label'=>'是否有留学意向：','options'=>array('是','否'),'value'=>$data['Enquiry']['intention_oversea'])); ?>
												</div>
											</div>
											
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.intention_internship',array('label'=>'是否对国内实习感兴趣：','options'=>array('是','否'),'value'=>$data['Enquiry']['intention_internship'])); ?>
												</div>
											</div>
										</div>
										<div class="columns clearfix">	
											<div class="col_33">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.is_app_form_submit',array('label'=>'是否提交报名表：','options'=>array(1=>'已提交',0=>'未提交'),'value'=>$data['Enquiry']['is_app_form_submit'])); ?>
												</div>
											</div>
											<div class="col_33">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.exam_date',array('label'=>'SLEP考试日期(必填): ','default'=>$data['Enquiry']['exam_date'],'empty'=>true,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')))); ?>
												</div>
											</div>
											<div class="col_33">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.slep_scores',array('label'=>'SLEP考试成绩(必填): ','value'=>$data['Enquiry']['slep_scores'],'type'=>'text','size'=>2)); ?>
												</div>
											</div>
										</div>
										<div class="columns clearfix">
											<fieldset class="label_side">
												<label>还希望了解哪些项目内容</label>
												<div>
													<?php 
														echo $this->Form->input(
																'Enquiry.others_interesting',
																array('label'=>'','value'=>$data['Enquiry']['others_interesting'],
																		'class'=>'tooltip autogrow',
																		'title'=>"输入框会自动根据您的输入调整大小",
																		'placeholder'=>'点击输入',
																		'type'=>'textarea',
																		'div'=>false));
													?>
												</div>
											</fieldset>
										</div>
										<div class="columns clearfix">
											<fieldset class="label_side">
												<label>销售备注</label>
												<div>
													<?php 
														echo $this->Form->input(
																'Enquiry.comments',
																array('label'=>'','value'=>$data['Enquiry']['comments'],
																		'class'=>'tooltip autogrow',
																		'title'=>"输入框会自动根据您的输入调整大小",
																		'placeholder'=>'点击输入',
																		'type'=>'textarea',
																		'div'=>false));
													?>
												</div>
											</fieldset>
										</div>
										
										<div class="section">
													<button class="green full_width">
														<div class="ui-icon ui-icon-carat-1-n"></div>
														<span>修改报名表信息</span>
													</button>
										</div>
									</div>
									<?php echo $this->Form->end();?>
					</div>
</div>