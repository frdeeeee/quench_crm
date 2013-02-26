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
										您被分配负责多个项目，选择准备操作的项目
										</strong> 
										<?php echo $this->Mytext->output('login_tip_1'); ?>
									</div>
								</div>	
								<?php 
									echo $this->Form->create(NULL,array('url'=>'/Users/choose_my_current_project','type'=>'post'));
								?>
								<fieldset class="label_side">
									<label for="username_field">
									选择项目
									</label>
									<div>
										<select name="data[User][current_project]" id="current_project_selector">
											<option value="">请选择...</option>
											<?php 
												foreach ($projects_options as $key=>$value) {
													echo '<option value="'.$key.'">'.$value.'</option>';
												}
											?>
										</select>
									</div>
								</fieldset>	
								<fieldset class="no_label">																											
									<button class="light text_only has_text" style="margin-left: 180px;margin-top:10px;" id="enter_btn">
											<span>
											确认
											</span>
									</button>
								</fieldset>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
						<?php 
							echo 'here';
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