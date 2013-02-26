		<div class="flat_area grid_16">
			<h2>Set Up A New Meeting</h2>
		</div>
		<div class="box grid_16 tabs">
						<div id="tabs-1" class="block">
							<div class="box grid_16">
								<?php 
									if (isset($msg_type)) {
										echo $this->Msg->output( $msg_type,$this->Session->flash() );
									}
								?>
								
								<h2>&nbsp;</h2>
								<?php 
									echo $this->Form->create('Meeting');
									echo $this->Form->input('Meeting.sponsor',array('type'=>'hidden','value'=>$current_user['id']));
								?>
									<fieldset class="label_side">
										<label>Participants</label>
										<div>
											<?php 
											echo $this->Form->input('Meeting.invite', array(
													'type' => 'select',
													'multiple' => 'checkbox',
													'options' => $invites,
													'label'=>false,'div'=>false,
											));
										?>
										</div>
									</fieldset>
											
									<fieldset class="label_side">
										<label>Subject</label>
										<div>
											<?php 
												echo $this->Form->input('Meeting.name',array('type'=>'text', 'label'=>'','div'=>false));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Location</label>
										<div>
											<?php 
												echo $this->Form->input('Meeting.location',array('type'=>'text', 'label'=>'','div'=>false));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									
									<fieldset class="label_side">
										<label>Time</label>
										<div>
											<?php 
												echo $this->Form->input('Meeting.hold_on',array('label'=>'','div'=>false,'minYear'=>(date('Y')),'maxYear'=>(date('Y')+1)));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									
									<fieldset>
										<label>Summary</label>
										<div class="clearfix">
											<?php 
												echo $this->Form->input(
														'Meeting.agenda',
														array('label'=>'',
																'class'=>'tooltip autogrow',
																'title'=>"Auto Size Text Area",
																'placeholder'=>'Click to Input',
																'type'=>'textarea',
																'div'=>false));
											?>
										</div>
									</fieldset>
			
										<button class="green full_width">
											<div class="ui-icon ui-icon-carat-1-n"></div>
											<span>Confirm</span>
										</button>
								<?php echo $this->Form->end();?>
							</div>
						</div>
		</div>