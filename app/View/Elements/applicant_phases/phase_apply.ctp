<div class="block">
				<table class="static"> 
					<thead> 
						<tr> 
							<th>要求的文件</th>
							<th>最后提交的文件</th>
							<th>上次提交日期</th>
							<th>审核结果</th> 
							<th>老师留言</th> 
							<th>资料状态</th> 
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							foreach ($applicants_data as $value){
							?>
							<tr>
								<td>
								<?php echo (strlen($value['DownloadFile']['title'])>0)?$value['DownloadFile']['title']:$value['DownloadFile']['file_name']; ?>
								</td>
								<td><?php 
									echo is_null($value['ApplicantFile']['file_name'])?'未提交':$this->Html->link($value['ApplicantFile']['file_name'],array('controller'=>'ApplicantFiles','action'=>'download',$value['ApplicantFile']['id'])); 
								?></td>
								<td><?php 
									echo is_null($value['ApplicantFile']['modified'])?'无':$value['ApplicantFile']['modified']; 
								?></td>
								<td id="is_passed_<?php echo $value['ApplicantFile']['id']; ?>">
								<?php echo ($value['ApplicantFile']['is_passed']==1)?'<b style="color:green">通过</b>':'<b style="color:red">未通过</b>'; ?>
								</td>
								<td id="latest_comment_<?php echo $value['ApplicantFile']['id']; ?>">
								<?php echo is_null($value['ApplicantFile']['latest_comments'])?'没有留言':$value['ApplicantFile']['latest_comments']; ?>
								</td>
								<td id="is_readed_<?php echo $value['ApplicantFile']['id']; ?>">
								<?php echo ($value['ApplicantFile']['is_readed']==1)?'<b style="color:green">老师已阅</b>':'<b style="color:red">老师还没阅读</b>'; ?>
								</td>
								<td>
								<?php 
									if ($value['ApplicantFile']['id']) {
										echo $this->Html->link('查看文件',array('controller'=>'ApplicantFiles','action'=>'download',$value['ApplicantFile']['id'])),'&nbsp;&nbsp;&nbsp;';
										if ($value['ApplicantFile']['is_passed']==0) {
											echo $this->Html->link('通过',
											array('controller'=>'ApplicantFiles','action'=>'pass',$value['ApplicantFile']['id'],$data['Applicant']['id'],$phase_id),
											array(
												'title'=>'点击确认申请人提交的这个文件可以通过'
											),
											'您确认这个文件可以通过吗?'
											),'&nbsp;&nbsp;&nbsp;';
										}else{
											echo $this->Html->link('不通过',
											array('controller'=>'ApplicantFiles','action'=>'unpass',$value['ApplicantFile']['id'],$data['Applicant']['id'],$phase_id),
											array(
												'title'=>'点击确认申请人提交的这个文件需要重新提交',
												'style'=>'color:red'
											),
											'您确认这个文件需要申请人重新提交吗?'
											),'&nbsp;&nbsp;&nbsp;';
										}
										?>
										<a class="applicant_leave_comments_btn" id="<?php echo $value['ApplicantFile']['id']; ?>" href="#applicant_leave_comment_form">留言</a>&nbsp;&nbsp;&nbsp;
										<a href="#applicant_submit_file_form" class="teacher_upload_app_job_offer_btn"
										 name="<?php echo $value['DownloadFile']['phase_id']?>" title="<?php echo $value['DownloadFile']['id']?>">上传</a>
										<?php
									}else{
										echo '<b>申请人没有提交</b>';
									}
								?>
								</td>
							</tr>
							<?php
							}
						?>
					</tbody>
				</table>
				</div>