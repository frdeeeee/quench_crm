<div class="flat_area grid_16">
	<h2>申请阶段用户列表</h2>
</div>
<?php 
	echo $this->element('search_forms/search_form');
	echo $this->element('general/operation_shortcuts');
 ?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">销售记录</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">					
			<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
				//pr($data);
			?>
			<div class="block">
				<table class="static"> 
					<thead> 
						<tr> 
							<th>
								<?php 
								echo $this->Form->checkbox('select_all');//js会响应它的事件
								?>
							</th>
							<th>姓名</th>
							<th>学校</th> 
							<th>电子邮件</th> 
							<th>联系电话</th> 
							<th>SLEP</th> 
							<th>报名费</th> 
							<th>项目费</th> 
							<th>协议</th> 
							<th>申请资料</th> 
							<th>项目资料</th>
							<th>签证资料</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							foreach ($data as $value) {
								echo '<tr><td>',
									$this->Form->checkbox('select_item_'.$value['Enquiry']['id'],
										array('class'=>'select_itmes',
											'title'=>$value['Enquiry']['mobile'],
											'style'=>'height:11px;line-height:0px;margin:0px;')),
									'</td>';
								echo '<td>',$value['Enquiry']['name'],'</td>';
								echo '<td>',$value['Enquiry']['school'],'</td>';
								echo '<td>',$value['Enquiry']['email'],'</td>';
								echo '<td>',$value['Enquiry']['mobile'],'</td>';
								echo '<td>',($value['Applicant']['slep'])?$value['Applicant']['slep']:'<b style="color:red">无</b>','</td>';
								echo '<td>',($value['Applicant']['apply_fee'])?$value['Applicant']['apply_fee']:'<b style="color:red">未缴</b>','</td>';
								echo '<td>',($value['Applicant']['project_fee'])?$value['Applicant']['project_fee']:'<b style="color:red">未缴</b>','</td>';
								echo '<td>',($value['Applicant']['sign_date'])?$value['Applicant']['sign_date']:'<b style="color:red">无</b>','</td>';
								echo '<td>',($value['Applicant']['application_data'])?$value['Applicant']['application_data']:'<b style="color:red">无</b>','</td>';
								echo '<td>',($value['Applicant']['project_data'])?$value['Applicant']['project_data']:'<b style="color:red">无</b>','</td>';
								echo '<td>',($value['Applicant']['visa_data'])?$value['Applicant']['visa_data']:'<b style="color:red">无</b>','</td>';
								echo '<td><div class="action_trigger" name="'.$value['Applicant']['id'].'">更多操作</div></td></tr>';
							}
						?>
					</tbody>
				</table>
				<?php 
					echo $this->element('pagination_bar');
				?>
		</div>
	</div>
</div>
<?php 
	/*
	foreach ($data as $value) {
			echo $this->ActionsBox->output(
				$value['Applicant']['id'],
				array('修改数据','发送手机短信'),
				array('Applicants','ShortMessages'),
				array('modify','send')
			);
	}
	*/
	if ($current_user['role_id'] != SALES && $current_user['role_id'] != SALES_ASSISTANT) {
		foreach ($data as $value) {
			echo $this->ActionsBox->output_fancybox(
					$value['Applicant']['id'],
					array('数据管理','发送手机短信','转为签证阶段','因故取消'),
					array('','fancy_trigger_group','',''),
					array(
						'/Applicants/modify/'.$value['Applicant']['id'],
						'#send_sms_form',
						'/Applicants/phase_visa_confirmed/'.$value['Applicant']['id'], //发送短信的功能是通过fancybox来实现的
						'/Applicants/cancel/'.$value['Applicant']['id']
					)
			);
		}
	}
?>
<div style="display:none">
	<div id="send_sms_form" style="width:700px;height:315px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		向报名学生发送手机短信
		<?php echo $this->Html->image('ajax_refresh.gif',array('style'=>'margin-top:-15px;float:right;display:none;','id'=>'icon_sms_sending_refresh')); ?>&nbsp;
		</h2>
		<?php 
			echo $this->Form->create();
		?>
		<fieldset class="label_side">
			<label>收信人</label>
				<div>
					<?php 
						echo $this->Form->input('Sms.receiver_id',array('label'=>'','div'=>false,'type'=>'text','disabled'=>'disabled'));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>内容：</label>
				<div>
					<?php 
						echo $this->Form->input('Sms.content',array('label'=>false,'div'=>false,'type'=>'textarea'));
					?>
				</div>
		</fieldset>
		<div id="sms_send_btn" class="short_message_btn">
				立即发送
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>