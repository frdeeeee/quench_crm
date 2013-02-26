<div style="display:none">
	<div id="switch_group_wrapper" style="width:700px;height:315px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		切换我当前的工作组
		</h2>
		<?php 
			echo $this->Form->create();
		?>
		<fieldset class="label_side">
			<label>我的工作组</label>
				<div>
					<?php 
						echo $this->Form->input('Enquiry.group_id',
							array('label'=>'','div'=>false,'options'=>array(),'id'=>'current_group_selector'));
					?>
				</div>
		</fieldset>
								<fieldset class="label_side">
									<label>
									选择任务：
									<?php echo $this->Html->image('ajax_refresh.gif',array('style'=>'display:none;','id'=>'icon_sms_sending_refresh')); ?>
									</label>
									<div>
										<select name="data[User][current_project]" id="current_project_selector">
											<?php //options由ajax方法自动查询后加载?>
										</select>
									</div>
								</fieldset>	
		<div id="switch_group_btn" class="short_message_btn">
				立即切换
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>