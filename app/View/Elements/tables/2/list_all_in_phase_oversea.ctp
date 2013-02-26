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
							
							<th>阶段</th>
							<th>机构</th> 
							<th>激活状态</th> 
							<th>雇主</th> 
							<th>所在地</th>
							<th>寄宿家庭</th> 
							<th>工作职位</th>
							<th>Check-in状态</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
						//pr($data);	
							$profile_status = array(0=>'等待审核',1=>'已通过');
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
								
								echo '<td>',$value['Phase']['name'],'</td>';
								echo '<td>',$value['Orgnization']['name'],'</td>';
								if (strlen($value['Profile']['status'])>0) {
									if ($value['Profile']['status']==0) {
										echo '<td>等待审核</td>';
									}else{
										echo '<td>已通过</td>';
									}
								}else{
									echo '<td>等待提交</td>';
								}
								
								echo '<td>',$value['ApplicantJob']['company_name'],'</td>';
								if (strlen($value['ApplicantJob']['city_name'])) {
									echo '<td>',$value['ApplicantJob']['city_name'],
									', ',$states[$value['ApplicantJob']['state_id']],', USA</td>';
								}else{
									echo '<td>未知</td>';
								}
								
								echo '<td>',$value['ApplicantJob']['hf_family_name'],'</td>';
								
								echo '<td>',$value['ApplicantJob']['job_title'],'</td>';
								if (isset($value['Checkin'])) {
									$now = time();
									$last_time = strtotime($value['Checkin']['latest_create']);
									$interval = 30-round(($now-$last_time)/(1000*60*60*24),0);
									if($interval<0){
										echo '<td>逾期未提交</td>';
									}else{
										echo '<td>正常，还有',$interval,'天</td>';
									}
								}else{
									echo '<td>还没有过Check_in</td>';
								}
								echo '<td style="display:none"><div id="email_addr_'.$value['Enquiry']['id'].'">',$value['Enquiry']['email'],'</div></td>';
								echo '<td style="display:none"><div id="mobile_nb_'.$value['Enquiry']['id'].'">',$value['Enquiry']['mobile'],'</div></td>';
								echo '<td><div class="action_trigger" name="'.$value['Enquiry']['id'].'">更多操作</div></td></tr>';
							}
						?>
					</tbody>
				</table>