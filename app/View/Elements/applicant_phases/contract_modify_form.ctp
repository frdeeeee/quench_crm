<?php 
	echo $this->Form->input('Enquiry.id',array('type'=>'hidden','value'=>$data['Enquiry']['id']));//这个是必须有的，为了运营专门修改合同信息用的
?>
			<h3 class="section">报名费相关信息</h3>
			 <div class="columns clearfix" id="app_contract_form">
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.apply_fee',
									array('value'=>(isset($data['Enquiry']['apply_fee']))?$data['Enquiry']['apply_fee']:'',
									'label'=>'报名费：','id'=>'apply_fee','onkeyup'=>'this.value=this.value.replace(/[^\d\.]/g,\'\')')
							);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.apply_fee_receipt',
									array('value'=>(isset($data['Enquiry']['apply_fee_receipt']))?$data['Enquiry']['apply_fee_receipt']:'',
									'label'=>'报名费收据编号：','id'=>'apply_fee_receipt')
							);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'Enquiry.apply_fee_type',
								array('value'=>(isset($data['Enquiry']['apply_fee_type']))?$data['Enquiry']['apply_fee_type']:'',
								'label'=>'报名费缴费方式：','id'=>'apply_fee_type','options'=>$fee_types,'empty'=>'请选择缴费方式')
							);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.apply_fee_received',
									array(
										'default'=>(isset($data['Enquiry']['apply_fee_received']))?$data['Enquiry']['apply_fee_received']:'',
										'label'=>'报名费缴费日期：','before'=>'<div class="cake_input_date" name="apply_fee_received">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE
							));
							?>
						</div>
					</div>
			  </div>
			  <div class="columns clearfix">
			  		<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.apply_fee_payer',
									array('value'=>(isset($data['Enquiry']['apply_fee_payer']))?$data['Enquiry']['apply_fee_payer']:'',
									'label'=>'报名费缴款人：','id'=>'apply_fee_payer')
							);
							?>
						</div>
					</div>
			  		<div class="col_50">
				  		<div class="section">
				  			<?php 
				  			echo $this->Form->input(
									'Enquiry.apply_fee_comment',
									array('value'=>(isset($data['Enquiry']['apply_fee_comment']))?$data['Enquiry']['apply_fee_comment']:'',
									'label'=>'报名费备注：','id'=>'apply_fee_comment','size'=>80)
							);
				  			?>
				  		</div>
			  		</div>
			  		<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'Enquiry.apply_fee_status_id',
								array('value'=>(isset($data['Enquiry']['apply_fee_status_id']))?$data['Enquiry']['apply_fee_status_id']:'',
								'label'=>'报名费状态：','id'=>'apply_fee_status_id','options'=>$apply_fee_status,'empty'=>'请选择..')
							);
							?>
						</div>
					</div>
			  </div>
			  <?php if ($data['Enquiry']['project_id']==PROJECT_SWT) {//swt项目的项目费部分
			  	?>
			  <h3 class="section">项目费相关信息</h3>
			  <div class="columns clearfix">
					<div class="col_25">
						<div class="section">
							<?php 
								echo $this->Form->input(
									'Enquiry.project_fee',
									array('value'=>(isset($data['Enquiry']['project_fee']))?$data['Enquiry']['project_fee']:'',
									'label'=>'项目费：','id'=>'project_fee','onkeyup'=>'this.value=this.value.replace(/[^\d\.]/g,\'\')')
								);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.project_fee_receipt',
									array('value'=>(isset($data['Enquiry']['project_fee_receipt']))?$data['Enquiry']['project_fee_receipt']:'',
									'label'=>'项目费收据编号：','id'=>'project_fee_receipt')
								);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'Enquiry.project_fee_type',
								array('value'=>(isset($data['Enquiry']['project_fee_type']))?$data['Enquiry']['project_fee_type']:'',
								'label'=>'项目费缴费方式：','id'=>'project_fee_type','options'=>$fee_types,'empty'=>'请选择缴费方式')
							);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.project_fee_received',
									array(
										'default'=>(isset($data['Enquiry']['project_fee_received']))?$data['Enquiry']['project_fee_received']:'',
										'label'=>'项目费缴费日期：','before'=>'<div class="cake_input_date" name="project_fee_received">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE
							));
							?>
						</div>
					</div>
			  </div>
			  <div class="columns clearfix">
			  		<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.project_fee_payer',
									array('value'=>(isset($data['Enquiry']['project_fee_payer']))?$data['Enquiry']['project_fee_payer']:'',
									'label'=>'项目费缴款人：','id'=>'project_fee_payer')
								);
							?>
						</div>
					</div>
			  		<div class="col_50">
				  		<div class="section">
				  			<?php 
				  			echo $this->Form->input(
									'Enquiry.project_fee_comment',
									array('value'=>(isset($data['Enquiry']['project_fee_comment']))?$data['Enquiry']['project_fee_comment']:'',
									'label'=>'项目费备注：','id'=>'project_fee_comment','size'=>50)
								);
				  			?>
				  		</div>
			  		</div>
			  		<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'Enquiry.project_fee_status_id',
								array('value'=>(isset($data['Enquiry']['project_fee_status_id']))?$data['Enquiry']['project_fee_status_id']:'',
								'label'=>'项目费状态：','id'=>'project_fee_status_id','options'=>$project_fee_status,'empty'=>'请选择..')
							);
							?>
						</div>
					</div>
			  </div>
			  <?php
			  }?>
			  
			  <?php if ($data['Enquiry']['project_id']==PROJECT_STEP) {  //step项目的项目费部分
			  			$periods = array(1=>'一个月',2=>'两个月')
			  	?>
			  <h3 class="section">项目费相关信息</h3>
			  <div class="columns clearfix">
					<div class="col_25">
						<div class="section">
							<?php 
								echo $this->Form->input(
									'Enquiry.project_fee',
									array('value'=>(isset($data['Enquiry']['project_fee']))?$data['Enquiry']['project_fee']:'',
									'label'=>'项目费：','id'=>'project_fee','onkeyup'=>'this.value=this.value.replace(/[^\d\.]/g,\'\')')
								);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.project_fee_receipt',
									array('value'=>(isset($data['Enquiry']['project_fee_receipt']))?$data['Enquiry']['project_fee_receipt']:'',
									'label'=>'项目费收据编号：','id'=>'project_fee_receipt')
								);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'Enquiry.project_fee_type',
								array('value'=>(isset($data['Enquiry']['project_fee_type']))?$data['Enquiry']['project_fee_type']:'',
								'label'=>'项目费缴费方式：','id'=>'project_fee_type','options'=>$fee_types,'empty'=>'请选择缴费方式')
							);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.project_fee_received',
									array(
										'default'=>(isset($data['Enquiry']['project_fee_received']))?$data['Enquiry']['project_fee_received']:'',
										'label'=>'项目费缴费日期：','before'=>'<div class="cake_input_date" name="project_fee_received">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE
							));
							?>
						</div>
					</div>
			  </div>
			  <div class="columns clearfix">
			  		<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.project_fee_period',
									array('value'=>(isset($data['Enquiry']['project_fee_period']))?$data['Enquiry']['project_fee_period']:'',
									'label'=>'项目期限：','id'=>'project_fee_period','options'=>$periods)
								);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.project_fee_payer',
									array('value'=>(isset($data['Enquiry']['project_fee_payer']))?$data['Enquiry']['project_fee_payer']:'',
									'label'=>'项目费缴款人：','id'=>'project_fee_payer')
								);
							?>
						</div>
					</div>
					
			  		<div class="col_25">
				  		<div class="section">
				  			<?php 
				  			echo $this->Form->input(
									'Enquiry.project_fee_comment',
									array('value'=>(isset($data['Enquiry']['project_fee_comment']))?$data['Enquiry']['project_fee_comment']:'',
									'label'=>'项目费备注：','id'=>'project_fee_comment','size'=>25)
								);
				  			?>
				  		</div>
			  		</div>
			  		<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'Enquiry.project_fee_status_id',
								array('value'=>(isset($data['Enquiry']['project_fee_status_id']))?$data['Enquiry']['project_fee_status_id']:'',
								'label'=>'项目费状态：','id'=>'project_fee_status_id','options'=>$project_fee_status,'empty'=>'请选择..')
							);
							?>
						</div>
					</div>
			  </div>
			  <h3 class="section">住宿费相关信息</h3>
			  <div class="columns clearfix">
					<div class="col_25">
						<div class="section">
							<?php 
								echo $this->Form->input(
									'Enquiry.accom_fee',
									array('value'=>(isset($data['Enquiry']['accom_fee']))?$data['Enquiry']['accom_fee']:'',
									'label'=>'住宿费：','id'=>'accom_fee','onkeyup'=>'this.value=this.value.replace(/[^\d\.]/g,\'\')')
								);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.accom_receipt',
									array('value'=>(isset($data['Enquiry']['accom_receipt']))?$data['Enquiry']['accom_receipt']:'',
									'label'=>'住宿费收据编号：','id'=>'accom_receipt')
								);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'Enquiry.accom_fee_type',
								array('value'=>(isset($data['Enquiry']['accom_fee_type']))?$data['Enquiry']['accom_fee_type']:'',
								'label'=>'住宿费缴费方式：','id'=>'accom_fee_type','options'=>$fee_types,'empty'=>'请选择缴费方式')
							);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.accom_received',
									array(
										'default'=>(isset($data['Enquiry']['accom_received']))?$data['Enquiry']['accom_received']:'',
										'label'=>'住宿费缴费日期：','before'=>'<div class="cake_input_date" name="accom_received">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE
							));
							?>
						</div>
					</div>
			  </div>
			  <div class="columns clearfix">
			  		<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.accom_period',
									array('value'=>(isset($data['Enquiry']['accom_period']))?$data['Enquiry']['accom_period']:'',
									'label'=>'项目期限：','id'=>'accom_period','options'=>$periods)
								);
							?>
						</div>
					</div>
			  		<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.accom_fee_payer',
									array('value'=>(isset($data['Enquiry']['accom_fee_payer']))?$data['Enquiry']['accom_fee_payer']:'',
									'label'=>'住宿费缴款人：','id'=>'accom_fee_payer')
								);
							?>
						</div>
					</div>
					
			  		<div class="col_25">
				  		<div class="section">
				  			<?php 
				  			echo $this->Form->input(
									'Enquiry.accom_comment',
									array('value'=>(isset($data['Enquiry']['accom_comment']))?$data['Enquiry']['accom_comment']:'',
									'label'=>'住宿费备注：','id'=>'accom_comment','size'=>25)
								);
				  			?>
				  		</div>
			  		</div>
			  		<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'Enquiry.accom_fee_status_id',
								array('value'=>(isset($data['Enquiry']['accom_fee_status_id']))?$data['Enquiry']['accom_fee_status_id']:'',
								'label'=>'住宿费状态：','id'=>'accom_fee_status_id','options'=>$project_fee_status,'empty'=>'请选择..')
							);
							?>
						</div>
					</div>
			  </div>
			  
			  <?php
			  }?>
			  
			  <h3 class="section">退款相关信息</h3>
			  <div class="columns clearfix">
			  		<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.cancel_fee',
									array('value'=>(isset($data['Enquiry']['cancel_fee']))?$data['Enquiry']['cancel_fee']:'',
									'label'=>'退款金额：','id'=>'cancel_fee','type'=>'text')
								);
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.cancel_fee_receipt',
									array('value'=>(isset($data['Enquiry']['cancel_fee_receipt']))?$data['Enquiry']['cancel_fee_receipt']:'',
									'label'=>'退款收据编号：','id'=>'cancel_fee_receipt')
								);
							?>
						</div>
					</div>
			  		
			  		<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.cancel_fee_type',
									array('value'=>(isset($data['Enquiry']['cancel_fee_type']))?$data['Enquiry']['cancel_fee_type']:'',
									'label'=>'退款方式：','id'=>'accom_period','options'=>$fee_types)
								);
							?>
						</div>
					</div>
			  		<div class="col_25">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'Enquiry.cancel_fee_form_status',
								array('value'=>(isset($data['Enquiry']['cancel_fee_form_status']))?$data['Enquiry']['cancel_fee_form_status']:'',
								'label'=>'退款申请书是否签字提交：','id'=>'cancel_fee_form_status','options'=>array(0=>'否',1=>'是'),'empty'=>'请选择..')
							);
							?>
						</div>
					</div>
			  </div>
			  <div class="columns clearfix">
			  		<div class="col_50">
			  			<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.cancel_fee_date',
									array(
										'default'=>(isset($data['Enquiry']['cancel_fee_date']))?$data['Enquiry']['cancel_fee_date']:'',
										'label'=>'退款日期：','before'=>'<div class="cake_input_date" name="cancel_fee_date">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE
							));
							?>
						</div>
					</div>
			  		<div class="col_50">
				  		<div class="section">
				  			<?php 
				  			echo $this->Form->input(
									'Enquiry.cancel_fee_reason',
									array('value'=>(isset($data['Enquiry']['cancel_fee_reason']))?$data['Enquiry']['cancel_fee_reason']:'',
									'label'=>'退出原因：','id'=>'cancel_fee_reason')
								);
				  			?>
				  		</div>
			  		</div>
			  </div>
			  
			  <h3 class="section">合同签署相关信息</h3>
			  <div class="columns clearfix">
					<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.contract_id',
									array('value'=>(isset($data['Enquiry']['contract_id']))?$data['Enquiry']['contract_id']:'',
									'label'=>'协议编号：','id'=>'contract_id','type'=>'text')
								);
							?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
									'Enquiry.sign_date',
									array(
										'default'=>(isset($data['Enquiry']['sign_date']))?$data['Enquiry']['sign_date']:'',
										'label'=>'协议签署日期：','before'=>'<div class="cake_input_date" name="sign_date">','after'=>'</div>'
										,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1),'empty'=>TRUE
							));
							?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php 
							echo $this->Form->input(
								'Enquiry.contract_status_id',
								array('value'=>(isset($data['Enquiry']['contract_status_id']))?$data['Enquiry']['contract_status_id']:'',
								'label'=>'合同状态：','id'=>'contract_status_id','options'=>$contract_status,'empty'=>'请选择..')
							);
							?>
						</div>
					</div>
			  </div>
			  <div class="columns clearfix">
					<div class="col_66">
						<div class="section">
			  			<?php 
			  			echo $this->Form->input(
									'Enquiry.contract_comment',
									array('value'=>(isset($data['Enquiry']['contract_comment']))?$data['Enquiry']['contract_comment']:'',
									'label'=>'协议备注：','id'=>'contract_comment','size'=>70)
								);
			  			?>
						</div>
					</div>
					<div class="col_33">
							<div id="modify_contract_app_btn" class="short_message_btn">修改合同信息
							</div>
							<div id="save_contract_app_btn" class="short_message_btn">保存修改</div>
					</div>
			</div>
