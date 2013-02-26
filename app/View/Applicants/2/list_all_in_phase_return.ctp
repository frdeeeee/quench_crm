<?php 
	echo $this->Html->script('ajax_utils/send_multi_sms_utils',false); 
	echo $this->Html->script('ajax_utils/send_emails_utils',false); 
?>
<div class="flat_area grid_16">
	<h2>回国阶段用户列表</h2>
</div>
<?php 
	echo $this->element('search_forms/search_form_return');
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
							<th>回国登记</th>
							<th>回国日期</th> 
							<th>项目情况</th>
							<th>已提交文件</th>
							<th>未提交文件</th>
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
								echo '<td id="e_name'.$value['Enquiry']['id'].'">',$value['Enquiry']['name'],'</td>';
								echo '<td>',$value['Enquiry']['school'],'</td>';
								echo '<td>',$value['Enquiry']['contract_id'],'</td>';
								echo '<td>',$value['Phase']['name'],'</td>';
								
								echo '<td>',$value['Orgnization']['name'],'</td>';
								echo '<td style="display:none"><div id="email_addr_'.$value['Enquiry']['id'].'">',$value['Enquiry']['email'],'</div></td>';
								echo '<td style="display:none"><div id="mobile_nb_'.$value['Enquiry']['id'].'">',$value['Enquiry']['mobile'],'</div></td>';//给手机号一个特定的id，便于发短信的时候提取用
								echo '<td>'.$value['ReturnStatus']['name'].'</td>';
								echo '<td>'.$value['Applicant']['return_date'].'</td>';
								echo '<td>'.$value['ProjectStatus']['name'].'</td>';
								//已提交的归国资料列表
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
								//未提交的归国资料列表
								if (count($total_file_needed)==0) {
									echo '<td>已全部提交</td>';
								}else{
									echo '<td>',$this->Form->input('temp',array('options'=>$total_file_needed,'label'=>FALSE,'div'=>FALSE)),'</td>';
								}
								
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
				echo $this->ActionsBox->output_fancybox(
						$value['Enquiry']['id'],
						array('数据管理','发送手机短信','发送电子邮件'),
						array('','fancy_trigger_group','fancy_email_trigger_group'),
						array(
							'/Applicants/modify/'.$value['Applicant']['id'].'/'.PHASE_OVERSEA,
							'#send_sms_form',
							'#send_email_form'
						)
				);
		}
	}
	echo $this->element('fancy_forms/applicant_cancel_form');
?>