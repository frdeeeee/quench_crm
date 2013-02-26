<div id="wrapper">	
			<div class="isolate">
				<div id="login_box" class="center" style="display:none;">
					<div class="main_container clearfix">
						<div class="box">
							<div class="block">
								<div class="section">
									<div class="alert dismissible alert_light">
										<?php 
											echo $this->Html->image('icons/small/grey/locked.png',array('width'=>24,'height'=>24));
										?>
										<strong>
										Choose A Group
										</strong> 
										<?php echo $this->Mytext->output('login_tip_1'); ?>
									</div>
								</div>	
								<?php 
									echo $this->Form->create(NULL,array('url'=>'/Users/choose_my_current_group','type'=>'post'));
								?>
								<fieldset class="label_side">
									<label for="username_field">
									Your Group
									</label>
									<div>
										<select name="data[User][current_group]" id="current_group_selector">
											<option value="">Choose one ...</option>
											<?php 
												foreach ($my_groups as $value) {
													echo '<option value="'.$value['Group']['id'].'">'.$value['Group']['name'].'</option>';
												}
											?>
										</select>
									</div>
								</fieldset>	
								<fieldset class="label_side">
									<label>
									Your Task
									<?php echo $this->Html->image('ajax_refresh.gif',array('style'=>'display:none;','id'=>'icon_sms_sending_refresh')); ?>
									</label>
									<div>
										<select name="data[User][current_project]" id="current_project_selector">
											
											<?php //options由ajax方法自动查询后加载
												/*foreach ($projects as $value) {
													echo '<option value="',$value['Project']['id'],'">',$value['Task']['name'],'</option>';
												}*/
											?>
										</select>
									</div>
								</fieldset>						
								<fieldset class="no_label">																											
									<button class="light text_only has_text" style="margin-left: 180px;margin-top:10px;" id="enter_btn">
											<span>
											Start
											</span>
									</button>
								</fieldset>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
						<?php 
							echo $this->Html->image('nova4you/nova4youlogo1.png');
						?>
					</div>
				</div>
			</div>
</div>
<script type="text/javascript">
	$(".validate_form").validate();
</script>

		<div id="loading_overlay">
			<div class="loading_message round_bottom">
				<?php 
					echo $this->Html->image('loading.gif',array('alt'=>'loading'));
				?>
			</div>
		</div>
		
		<?php //echo $this->element('general/theme_switcher');?>