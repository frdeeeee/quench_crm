<table class="static"> 
					<thead> 
						<tr> 
							<th>
								<?php 
								echo $this->Form->checkbox('select_all');//js会响应它的事件
								?>
							</th>
							<th>合同编号</th>
							<th>姓名</th>
							<th>学校</th>
							<th>当前阶段</th>
							<th>机构</th> 
							<th>资料准备</th> 
							<th>160表</th>
							<th>签证日期</th> 
							<th>签证使馆</th> 
							<th>签培日期</th> 
							<th>签培方式</th>
							<th>签证结果</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							$applicant_files_status = array(0=>'缺材料',1=>'已完成');
							foreach ($data as $value) {
								echo '<tr><td>',
									$this->Form->checkbox('select_item_'.$value['Enquiry']['id'],
										array('class'=>'select_itmes',
											'title'=>$value['Enquiry']['mobile'],
											'style'=>'height:11px;line-height:0px;margin:0px;')),
									'</td>';
								echo '<td>',$value['Enquiry']['contract_id'],'</td>';
								echo '<td id="e_name'.$value['Enquiry']['id'].'">',$value['Enquiry']['name'],'</td>';
								echo '<td>',$value['Enquiry']['school'],'</td>';
								echo '<td>',$value['Phase']['name'],($value['Applicant']['status']==WAS_CANCELED)?'(<b style="color:red">退出</b>)':'','</td>';
								echo '<td>CHI</td>';
								
								//已提交的签证资料列表
								/*
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
								*/
								echo '<td>',$applicant_files_status[$value['Applicant']['visa_data']],'</td>';
								//d160添加jquery的editable支持
								if (empty($value['ApplicantVisa']['id'])) {
									echo '<td></td>';
								}else{
									if ($value['Phase']['id']==PHASE_VISA) {
										//只有处于签证阶段的学生的ds160数据才可以改
										echo '<td><div class="d160_trigger" id="',$value['ApplicantVisa']['id'],'">',
										($value['ApplicantVisa']['form160']==0)?'未做好':'已做好','</div>',
										$this->Html->image('ajax_refresh.gif',array('style'=>'display:none;','id'=>'icon_ajax_refresh'.$value['ApplicantVisa']['id'])),
										'</td>';
									}else{
										echo '<td>',($value['ApplicantVisa']['form160']==0)?'未做好':'已做好','</td>';
									}
								}
								
								echo '<td>',($value['ApplicantVisa']['visa_appointment_date'])?$value['ApplicantVisa']['visa_appointment_date']:'<b style="color:red">未定</b>','</td>';
								//根据embassy_address的情况来选择如何显示签证使馆的信息
								if (empty($value['ApplicantVisa']['embassy_address'])) {
									if (empty($value['ApplicantVisa']['embassy_id'] )) {
										echo '<td>未定</td>';
									}else{
										echo '<td>',$embassys[$value['ApplicantVisa']['embassy_id']],'</td>';
									}
								}else{
									echo '<td>',$value['ApplicantVisa']['embassy_address'],'</td>';
								}
								
								echo '<td>',($value['ApplicantVisa']['visa_traing_date'])?$value['ApplicantVisa']['visa_traing_date']:'<b style="color:red">未定</b>','</td>';
								if (!empty($value['ApplicantVisa']['training_method_id'])) {
									echo '<td>',$training_methods[$value['ApplicantVisa']['training_method_id']],'</td>';
								}else{
									echo '<td><b style="color:red">未定</b></td>';
								}
								echo '<td>',$value['VisaStatus']['name'],'</td>';
								echo '<td style="display:none"><div id="email_addr_'.$value['Enquiry']['id'].'">',$value['Enquiry']['email'],'</div></td>';
								echo '<td style="display:none"><div id="mobile_nb_'.$value['Enquiry']['id'].'">',$value['Enquiry']['mobile'],'</div></td>';//给手机号一个特定的id，便于发短信的时候提取用
								echo '<td><div class="action_trigger" name="'.$value['Enquiry']['id'].'">更多操作</div></td></tr>';
							}
						?>
					</tbody>
				</table>