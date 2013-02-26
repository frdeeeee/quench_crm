<div class="flat_area grid_16">
	<h2>Change Password For - <?php echo $data['User']['name']?></h2>
</div>
<div class="box grid_16 tabs">
						<div id="tabs-1" class="block">
							<div class="box grid_16">
								<?php 
									if (isset($msg_type)) {
										echo $this->Msg->output( $msg_type,$this->Session->flash() );
									}
									echo $this->Form->create('User');
									echo $this->Form->input('User.id',array('type'=>'hidden','value'=>$data['User']['id']));
								?>
									<fieldset class="label_side">
										<label>New Password</label>
										<div>
											<?php 
												echo $this->Form->input('User.new_password',array('label'=>'','div'=>false));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Confirm New Password</label>
										<div>
											<?php 
												echo $this->Form->input('User.new_password_confirm',array('label'=>'','div'=>false));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
			
										<button class="green full_width">
											<div class="ui-icon ui-icon-carat-1-n"></div>
											<span>Confirm Changing</span>
										</button>
								<?php echo $this->Form->end();?>
							</div>
						</div>
		</div>