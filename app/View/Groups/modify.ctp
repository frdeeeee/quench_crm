		<div class="flat_area grid_16">
			<h2>修改系统用户组信息</h2>
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
									echo $this->Form->create('Modify');
									echo $this->Form->input('Gourp.id',array('type'=>'hidden','value'=>$data['Group']['id']));
								?>
									<fieldset class="label_side">
										<label>用户组名称</label>
										<div>
											<?php 
												echo $this->Form->input('Group.name',array('label'=>'','div'=>false,'value'=>$data['Group']['name']));
											?>
											<div class="required_tag tooltip hover left" title="必填项目"></div>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>工作组负责人</label>
										<div>
											<?php 
												echo $this->Form->input('Group.group_leader',array('options'=>$leaders,'label'=>'','class'=>'select_box full_width','value'=>$data['Group']['group_leader']));
											?>
											<div class="required_tag tooltip hover left" title="必填项目"></div>
										</div>
									</fieldset>
			
										<button class="green full_width">
											<div class="ui-icon ui-icon-carat-1-n"></div>
											<span>修改</span>
										</button>
								<?php echo $this->Form->end();?>
							</div>
						</div>
		</div>