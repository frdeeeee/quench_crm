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
							<th>签证页</th> 
							<th>行前培训日期</th>
							<th>行前培训方式</th>
							<th>已通过文档</th> 
							<th>未通过文档</th>
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
								echo '<td>',$value['Enquiry']['contract_id'],'</td>';
								echo '<td id="e_name'.$value['Enquiry']['id'].'">',$value['Enquiry']['name'],'</td>';
								echo '<td>',$value['Enquiry']['school'],'</td>';
								
								echo '<td>',$value['Phase']['name'],($value['Applicant']['status']==WAS_CANCELED)?'(<b style="color:red">退出</b>)':'','</td>';
								echo '<td>',$value['Orgnization']['name'],'</td>';
								echo '<td></td>';
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
								echo '<td style="display:none"><div id="email_addr_'.$value['Enquiry']['id'].'">',$value['Enquiry']['email'],'</div></td>';
								echo '<td style="display:none"><div id="mobile_nb_'.$value['Enquiry']['id'].'">',$value['Enquiry']['mobile'],'</div></td>';//给手机号一个特定的id，便于发短信的时候提取用
								echo '<td><div class="action_trigger" name="'.$value['Enquiry']['id'].'">更多操作</div></td></tr>';
							}
						?>
					</tbody>
				</table>