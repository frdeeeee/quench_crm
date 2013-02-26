		<div class="flat_area grid_16">
			<h2>Modify <?php echo $data['User']['name']; ?>'s Profile</h2>
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
									echo $this->Form->create('User');
									echo $this->Form->input('User.id',array('type'=>'hidden','value'=>$data['User']['id']));
								?>
									<fieldset class="label_side">
										<label>Department</label>
										<div>
											<?php 
												echo $this->Form->input('User.department_id',array('options'=>$departments,'label'=>'','class'=>'select_box full_width','value'=>$data['User']['department_id']));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Role</label>
										<div>
											<?php 
												echo $this->Form->input('User.role_id',array('options'=>$roles,'label'=>'','class'=>'select_box full_width','value'=>$data['User']['role_id']));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Title</label>
										<div>
											<?php 
												echo $this->Form->input('User.title',array('label'=>'','div'=>false,'value'=>$data['User']['title']));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Name</label>
										<div>
											<?php 
												echo $this->Form->input('User.name',array('label'=>'','div'=>false,'value'=>$data['User']['name']));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Email ( Login Name )</label>
										<div>
											<?php 
												echo $this->Form->input('User.username',array('label'=>'','div'=>false,'value'=>$data['User']['username']));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
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