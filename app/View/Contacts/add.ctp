		<div class="flat_area grid_16">
			<h2>增加新的客户联系人的资料</h2>
		</div>
		
		<div class="box grid_16 tabs">
						<div id="tabs-1" class="block">
							<div class="box grid_16">
								<h2>&nbsp;</h2>
								<?php 
									echo $this->Form->create('Contact');
									if (isset($current_customer)) {
										echo $this->Form->input('Contact.customer_id',array('type'=>'hidden','value'=>$current_customer['Customer']['id']));
										echo '<h2 style="text-align:center">联系人工作单位：',$current_customer['Customer']['name'],'</h2>';
									}else if(isset($customers)){
										?>
										<fieldset class="label_side">
											<label>客户单位名称</label>
											<div>
												<?php 
													echo $this->Form->input('Contact.customer_id',array('options'=>$customers,'label'=>'','class'=>'select_box full_width','empty'=>'请选择所在联系人工作单位'));
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
												echo $this->Form->input('Contact.name',array('label'=>'','div'=>false));
											?>
											<div class="required_tag tooltip hover left" title="必填项目"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>工作部门</label>
										<div>
											<?php 
												echo $this->Form->input('Contact.department',array('label'=>'','div'=>false));
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>上级领导</label>
										<div>
											<?php 
												echo $this->Form->input('Contact.manager',array('label'=>'','div'=>false));
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>联系手机</label>
										<div>
											<?php 
												echo $this->Form->input('Contact.mobile',array('label'=>'','div'=>false));
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>办公室电话</label>
										<div>
											<?php 
												echo $this->Form->input('Contact.office',array('label'=>'','div'=>false));
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>电子邮件</label>
										<div>
											<?php 
												echo $this->Form->input('Contact.email',array('label'=>'','div'=>false));
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>传真</label>
										<div>
											<?php 
												echo $this->Form->input('Contact.fax',array('label'=>'','div'=>false));
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