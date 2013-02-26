		<div class="flat_area grid_16">
			<h2>为用户组添加新组员</h2>
		</div>
		
		<div class="box grid_16 tabs">
						<div id="tabs-1" class="block">
							<div class="box grid_16">
								<?php 
									if (isset($msg_type)) {
										echo $this->Msg->output( $msg_type,$this->Session->flash() );
									}
								?>
								<p>&nbsp;</p>
								<h2>用户组名称：<?php echo $data['Group']['name']; ?>；负责人：<?php echo $data['Leader']['name']; ?></h2>
								<?php 
									if (!empty($data['GroupUser']) ) {
										?>
										<p>当前组员包括：
											<?php 
												foreach ($data['GroupUser'] as $value) {
													echo $value['User']['name'],'、';
												}
											?>
											等共<?php echo count($data['GroupUser']); ?>人
										</p>
										<?php
									}else{
										echo '<p>该组还没有任何成员。</p>';
									}
								?>
								
								<?php 
									echo $this->Form->create('GourpUser');
									echo $this->Form->input('GroupUser.group_id',array('type'=>'hidden','value'=>$data['Group']['id'])); 
								?>
										<fieldset class="label_side">
											<label>选择组员</label>
											<div class="uniform inline clearfix">
												<?php 
													foreach($sales_assistants as $key=>$value){
														echo '<label>',$this->Form->checkbox('GroupUser.user_id.'.$key, array('value' => 1)),$value,'</label>';
													}
												?>
											</div>
										</fieldset>
										<button class="green">
											<div class="ui-icon ui-icon-carat-1-n"></div>
											<span>添加选中的组员</span>
										</button>
								<?php echo $this->Form->end();?>
							</div>
						</div>
		</div>