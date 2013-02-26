		<div class="flat_area grid_16">
			<h2>Add New Contact</h2>
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
									echo $this->Form->create('Customer');
									echo $this->Form->input('Customer.user_id',array('type'=>'hidden','value'=>$current_user['id']));
									echo $this->Form->input('Customer.group_id',array('type'=>'hidden','value'=>$this->Session->read('my_group')));
								?>
									<fieldset class="label_side">
										<label>Company Name</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.name',array('label'=>'','div'=>false));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Is Shared</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.is_shared',array('options'=>array(1=>'Share',0=>'Private'),'label'=>'','class'=>'select_box full_width'));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>States</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.province_id',array('options'=>$provinces,'label'=>'','class'=>'select_box full_width','empty'=>'Choose state ...'));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>City</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.city',array('label'=>'','div'=>false,'type'=>'text'));
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Type</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.customerType_id',array('options'=>$customer_types,'label'=>'','class'=>'select_box full_width','empty'=>'Choose type...'));
											?>
											<div class="required_tag tooltip hover left" title="Required"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Contract Value</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.money_return_sum1',array('label'=>'','div'=>false,'type'=>'text','value'=>0));
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Service Rate</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.money_return_sum2',array('label'=>'','div'=>false,'type'=>'text','value'=>0));
											?>
										</div>
									</fieldset>
									</div>
									
									<fieldset>
										<label>Comments：<span>Any thing you think useful</span></label>
										<div class="clearfix">
											<?php 
												echo $this->Form->input(
														'Customer.comments',
														array('label'=>'',
																'class'=>'tooltip autogrow',
																'title'=>"Auto sized area",
																'placeholder'=>'Click to input',
																'type'=>'textarea',
																'div'=>false));
											?>
										</div>
									</fieldset>
									
			
										<button class="green full_width">
											<div class="ui-icon ui-icon-carat-1-n"></div>
											<span>Submit</span>
										</button>
								<?php echo $this->Form->end();?>
							</div>
		</div>