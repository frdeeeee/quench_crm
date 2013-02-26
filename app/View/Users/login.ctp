<div id="wrapper">	
			<div class="isolate">
				<div id="login_box" class="center" style="display:none;">
					<?php 
						echo $this->Html->image('nova4you/nova4youlogo1.png',array());
					?>
					<div class="main_container clearfix">
						<div class="box">
							<div class="block">
								<div class="section">
									<div class="alert dismissible alert_light">
										<?php 
											//echo $this->Html->image('nova4you/logo_blacktext.png',array('height'=>24));
										?>
										<strong>Welcome to Quench CRM</strong> 
										<?php echo $this->Mytext->output('login_tip_1'); ?>
									</div>
								</div>	
								<?php 
									echo $this->Form->create('User',array('class'=>'validate_form'));
								?>
								<fieldset class="label_side">
									<label for="username_field">Username</label>
									<div>
										<input type="text" id="username_field" name="data[User][username]" class="required">
									</div>
								</fieldset>						
								<fieldset class="label_side">
									<label for="password_field">Password</label>
									<div>
										<input type="password" id="password_field" name="data[User][password]" class="required">
									</div>
								</fieldset>
								<fieldset class="no_label">																											
									<button class="light text_only has_text" style="margin-left: 180px;margin-top:10px;">
											<span>Enter</span>
									</button>	
									<?php //echo $this->Form->submit('登陆',array('class'=>'short_message_btn','style'=>'padding-bottom:15px;margin-left:140px;float:left;')); ?>
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
		
		<?php //echo $this->element('general/theme_switcher');?>