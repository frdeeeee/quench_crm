		<div class="flat_area grid_16">
			<h2>New Announcement</h2>
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
									echo $this->Form->create('Announcement');
								?>
								<?php 
									$audiences = array('Anyone can see');
								?>
									<fieldset class="label_side">
										<label>To</label>
										<div>
											<?php 
												echo $this->Form->input('Announcement.audience',array('label'=>'','div'=>false,'options'=>$audiences));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Priority</label>
										<div>
											<?php 
												echo $this->Form->input('Announcement.important',array('label'=>'','div'=>false,'options'=>array('Important','Normal')));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
											
									<fieldset class="label_side">
										<label>Title</label>
										<div>
											<?php 
												echo $this->Form->input('Announcement.name',array('type'=>'text', 'label'=>'','div'=>false));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									
									<fieldset class="label_side">
										<label>Available to date</label>
										<div>
											<?php 
												echo $this->Form->input('Announcement.deadline',array('label'=>'','div'=>false,'minYear'=>(date('Y')),'maxYear'=>(date('Y')+1)));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									
									<fieldset>
										<label>Content</label>
										<div class="clearfix">
											<?php 
												echo $this->Form->input(
														'Announcement.content',
														array('label'=>'',
																'class'=>'tooltip autogrow',
																'title'=>"Auto size",
																'placeholder'=>'Click to input',
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