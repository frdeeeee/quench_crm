<div class="flat_area grid_16">
	<h2>修改短信模板</h2>
</div>
<div class="box grid_16">
	<div class="block">
		<?php 
			echo $this->Form->create('TextingTemplate',array('url'=>'modify')); 
			echo $this->Form->input('TextingTemplate.id',array('type'=>'hidden','value'=>$data['TextingTemplate']['id']));
		?>
		<fieldset class="label_side">
			<label>模板名称</label>
				<div>
					<?php echo $this->Form->input('TextingTemplate.name',array('label'=>'','div'=>false,'value'=>$data['TextingTemplate']['name'])); ?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>短信内容</label>
				<div>
					<?php echo $this->Form->input('TextingTemplate.content',array('label'=>'','div'=>FALSE,'type'=>'textarea','value'=>$data['TextingTemplate']['content'])); ?>
				</div>
		</fieldset>
		<div class="section">
													<button class="navy full_width">
														<div class="ui-icon ui-icon-carat-1-n"></div>
														<span>确认修改</span>
													</button>
										</div>
		<?php echo $this->Form->end();?>
	</div>
</div>