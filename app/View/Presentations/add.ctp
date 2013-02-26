<div class="flat_area grid_16">
	<h2>宣讲会登记表</h2>
	<p><strong style="color:red">* 该表提交后无法更改，请确保内容准确.</strong></p>
</div>
<div class="box grid_16">
		<?php 
			if (isset($msg_type)) {
				echo $this->Msg->output( $msg_type,$this->Session->flash() );
			}
			echo $this->Form->create('Presentation');
			echo $this->Form->input('Presentation.group_id',array('type'=>'hidden','value'=>$this->Session->read('my_group')));
		?>
					<h2 class="box_head grad_blue">客户信息</h2>
					<a href="#" class="grabber"></a>
					<a href="#" class="toggle"></a>
					<div class="toggle_container">					
						<div class="block">
							<div class="columns clearfix">
								<div class="col_33">
									<div class="section">
										<?php echo $this->Form->input('Presentation.name',array('label'=>'宣讲会主题：','div'=>FALSE,'size'=>40)); ?>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
										<?php echo $this->Form->input('Presentation.hold_on',array('label'=>'宣讲会预定日期：','maxYear'=>(date('Y')+1),'minYear'=>(date('Y')))); ?>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
										<?php echo $this->Form->input('Presentation.customer_id',array('label'=>'学校：','options'=>$Customers,'empty'=>'请选择学校...')); ?>
									</div>
								</div>
							</div>
							<div class="columns clearfix">
								<div class="col_33">
									<div class="section">
										<?php echo $this->Form->input('Presentation.speaker',array('label'=>'宣讲会预定主讲人：','div'=>false)); ?>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
										<?php echo $this->Form->input('Presentation.manager',array('label'=>'负责人：','div'=>false)); ?>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
										<?php echo $this->Form->input('Presentation.student_name',array('label'=>'互动学生：','div'=>false)); ?>
									</div>
								</div>
							</div>
							<div class="columns clearfix">
								<div class="col_33">
									<div class="section">
										<?php echo $this->Form->input('Presentation.contact_name',array('label'=>'学校联系人：','div'=>false)); ?>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
										<?php echo $this->Form->input('Presentation.dept_name',array('label'=>'部门：','div'=>false)); ?>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
										<?php echo $this->Form->input('Presentation.contact_phone',array('label'=>'电话：','div'=>false)); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
</div>
<div class="box grid_16">
			<h2 class="box_head grad_blue">项目信息</h2>
					<a href="#" class="grabber"></a>
					<a href="#" class="toggle"></a>
					<div class="toggle_container">	
						<div class="block">
										<?php 
											echo $this->Form->input('Presentation.projects', array(
													'type' => 'select',
													'multiple' => 'checkbox',
													'options' => $projects,
													'label'=>'项目','div'=>false,
													'before'=>'<fieldset class="label_side">',
													'between'=>'<div class="inline clearfix">',
													'after'=>'</div></fieldset>',
													'separator'=>''
											));
										?>
										<?php 
											echo $this->Form->input('Presentation.channels', array(
													'type' => 'select',
													'multiple' => 'checkbox',
													'options' => $channels,
													'label'=>'宣传途径',
													'div'=>false,
													
													'before'=>'<fieldset class="label_side">',
													'between'=>'<div class="inline clearfix">',
													'after'=>'</div></fieldset>',
													'separator'=>''
											));
										?>
						</div>
				</div>
</div>

<div class="box grid_16">
					<h2 class="box_head grad_blue">宣讲会进行情况</h2>
					<a href="#" class="grabber"></a>
					<a href="#" class="toggle"></a>
					<div class="toggle_container">					
						<div class="block">
							<div class="columns clearfix">
								<div class="col_25">
									<div class="section">
										<?php echo $this->Form->input('Presentation.arrived_number',array('label'=>'到场人数：','div'=>false,'type'=>'text')); ?>
									</div>
								</div>
								<div class="col_25">
									<div class="section">
										<?php echo $this->Form->input('Presentation.regist_number',array('label'=>'报名人数：','div'=>false,'type'=>'text')); ?>
									</div>
								</div>
								<div class="col_50">
									<div class="section">
										<?php echo $this->Form->input('Presentation.exam_date',array('label'=>'SLEP考试日期：','div'=>false,'empty'=>FALSE,'maxYear'=>(date('Y')+2),'minYear'=>(date('Y')))); ?>
									</div>
								</div>
							</div>
							<div class="columns clearfix">
									<div class="section">
										<fieldset class="label_side">
											<label>宣讲会情况</label>
											<div>
												<?php 
													echo $this->Form->input(
															'Presentation.summary',
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
										<fieldset class="label_side">
											<label>需改进及建议</label>
											<div>
												<?php 
													echo $this->Form->input(
															'Presentation.comments',
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
							</div>
						</div>
					</div>
</div>


<div class="box grid_16">
	
		<button class="green full_width">
											<div class="ui-icon ui-icon-carat-1-n"></div>
											<span>提交</span>
										</button>
								<?php echo $this->Form->end();?>
	</div>
