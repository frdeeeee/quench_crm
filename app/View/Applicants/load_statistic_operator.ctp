		<div class="flat_area grid_16">
			<h2>运营数据汇总表</h2>
			<p>截止今天，项目的进展情况如下: </p>
		</div>
<div class="box grid_16">
	<div class="block" style="padding: 5px;">	
			<div class="tb">报名人数</div>
			<div class="tb">已提交中文报名表人数</div>
			<div class="tb_big">
				<div class="tb_inner_head">
					SLEP考试
				</div>
				<div class="tb_inner_sub_left">已参加</div>
				<div class="tb_inner_sub_right">未参加</div>
			</div>
			<div class="tb_big">
				<div class="tb_inner_head">
					考试成绩
				</div>
				<div class="tb_inner_sub_left">通过人数</div>
				<div class="tb_inner_sub_right">未通过</div>
			</div>
			<div class="tb">转为申请阶段人数</div>
			<div class="tb">申请资料未准备好人数</div>
			<div class="tb_big">
				<div class="tb_inner_head">
					签证资料
				</div>
				<div class="tb_inner_sub_left">准备好</div>
				<div class="tb_inner_sub_right">未准备好</div>
			</div>
			<div class="clearfix"></div>
			<div class="tb_v">
				<?php 
					echo $this->Html->link($data['total_enquiry'],
						array(
							'controller'=>'Enquiries',
							'action'=>'show',
							'total_enquiry'
						)
					);
				?>
			</div>
			<div class="tb_v">
				<?php 
					echo $this->Html->link($data['total_app_form_submitted'],
						array(
							'controller'=>'Enquiries',
							'action'=>'show',
							'total_app_form_submitted'
						)
					);
				?>
			</div>
			<div class="tb_v">
				<?php 
					echo $this->Html->link($data['total_slep_attend'],
						array(
							'controller'=>'Enquiries',
							'action'=>'show',
							'total_slep_attend'
						)
					);
				?>
			</div>
			<div class="tb_v">
				<?php 
					echo $this->Html->link($data['total_slep_not_attend'],
						array(
							'controller'=>'Enquiries',
							'action'=>'show',
							'total_slep_not_attend'
						)
					);
				?>
			</div>
				<div class="tb_v">
					<?php 
						echo $this->Html->link($data['total_slep_pass'],
							array(
								'controller'=>'Enquiries',
								'action'=>'show',
								'total_slep_pass'
							)
						);
					?>
				</div>
				<div class="tb_v">
					<?php 
						echo $this->Html->link($data['total_slep_not_pass'],
							array(
								'controller'=>'Enquiries',
								'action'=>'show',
								'total_slep_not_pass'
							)
						);
					?>
				</div>
			<div class="tb_v">
				<?php 
						echo $this->Html->link($data['total_enquiry_is_app'],
							array(
								'controller'=>'Enquiries',
								'action'=>'show',
								'total_enquiry_is_app'
							)
						);
				?>
			</div>
			<div class="tb_v"><?php echo $data['app_data_not_done']?></div>
				<div class="tb_v"><?php echo $data['visa_data_done']?></div>
				<div class="tb_v"><?php echo $data['visa_data_not_done']?></div>
			<div class="clearfix"></div>
			
			<div class="tb">已安置人数</div>
			<div class="tb">已做160表人数</div>
			<div class="tb">等待签证预约人数</div>
			<div class="tb">签证培训人数</div>
			<div class="tb">签证人数</div>
			<div class="tb">签证通过人数</div>
			<div class="tb">行前培训人数</div>
			<div class="tb">赴美阶段人数</div>
			<div class="tb">回国阶段人数</div>
			<div class="tb">退出项目人数</div>
			<div class="clearfix"></div>
			
			<div class="tb_v"><?php echo $data['in_phase_settle']?></div>
			<div class="tb_v"><?php echo $data['done_160']?></div>
			<div class="tb_v"><?php echo $data['waiting_for_visa_appointment']?></div>
			<div class="tb_v"><?php echo $data['has_visa_training_date']?></div>
			
			<div class="tb_v"><?php echo $data['has_visa_appointment_date']?></div>
			<div class="tb_v"><?php echo $data['get_visa']?></div>
			<div class="tb_v"><?php echo $data['has_before_leaving_training_date']?></div>
			<div class="tb_v"><?php echo $data['in_phase_oversea']?></div>
			<div class="tb_v"><?php echo $data['in_phase_return']?></div>
			<div class="tb_v"><?php echo $data['get_cancelled']?></div>
	</div>
</div>

<?php 
	if (isset($to_do_next_week)) {
		?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">近一周工作提醒</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle toggle_closed"></a>
		<div class="toggle_container"  style="display:none;">
			<?php 
				if (!empty($to_do_next_week)) {
					foreach ($to_do_next_week as $key=>$value) {
						?>
						<div class="block" style="opacity: 1;">
							<div class="section">
								<p><b><?php echo $key+1;?>:</b>
								<?php echo $value['WorkingLog']['next_appointment']?>,联系
								<?php echo $value['Customer']['name']?>的
								<?php echo $value['Contact']['name']?>,讨论关于"<?php echo $value['WorkingLog']['next_title']?>"的问题.
								<?php 
									if ($value['WorkingLog']['new_feedback']==1) {
										echo '<b style="color:red">有新的领导批示。</b>';
									}
									echo $this->Html->link('点击查看详细纪录',array('controller'=>'WorkingLogs','action'=>'view_detail',$value['WorkingLog']['id']));
								?>
								</p>
							</div>
						</div>
						<?php
					}
				}else{
					?>
						<div class="block" style="opacity: 1;">
							<div class="section">
								<p>不会吧，没事可做！</p>
							</div>
						</div>
					<?php
				}
			?>
		</div>
</div>
		<?php
	}
?>	

<?php 
	if (isset($pendings)) {
		?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">待完成工作</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle toggle_closed"></a>
		<div class="toggle_container" style="display:none;">
			<?php 
				if ( !empty($pendings) ) {
					foreach ($pendings as $key=>$value) {
						?>
						<div class="block" style="opacity: 1;">
							<div class="section">
								<p><b><?php echo $key+1;?>:</b>
								<?php echo $value['WorkingLog']['next_appointment']?>,联系
								<?php echo $value['Customer']['name']?>的
								<?php echo $value['Contact']['name']?>,讨论关于"<?php echo $value['WorkingLog']['next_title']?>"的问题.
								<?php 
									if ($value['WorkingLog']['new_feedback']==1) {
										echo '<b style="color:red">有新的领导批示。</b>';
									}
									echo $this->Html->link('点击查看详细纪录',array('controller'=>'WorkingLogs','action'=>'view_detail',$value['WorkingLog']['id']));
								?>
								</p>
							</div>
						</div>
						<?php
					}
				}else{
					?>
						<div class="block" style="opacity: 1;">
							<div class="section">
								<p>强！能做的都做了。</p>
							</div>
						</div>
					<?php
				}
			?>
		</div>
</div>
		<?php
	}
?>
</div>
<?php echo $this->element('general/notes_module'); ?>	