		<div class="flat_area grid_16">
			<h2>Project Profile: <?php echo $data['Project']['name']; ?></h2>
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
									echo $this->Form->create('Project');
									echo $this->Form->input('Project.id',array('type'=>'hidden','value'=>$data['Project']['id']));
								?>
									<fieldset class="label_side">
										<label>Name</label>
										<div>
											<?php 
												echo $this->Form->input('Project.name',array('label'=>'','div'=>false,'value'=>$data['Project']['name']));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Deadline</label>
										<div>
											<?php 
												echo $this->Form->input('Project.deadline_date',array('label'=>'','div'=>false,'type'=>'text','value'=>$data['Project']['deadline_date']));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset>
										<label>Description: <span>Anything related</span></label>
										<div class="clearfix">
											<?php 
												echo $this->Form->input(
														'Project.comments',
														array('label'=>'',
																'class'=>'tooltip autogrow',
																'title'=>"Auto size input area",
																'placeholder'=>'',
																'type'=>'textarea',
																'value'=>$data['Project']['comments'],
																'div'=>false));
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