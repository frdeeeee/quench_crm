<?php 
	echo $this->Html->script('ajax_utils/utils_students',false); 
?>
<div class="flat_area grid_16">
	<h2>欢迎来到赴美阶段Check-In管理系统</h2>
	<?php 
			echo '<p>我的状态：<b style="color:red">',$return_status[$data['Applicant']['return_status_id']],'</b></p>';
	?>
</div>
<?php 
	echo $this->element('general/student_shortcuts');
?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">我的回国申请登记</h2>
	<div class="toggle_container">
		<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
		?>
		<div class="block">
			<h2 class="section">基本信息</h2>
<?php echo $this->Form->create(); 
	echo $this->Form->input('Applicant.id',array('type'=>'hidden','value'=>$data['Applicant']['id']));
	echo $this->Form->input('Applicant.return_status_id',array('type'=>'hidden','value'=>2));
?>
			<fieldset>
				<label>到达中国日期与时间</span> </label>
				<div class="clearfix">
						<?php 
						echo $this->Form->input('Applicant.return_date',array(
							'label'=>'','div'=>false,'default'=>$data['Applicant']['return_date'],'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')),
						));
						?>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			
			<fieldset>
				<label>项目是否正常完成</span> </label>
				<div class="clearfix">
						<?php 
						echo $this->Form->input('Applicant.project_status_id',array(
							'options'=>$project_status,
							'label'=>'','div'=>false,
							'value'=>$data['Applicant']['project_status_id']
						));
						?>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
					<button class="green full_width div_icon has_text">
						<div class="ui-icon ui-icon-carat-1-n"></div>
						<span>更新我的回国登记</span>
					</button>
<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>