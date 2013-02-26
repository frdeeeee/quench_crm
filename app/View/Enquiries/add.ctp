<div class="flat_area grid_16">
	<h2>学生报名登记表</h2>
			<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
			?>
</div>
<div class="box grid_16 tabs">
					<ul class="tab_header clearfix">
						<?php 
							foreach ($tasks as $key=>$value) {
								echo '<li><a href="#tabs-',$key+1,'">',$value['Project']['name'],'</a></li>';
							}
						?>
					</ul>
					<div class="toggle_container">
						<?php 
						foreach ($tasks as $key=>$value) {
								?>
								<div id="tabs-<?php echo $key+1; ?>" class="block">
									
									<div class="block">
											<?php 
												echo $this->Form->create('Enquiry');
												echo $this->Form->input('Enquiry.project_id',array('type'=>'hidden','value'=>$value['Project']['id']));
												echo $this->Form->input('Enquiry.task_id',array('type'=>'hidden','value'=>$value['Task']['id']));
												echo $this->Form->input('Enquiry.group_id',array('type'=>'hidden','value'=>$this->Session->read('my_group')));
												echo $this->Form->input('Enquiry.input_user_id',array('type'=>'hidden','value'=>$current_user['id']));//谁输入的
											?>
										<div class="columns clearfix">
											<div class="section">
												<p>任务名称: <?php echo $value['Task']['name']; ?></p>
											</div>
										</div>
										<div class="columns clearfix">
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.name',array('label'=>'姓名(必填)：','div'=>false)); ?>
												</div>
											</div>
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.gender',array('label'=>'性别：','options'=>array('女','男'))); ?>
												</div>
											</div>
											<div class="col_25">
												<div class="section">
												<?php 
													$Customers[-1]='手工输入学校名称';//输入特殊的－1值来表示需要手工输入学校的名称
													echo $this->Form->input('Enquiry.customer_id',
														array('label'=>'学校(必填)：','options'=>$Customers,'empty'=>'请选择学校')
													); 
													echo $this->Form->input(
														'Enquiry.school',
														array(
															'label'=>FALSE,'div'=>false,'value'=>'学校名称',
															'onclick'=>'this.value=""',
															'style'=>'display:none','type'=>'text','size'=>40
														)
													);
												?>
												</div>
											</div>
											
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.department',array('label'=>'院系：','div'=>false)); ?>
												</div>
											</div>
											
										</div>
										<div class="columns clearfix">
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.grade',array('label'=>'毕业年：','div'=>false)); ?>
												</div>
											</div>
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.major',array('label'=>'专业：')); ?>
												</div>
											</div>
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.mobile',array('label'=>'手机(必填)：')); ?>
												</div>
											</div>
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.email',array('label'=>'邮箱(必填)：','size'=>30)); ?>
												</div>
											</div>
										</div>
										<div class="columns clearfix">
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.source_id',array('label'=>'渠道：','options'=>$sources)); ?>
												</div>
											</div>
											
											<div class="col_25">
												<div class="section">
												<?php 
													$presentations[OPERATION_OWNED_STUDENT]='自主报名';
													echo $this->Form->input('Enquiry.presentation_id',array('label'=>'途径：','options'=>$presentations,'empty'=>'请选择...')); 
												?>
												</div>
											</div>
											
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.intention_oversea',array('label'=>'是否有留学意向：','options'=>array('是','否'))); ?>
												</div>
											</div>
											
											<div class="col_25">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.intention_internship',array('label'=>'是否对国内实习感兴趣：','options'=>array('是','否'))); ?>
												</div>
											</div>
										</div>
										<div class="columns clearfix" style="display:none">	
											<div class="col_50">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.exam_date',array('label'=>'SLEP考试日期(必填): ','maxYear'=>(date('Y')+1),'minYear'=>(date('Y')))); ?>
												</div>
											</div>
											<div class="col_50">
												<div class="section">
												<?php echo $this->Form->input('Enquiry.slep_scores',array('label'=>'SLEP考试成绩: ','value'=>0,'div'=>false,'type'=>'text')); ?>
												</div>
											</div>
										</div>
										<div class="columns clearfix">
											<?php 
												echo $this->Form->input('Enquiry.how_to_konw_youthedu', array(
														'type' => 'select',
														'multiple' => 'checkbox',
														'options' => $how_to_konw_youthedu,
														'label'=>'得知优势项目的途径',
														'div'=>false,
														
														'before'=>'<fieldset class="label_side">',
														'between'=>'<div class="inline clearfix">',
														'after'=>'</div></fieldset>',
														'separator'=>''
												));
											?>
										</div>
										<div class="columns clearfix">
											<fieldset class="label_side">
												<label>还希望了解哪些项目内容</label>
												<div>
													<?php 
														echo $this->Form->input(
																'Enquiry.others_interesting',
																array('label'=>'',
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
																array('label'=>'',
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
														<span>提交</span>
													</button>
										</div>
									</div>
									<?php echo $this->Form->end();?>
						<br>
						<!-- start table -->
						<div class="box grid_16">
							<h2 class="box_head grad_blue">今日本项目新增销售记录</h2>
								<a href="#" class="grabber"></a>
								<a href="#" class="toggle"></a>
								<div class="toggle_container">					
									<div class="block">
										<table class="static"> 
											<thead> 
												<tr> 
													<th>姓名</th> 
													<th>学校</th> 
													<th>毕业年</th>
													<th>专业</th>
													<th>手机</th> 
													<th>项目</th> 
													<th>邮箱</th> 
													<th>渠道</th> 
													<th>途径</th> 
												</tr> 
											</thead> 
											<tbody>
												<?php 
													$sub_total = 0;
													foreach ($data as $v) {
														if ($v['Enquiry']['project_id']==$value['Project']['id']) {
															echo '<tr><td>',$v['Enquiry']['name'],'</td>';
															echo '<td>',$v['Enquiry']['school'],'</td>';
															echo '<td>',$v['Enquiry']['grade'],'</td>';
															echo '<td>',$v['Enquiry']['major'],'</td>';
															echo '<td>',$v['Enquiry']['mobile'],'</td>';
															echo '<td>',$v['Project']['name'],'</td>';
															echo '<td>',$v['Enquiry']['email'],'</td>';
															echo '<td>',$sources[$v['Enquiry']['source_id']],'</td>';
															echo '<td>',$v['Presentation']['name'],'</td></tr>';
															++$sub_total;
														}
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="section">
									<h3 style="text-align: right">本日新增数量：<b style="color: red"><?php echo $sub_total?></b></h3>
									</div>
								</div>
						</div>
						<!-- end of table -->
						</div>
								<?php
							}
						?>
					</div>
</div>