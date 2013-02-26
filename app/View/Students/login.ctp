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
										<strong>欢迎来到优势项目－学生服务系统</strong> 
										<?php echo $this->Mytext->output('login_tip_1'); ?>
									</div>
								</div>	
								<?php 
									echo $this->Form->create('Enquiry',array('class'=>'validate_form'));
								?>
								<fieldset class="label_side">
									<label for="username_field">您的电子邮件</label>
									<div>
										<input type="text" id="username_field" name="data[Enquiry][username]" class="required">
									</div>
								</fieldset>						
								<fieldset class="label_side">
									<label for="password_field">您的手机号码</label>
									<div>
										<input type="password" id="password_field" name="data[Enquiry][password]" class="required">
									</div>
								</fieldset>
								<fieldset class="no_label">																											
									<div style="">
										<div class="slider_unlock" title="<?php echo $this->Mytext->output('login_btn_tip'); ?>"></div>
										<button type="submit" style="display:none"></button>
									</div>
								</fieldset>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
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