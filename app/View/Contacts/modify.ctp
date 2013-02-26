		<div class="flat_area grid_16">
			<h2>修改客户联系人的资料</h2>
		</div>
		
		<div class="box grid_16 tabs">
			<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
			?>
						<div class="block">
							<div class="box grid_16">
								<h2>&nbsp;</h2>
								<?php 
									echo $this->Form->create('Contact');
									echo $this->Form->input('Contact.id',array('type'=>'hidden','value'=>$data['Contact']['id']));
									if(isset($customers)){
										?>
										<fieldset class="label_side">
											<label>客户单位名称</label>
											<div>
												<?php 
													echo $this->Form->input('Contact.customer_id',array('options'=>$customers,'label'=>'','value'=>$data['Contact']['customer_id'],
													'class'=>'select_box full_width','empty'=>'请选择所在联系人工作单位'));
												?>
												<div class="required_tag tooltip hover left" title="必填项目"></div>
											</div>
										</fieldset>
										<?php
									}
								?>
									
									<fieldset class="label_side">
										<label>联系人姓名</label>
										<div>
											<?php 
												echo $this->Form->input('Contact.name',array('label'=>'','div'=>false,'value'=>$data['Contact']['name']));
											?>
											<div class="required_tag tooltip hover left" title="必填项目"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>工作部门</label>
										<div>
											<?php 
												echo $this->Form->input('Contact.department',array('label'=>'','div'=>false,'value'=>$data['Contact']['department']));
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>上级领导</label>
										<div>
											<?php 
												echo $this->Form->input('Contact.manager',array('label'=>'','div'=>false,'value'=>$data['Contact']['manager']));
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>联系手机</label>
										<div>
											<?php 
												echo $this->Form->input('Contact.mobile',array('label'=>'','div'=>false,'value'=>$data['Contact']['mobile']));
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>办公室电话</label>
										<div>
											<?php 
												echo $this->Form->input('Contact.office',array('label'=>'','div'=>false,'value'=>$data['Contact']['office']));
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>电子邮件</label>
										<div>
											<?php 
												echo $this->Form->input('Contact.email',array('label'=>'','div'=>false,'value'=>$data['Contact']['email']));
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>传真</label>
										<div>
											<?php 
												echo $this->Form->input('Contact.fax',array('label'=>'','div'=>false,'value'=>$data['Contact']['fax']));
											?>
										</div>
									</fieldset>
			
										<button class="green full_width">
											<div class="ui-icon ui-icon-carat-1-n"></div>
											<span>提交</span>
										</button>
								<?php echo $this->Form->end();?>
							</div>
						</div>
		</div>