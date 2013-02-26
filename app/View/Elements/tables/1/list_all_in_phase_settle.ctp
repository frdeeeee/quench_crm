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
							<th>负责老师</th>
							<th>学校</th>
							<th>当前阶段</th>
							<th>机构名称</th>
							<th>参加JF/雇主面试/自主申请</th>
							<th>JF下发日期</th>
							<th>JF状态</th>
							<th>雇主</th>
							<th>雇主所在地</th> 
							<th>工作职位</th>
							<th>住宿</th>
							<th>工作期</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
						$job_offer_status_option = array(0=>'未上传',1=>'已上传外方机构');	
						foreach ($data as $value) {
							//pr($value['ApplicantJob']);	
							echo '<tr><td>',
									$this->Form->checkbox('select_item_'.$value['Enquiry']['id'],
										array('class'=>'select_itmes',
											'title'=>$value['Enquiry']['mobile'],
											'style'=>'height:11px;line-height:0px;margin:0px;')),
									'</td>';
								echo '<td>',$value['Enquiry']['contract_id'],'</td>';
								echo '<td id="e_name'.$value['Enquiry']['id'].'">',$value['Enquiry']['name'],'</td>';
								echo '<td>',$value['User']['name'],'</td>';
								echo '<td>',$value['Enquiry']['school'],'</td>';
								echo '<td>',$value['Phase']['name'],($value['Applicant']['status']==WAS_CANCELED)?'(<b style="color:red">退出</b>)':'','</td>';
								echo '<td>',($value['Orgnization']['name'])?$value['Orgnization']['name']:'<b style="color:red">无</b>','</td>';
								if (isset($value['ApplicantJob']['interview'])) {
									echo '<td>',($value['ApplicantJob']['interview']==1)?'是':'否','</td>';
								}else{
									echo '<td>无状态</td>';
								}
								if (count($value['ApplicantFile'])==0) {
									echo '<td>尚未下发</td>';
								}else{
									echo '<td>',$value['ApplicantFile'][0]['created'],'</td>';
								}
								echo '<td>',$job_offer_status_option[$value['Applicant']['job_offer_upload_oversea_status']],'</td>';
								
								echo '<td>',$value['ApplicantJob']['company_name'],'</td>';
								if (isset($value['ApplicantJob']['State']['name'])) {
									echo '<td>',$value['ApplicantJob']['city_name'],
									', ',$value['ApplicantJob']['State']['name'],', USA</td>';
								}else{
									echo '<td>无状态</td>';
								}
								
								echo '<td>',$value['ApplicantJob']['job_title'],'</td>';
								
									echo '<td>',($value['ApplicantJob']['provide_accom']==1)?'雇主提供':'雇主不提供','</td>';
								
								echo '<td>',$value['ApplicantJob']['start_from'],'至',$value['ApplicantJob']['end_by'],'</td>';
								echo '<td style="display:none"><div id="email_addr_'.$value['Enquiry']['id'].'">',$value['Enquiry']['email'],'</div></td>';
								echo '<td style="display:none"><div id="mobile_nb_'.$value['Enquiry']['id'].'">',$value['Enquiry']['mobile'],'</div></td>';//给手机号一个特定的id，便于发短信的时候提取用
								echo '<td><div class="action_trigger" name="'.$value['Enquiry']['id'].'">更多操作</div></td></tr>';
							}
						?>
					</tbody>
				</table>