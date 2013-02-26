<div class="flat_area grid_16">
	<h2>短信模板列表</h2>
</div>
<div class="box grid_16">
	<div class="block">
		<h2 style="margin: 10px;">
		添加新的短信模板
		</h2>
		<?php 
			echo $this->Form->create('TextingTemplate',array('url'=>'add')); 
		?>
		<fieldset class="label_side">
			<label>模板名称</label>
				<div>
					<?php echo $this->Form->input('TextingTemplate.name',array('label'=>'','div'=>false)); ?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>短信内容</label>
				<div>
					<?php echo $this->Form->input('TextingTemplate.content',array('label'=>'','div'=>FALSE,'type'=>'textarea')); ?>
				</div>
		</fieldset>
		<div class="section">
													<button class="navy full_width">
														<div class="ui-icon ui-icon-carat-1-n"></div>
														<span>提交</span>
													</button>
										</div>
		<?php echo $this->Form->end();?>
	</div>
</div>

<div class="box grid_16">
	<div class="block">	
		<?php 
			if (isset($msg_type)) {
				echo $this->Msg->output( $msg_type,$this->Session->flash() );
			}
		?>
		<table class="static"> 
			<thead> 
				<tr> 
					<th>名称</th> 
					<th>内容</th>
					<th>操作</th>
				</tr> 
			</thead> 
			<tbody>
				<?php 
					foreach ($data as $value) {
						?>
						<tr> 
							<td width="30%"><?php 
									echo $value['TextingTemplate']['name'];
							?></td> 
							<td width="50%">
								<?php 
									echo $value['TextingTemplate']['content'];
								?>
							</td>
							<td width="20%">
								<?php 
									echo $this->Html->link('修改模板',array('controller'=>'TextingTemplates','action'=>'modify',$value['TextingTemplate']['id'])),'&nbsp;&nbsp;';
									echo $this->Html->link('删除',array('controller'=>'TextingTemplates','action'=>'remove',$value['TextingTemplate']['id']));
								?>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>