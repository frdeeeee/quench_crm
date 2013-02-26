		<div class="flat_area grid_16">
			<h2>Modify the announcement</h2>
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
									echo $this->Form->input('Announcement.id',array('type'=>'hidden','value'=>$data['Announcement']['id']));
								?>
								<?php 
									$audiences = array('Every one can see');
								?>
									<fieldset class="label_side">
										<label>To</label>
										<div>
											<?php 
												echo $this->Form->input('Announcement.audience',array('label'=>'','div'=>false,'options'=>$audiences,'value'=>$data['Announcement']['audience']));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Priority</label>
										<div>
											<?php 
												echo $this->Form->input('Announcement.important',array('label'=>'','div'=>false,'options'=>array('Important','Normal'),'value'=>$data['Announcement']['important']));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
											
									<fieldset class="label_side">
										<label>Subject</label>
										<div>
											<?php 
												echo $this->Form->input('Announcement.name',array('type'=>'text', 'label'=>'','div'=>false,'value'=>$data['Announcement']['name']));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									
									<fieldset class="label_side">
										<label>Available to</label>
										<div>
											<?php 
												echo $this->Form->input('Announcement.deadline',array('label'=>'','div'=>false,'minYear'=>(date('Y')),'maxYear'=>(date('Y')+1),'value'=>$data['Announcement']['deadline']));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									
									<fieldset>
										<label>公告内容</label>
										<div class="clearfix">
											<?php 
												echo $this->Form->input(
														'Announcement.content',
														array('label'=>'',
																'class'=>'tooltip autogrow',
																'title'=>"Auto size",
																'placeholder'=>'Click to input',
																'type'=>'textarea',
																'div'=>false,'value'=>$data['Announcement']['content']));
											?>
										</div>
									</fieldset>
			
										<button class="green full_width">
											<div class="ui-icon ui-icon-carat-1-n"></div>
											<span>Update</span>
										</button>
								<?php echo $this->Form->end();?>
							</div>
						</div>
		</div>