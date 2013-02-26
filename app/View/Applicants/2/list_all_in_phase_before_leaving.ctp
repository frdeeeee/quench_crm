<?php 
	echo $this->Html->script('ajax_utils/send_multi_sms_utils',false); 
	echo $this->Html->script('ajax_utils/send_emails_utils',false); 
?>
<div class="flat_area grid_16">
	<h2>行前阶段用户列表</h2>
</div>
<?php 
	echo $this->element('search_forms/search_form_before_leaving');
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
							<th>合同编号</th>
							<th>当前阶段</th>  
							<th>机构</th> 
							<th>签证页</th> 
							<th>行前培训日期</th>
							<th>行前培训方式</th>
							<th>已提交文档</th> 
							<th>未提交文档</th>
							<th>行程是否提交外方</th>
									<th>接机是否安排</th> 
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
						//pr($data);
						foreach ($data as $value) {
								echo '<tr><td>',
									$this->Form->checkbox('select_item_'.$value['Enquiry']['id'],
										array('class'=>'select_itmes',
											'title'=>$value['Enquiry']['mobile'],
											'style'=>'height:11px;line-height:0px;margin:0px;')),
									'</td>';
								echo '<td id="e_name'.$value['Enquiry']['id'].'">',$value['Enquiry']['name'],'</td>';
								echo '<td>',$value['Enquiry']['school'],'</td>';
								echo '<td>',$value['Enquiry']['contract_id'],'</td>';
								echo '<td>',$value['Phase']['name'],'</td>';
								echo '<td>',$value['Orgnization']['name'],'</td>';
								echo '<td></td>';
								echo '<td style="display:none"><div id="email_addr_'.$value['Enquiry']['id'].'">',$value['Enquiry']['email'],'</div></td>';
								echo '<td style="display:none"><div id="mobile_nb_'.$value['Enquiry']['id'].'">',$value['Enquiry']['mobile'],'</div></td>';//给手机号一个特定的id，便于发短信的时候提取用
								echo '<td>',($value['ApplicantVisa']['last_training_date'])?$value['ApplicantVisa']['last_training_date']:'<b style="color:red">未定</b>','</td>';
								if (isset($value['ApplicantVisa']['TrainingMethod'])) {
									echo '<td>',$value['ApplicantVisa']['TrainingMethod']['name'],'</td>';
								}else{
									echo '<td><b style="color:red">未定</b></td>';
								}
								
								//已提交的行前资料列表
								$temp = array();
								for ($i = 0; $i < count($value['ApplicantFile']); $i++) {
									$txt = $total_file_needed[$value['ApplicantFile'][$i]['download_file_id']];
									if ($value['ApplicantFile'][$i]['is_passed']==1){
										$txt .= ' ->已通过';
									}else{
										if ($value['ApplicantFile'][$i]['is_readed']==1) {
											$txt .= ' ->已审核';
										}else{
											$txt .= ' ->未审核';
										}
									}
									$temp[]=$txt;
									unset($total_file_needed[$value['ApplicantFile'][$i]['download_file_id']]);
								}
								echo '<td>',$this->Form->input('temp',array('options'=>$temp,'label'=>FALSE,'div'=>FALSE)),'</td>';
								if (count($total_file_needed)==0) {
									echo '<td>已全部提交</td>';
								}else{
									echo '<td>',$this->Form->input('temp',array('options'=>$total_file_needed,'label'=>FALSE,'div'=>FALSE)),'</td>';
								}
									
								echo '<td>',(($value['Applicant']['usa_informed'] != USA_INFORMED)?'<b style="color:red">否</b>':'是'),'</td>';
									echo '<td>',(($value['ApplicantItinerary']['usa_airport_pick_up'] == 0)?'<b style="color:red">等待</b>':'已安排'),'</td>';
								echo '<td><div class="action_trigger" name="'.$value['Enquiry']['id'].'">更多操作</div></td></tr>';
							}
						?>
					</tbody>
				</table>
				<?php 
					if(!isset($no_pagi)){
						echo $this->element('pagination_bar');
					}
				?>
		</div>
	</div>
</div>
<?php 
	if ($current_user['role_id'] != SALES && $current_user['role_id'] != SALES_ASSISTANT) {
		foreach ($data as $value) {
			if ($value['Phase']['id']==PHASE_BEFORE_LEAVING && $value['Applicant']['usa_informed']==USA_INFORMED) {
				echo $this->ActionsBox->output_fancybox(
					$value['Enquiry']['id'],
					array('数据管理','发送手机短信','发送电子邮件','转为赴美阶段','因故取消'),
					array('','fancy_trigger_group','fancy_email_trigger_group','','fancy_app_cancel_group'),
					array(
						'/Applicants/modify/'.$value['Applicant']['id'].'/'.PHASE_BEFORE_LEAVING,
						'#send_sms_form',
						'#send_email_form',
						'/Applicants/phase_oversea_confirmed/'.$value['Applicant']['id'], //发送短信的功能是通过fancybox来实现的
						'#applicant_cancel_form'
					)
				);
			}else{
				echo $this->ActionsBox->output_fancybox(
					$value['Enquiry']['id'],
					array('数据管理','发送手机短信','发送电子邮件'),
					array('','fancy_trigger_group','fancy_email_trigger_group'),
					array(
						'/Applicants/modify/'.$value['Applicant']['id'].'/'.PHASE_BEFORE_LEAVING,
						'#send_sms_form',
						'#send_email_form'
					),
					array(
						NULL,NULL,NULL
					)
				);
			}
		}
	}

?>