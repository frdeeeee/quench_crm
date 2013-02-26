<?php //pr($data); ?>
<table class="static"> 
					<thead> 
						<tr> 
							<th>
								<?php 
								echo $this->Form->checkbox('select_all');//js会响应它的事件
								?>
							</th>
							<th>姓名</th>
							<th>负责员工</th>
							<th>阶段</th> 
							<th>学校</th> 
							<th>报名途径</th> 
							<th>考试日期</th>
							<th>考试成绩</th>
							<th>回访次数</th>
							<th>回访结果</th>
							<th>报名表</th>
							<th>报名费</th>
							<th>项目费</th>
							<?php 
								if ($this->Session->read('my_project')==PROJECT_STEP) {
									?>
									<th>住宿费</th>
									<?php
								}
							?>
							<th>签协议</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							foreach ($data as $value) {
								echo '<tr><td>',$this->Form->checkbox('select_item_'.$value['Enquiry']['id'],array('class'=>'select_itmes','title'=>$value['Enquiry']['mobile'],'style'=>'height:11px;line-height:0px;margin:0px;')),'</td>';
								echo '<td id="e_name'.$value['Enquiry']['id'].'">',$value['Enquiry']['name'],'</td>';
								if (empty($value['User'])) {
									echo '<td><b style="color:red">未分配</b></td>';
								}else {
									echo '<td>'.$value['User']['name'].'</td>';
								}
								
								echo '<td>报名</td>';
								echo '<td>',$value['Enquiry']['school'],'</td>';
								
								if ($value['Enquiry']['presentation_id']==OPERATION_OWNED_STUDENT || empty($value['Enquiry']['presentation_id'])) {
									echo '<td>自主报名</td>';;
								}else{
									echo '<td>',$value['Presentation']['hold_on'],',',$value['Presentation']['name'],'</td>';
								}
								
								//echo '<td>',$value['Enquiry']['exam_date'],'</td>';
								//echo '<td>',( ($value['Enquiry']['slep_scores']<45)?'<b style="color:red">'.$value['Enquiry']['slep_scores'].'</b>':'<b style="color:green">'.$value['Enquiry']['slep_scores'].'</b>' ),'</td>';
								
								echo '<td><div class="slep_exam_date_trigger" id="slep_exam_date_',
										$value['Enquiry']['id'],'">',$value['Enquiry']['exam_date'],'</div>',
										$this->Html->image('ajax_refresh.gif',array('style'=>'display:none;','id'=>'icon_ajax_refresh_ed'.$value['Enquiry']['id'])),
										'</td>';
								
								echo '<td><div class="slep_trigger" id="slep',
										$value['Enquiry']['id'],'">',$value['Enquiry']['slep_scores'],'</div>',
										$this->Html->image('ajax_refresh.gif',array('style'=>'display:none;','id'=>'icon_ajax_refresh'.$value['Enquiry']['id'])),
										'</td>';
								
								echo '<td>'.(($value['Enquiry']['is_feedback']==0)?'<b style="color:red">无</b>':'<b style="color:green">'.count($value['EnquiryFeedback']).'</b>').'</td>';
								//How many times of feedback
								if ($value['Enquiry']['is_feedback']==0) {
									echo '<td>无</td>';
								}else{
									$temp_len = count($value['EnquiryFeedback']);
									echo '<td>',$value['EnquiryFeedback'][$temp_len-1]['Answer']['name'],'</td>';
								}
								
								echo '<td><div class="app_form_trigger" id="',$value['Enquiry']['id'],'">',
									($value['Enquiry']['is_app_form_submit']==0)?'未提交':'已提交','</div>',
									$this->Html->image('ajax_refresh.gif',array('style'=>'display:none;','id'=>'icon_ajax_refresh'.$value['Enquiry']['id'])),
									'</td>';
								
								echo '<td>'.$value['ApplyFeeStatus']['name'].'</td>';//报名费
								echo '<td>'.$value['ProjectFeeStatus']['name'].'</td>';//项目费
								if ($this->Session->read('my_project')==PROJECT_STEP) {
									if (empty($value['Enquiry']['accom_fee_status_id'])) {
										$value['Enquiry']['accom_fee_status_id']=1;
									}
									echo '<td>'.$project_fee_status[$value['Enquiry']['accom_fee_status_id']].'</td>';//住宿费
								}
								echo '<td>'.$value['ContractStatus']['name'].'</td>';//签协议
								echo '<td style="display:none"><div id="mobile_nb_'.$value['Enquiry']['id'].'">',$value['Enquiry']['mobile'],'</div></td>';//给手机号一个特定的id，便于发短信的时候提取用
								echo '<td style="display:none"><div id="email_addr_'.$value['Enquiry']['id'].'">',$value['Enquiry']['email'],'</div></td>';
								echo '<td><div class="action_trigger" name="'.$value['Enquiry']['id'].'">更多操作</div></td></tr>';
							}
						?>
					</tbody>
				</table>