<div class="flat_area grid_16">
	<h2>添加批示</h2>
	<p><strong style="color:red">* 批示提交后无法更改，请确保内容准确.</strong></p>
</div>
<div class="box grid_16">
	<?php 
		if (isset($msg_type)) {
			echo $this->Msg->output( $msg_type,$this->Session->flash() );
		}
	?>
	<div class="block">	
		<?php 
			echo $this->Form->create('WorkingLog');
			echo $this->Form->input('WorkingLog.id',array('type'=>'hidden','value'=>$data['WorkingLog']['id']));
			//pr($data);
	    ?>
		<fieldset class="label_side">
			<label>批示内容</label>
				<div>
					<?php 
						echo $this->Form->input(
								'WorkingLog.feedback_content',
								array('label'=>'','div'=>false));
					?>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
		</fieldset>

		<button class="green full_width">
			<div class="ui-icon ui-icon-carat-1-n"></div>
				<span>提交</span>
		</button>
	<?php echo $this->Form->end();?>
	</div>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_blue">已有批示</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">
			<?php 
			foreach ($data['WorkingLogFeedback'] as $value) {
				?>
				<div class="block" style="opacity: 1;">
					<div class="section">
						<p><b>标题：</b><?php echo $value['content']; ?></p>
					</div>
				</div>
				<?php
			}
			?>
		</div>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_green">工作纪录内容</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">
			<div class="block" style="opacity: 1;">
				<div class="section">
					<p><b>标题：</b><?php echo $data['WorkingLog']['name']?></p>
				</div>
			</div>
			<div class="block" style="opacity: 1;">
				<div class="section">
					<p><b>沟通日期：</b><?php echo $data['WorkingLog']['created']?></p>
				</div>
			</div>
			<div class="block" style="opacity: 1;">
				<div class="section">
					<p><b>沟通内容：</b><?php echo $data['WorkingLog']['content']?></p>
				</div>
			</div>
			<div class="block" style="opacity: 1;">
				<div class="section">
					<p><b>沟通结果：</b><?php echo $data['WorkingLog']['result']?></p>
				</div>
			</div>
			<div class="block" style="opacity: 1;">
				<div class="section">
					<p><b>问题与建议：</b><?php echo $data['WorkingLog']['questions']?></p>
				</div>
			</div>
			<div class="block" style="opacity: 1;">
				<div class="section">
					<p><b>下次沟通日期：</b><?php echo $data['WorkingLog']['questions']?></p>
				</div>
			</div>
		</div>
</div>