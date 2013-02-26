		<div class="flat_area grid_16">
			<h2>修改客户资料</h2>
			<?php 
			if (isset($msg_type)) {
				echo $this->Msg->output( $msg_type,$this->Session->flash() );
			}
		?>
		</div>
		
		<div class="box grid_16 tabs">
						<div id="tabs-1" class="block">
							<div class="box grid_16">
								<h2>&nbsp;</h2>
								<?php 
									echo $this->Form->create('Customer');
									echo $this->Form->input('Customer.id',array('type'=>'hidden','value'=>$data['Customer']['id']));
								?>
									<fieldset class="label_side">
										<label>对方单位名称</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.name',array('label'=>'','div'=>false,'value'=>$data['Customer']['name']));
											?>
											<div class="required_tag tooltip hover left" title="必填项目"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>是否共享</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.is_shared',array('options'=>array(1=>'共享',0=>'不共享'),'label'=>'','class'=>'select_box full_width','default'=>$data['Customer']['is_shared']));
											?>
											<div class="required_tag tooltip hover left" title="必填项目"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>所在省份</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.province_id',array('options'=>$provinces,'label'=>'','class'=>'select_box full_width','default'=>$data['Customer']['province_id']));
											?>
											<div class="required_tag tooltip hover left" title="必填项目"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>所在城市</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.city',array('label'=>'','div'=>false,'type'=>'text','value'=>$data['Customer']['city']));
											?>
											<div class="required_tag tooltip hover left" title="必填项目"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>客户类别</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.customerType_id',array('options'=>$customer_types,'label'=>'','class'=>'select_box full_width','default'=>$data['Customer']['customerType_id']));
											?>
											<div class="required_tag tooltip hover left" title="必填项目"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>第一次返点金额</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.money_return_sum1',array('label'=>'','div'=>false,'type'=>'text','value'=>$data['Customer']['money_return_sum1']));
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>第二次返点金额</label>
										<div>
											<?php 
												echo $this->Form->input('Customer.money_return_sum2',array('label'=>'','div'=>false,'type'=>'text','value'=>$data['Customer']['money_return_sum2']));
											?>
										</div>
									</fieldset>
									</div>
									
									<fieldset>
										<label>客户的备注信息：<span>任何您认为有关的信息都可以输入</span></label>
										<div class="clearfix">
											<?php 
												echo $this->Form->input(
														'Customer.comments',
														array('label'=>'',
																'class'=>'tooltip autogrow',
																'title'=>"输入框会自动根据您的输入调整大小",
																'placeholder'=>'点击输入',
																'type'=>'textarea',
																'value'=>$data['Customer']['comments'],
																'div'=>false));
											?>
										</div>
									</fieldset>
									
			
										<button class="green full_width">
											<div class="ui-icon ui-icon-carat-1-n"></div>
											<span>确认修改</span>
										</button>
								<?php echo $this->Form->end();?>
							</div>
		</div>