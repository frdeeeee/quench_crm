<?php
	if (empty($d_oversea['Profile']['id'])) {
		echo '<p>还没有激活</p>';
	}else{
	?>
			<br />
		<div class="section">
			<h3>&nbsp;&nbsp;申请人的激活请求</h3>
		</div>
			<table class="static"> 
					<thead> 
						<tr> 
							<th>申请激活的日期</th>
							<th>最后更新日期</th>
							<th>状态</th>
							<th>老师留言</th>
							<th>提交的激活信息</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
							<tr>
								<td><?php echo $d_oversea['Profile']['created']; ?></td>
								<td><?php echo $d_oversea['Profile']['modified']; ?></td>
								<td id="profile_is_updated_<?php echo $d_oversea['Profile']['id'];?>"><?php 
									if ($d_oversea['Profile']['is_updated_by_student']==1) {
										echo '<b style="color:red">有信息更新</b>';
									}else {
										echo '无更新';
									}
									?>
								</td>
								<td><?php echo $d_oversea['Profile']['teacher_notes']; ?></td>
								<td><?php 
									echo $this->Html->link('查看',array('controller'=>'Profiles','action'=>'view_detail',$d_oversea['Profile']['id']),array('target'=>'_blank')); 
								?></td>
								<td>
								<?php 
									if ($d_oversea['Profile']['status']==0) {
										?>
										<span id="profile_activate_btn" title="点击确认通过这个申请人" 
										style="color:red;cursor: pointer" onclick="return confirm('您确认通过这个申请人吗?');" name="<?php echo $d_oversea['Profile']['id']?>">
										通过
										</span>&nbsp;&nbsp;
										<a id="leave_teacher_notes_btn" title="如果填写的信息有问题，给申请人留言" href="#leave_teacher_notes_form" style="color:green"
											name="<?php echo $d_oversea['Profile']['id']?>">给申请人留言</a>
										<?php
										echo $this->element('fancy_forms/activate_teacher_notes_form');
									}else{
										echo '<b>申请人已经激活</b>';
									}
								?>
								</td>
							</tr>
					</tbody>
				</table>
				
	<?php
		//pr($d_oversea);
		if (!is_null($d_oversea['Checkin'])) {
			?>
			<br />
			<h3>&nbsp;&nbsp;申请人的Check-in纪录</h3>
			<table class="static"> 
					<thead> 
						<tr> 
							<th>Checkin的日期</th>
							<th>最后更新日期</th>
							<th>状态</th>
							<th>老师留言</th>
							<th>Checkin内容</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
					<?php 
						foreach ($d_oversea['Checkin'] as $value) {
						?>
						<tr>
							<td><?php echo $value['created']?></td>
							<td><?php echo $value['modified']?></td>
							<td id="checkin_is_updated_<?php echo $value['id'];?>"><?php 
									if ($value['is_updated_by_student']==1) {
										echo '<b style="color:red">有信息更新</b>';
									}else {
										echo '无更新';
									}
									?>
							</td>
							<td id="checkin_teacher_notes_<?php echo $value['id']?>"><?php echo $value['teacher_notes']?></td>
							<td><?php echo $this->Html->link('查看详情',array('controller'=>'Checkins','action'=>'view_detail',$value['id'])); ?></td>
							<td id="checkin_actions_<?php echo $value['id']?>">
								<?php 
									if ($value['status']==0) {
										?>
										<span class="checkin_pass_btn" title="点击确认通过这个Checkin" 
										style="color:red;cursor: pointer" onclick="return confirm('您确认通过这个Checkin吗?');" name="<?php echo $value['id']?>">
										通过
										</span>&nbsp;&nbsp;
										<a class="leave_checkin_teacher_notes_btn" title="如果填写的Checkin信息有问题，给申请人留言" href="#leave_checkin_teacher_notes_form" style="color:green"
											name="<?php echo $value['id']?>">给申请人留言</a>
										<?php
										echo $this->element('fancy_forms/checkin_teacher_notes_form');
									}else{
										echo '<b>已通过</b>';
									}
								?>
							</td>
						</tr>
						<?php
						}
					?>
					</tbody>
			</table>
			
			<br />
			<h3>&nbsp;&nbsp;申请人的回国登记</h3>
<div class="block" id="app_return_form">
	<div class="columns clearfix">
		<div class="col_50">
			<div class="section">
				<?php
				echo $this->Form->input(
							'Applicant.return_date',
							array(
								'default'=>$data['Applicant']['return_date'],
								'label'=>'归国日期/时间：','before'=>'<div class="cake_input_datetime" name="return_date">','after'=>'</div>'
								,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')),'type'=>'datetime'
							));
				?>
			</div>
		</div>
		<div class="col_50">
			<div class="section">
			<?php
				echo $this->Form->input(
						'Applicant.project_status_id',
						array('value'=>(isset($data['Applicant']['project_status_id']))?$data['Applicant']['project_status_id']:'',
						'label'=>'项目进行状态：','id'=>'project_status_id','options'=>$project_status));
			?>
			</div>
		</div>
	</div>
	<div class="columns clearfix">
		<div class="col_50">
			<div class="section">
			<?php
				echo $this->Form->input(
						'Applicant.return_status_id',
						array('value'=>(isset($data['Applicant']['return_status_id']))?$data['Applicant']['return_status_id']:'',
						'label'=>'回国登记：','id'=>'return_status_id','options'=>$return_status));
			?>
			</div>
		</div>
		<?php 
			if ($data['Applicant']['phase_id']==2) {
				?>
				<div class="col_50">
					<div class="section">
					<?php
						echo $this->Form->input(
								'Applicant.homestay_ok',
								array('value'=>(isset($data['Applicant']['homestay_ok']))?$data['Applicant']['homestay_ok']:'',
								'label'=>'临行时是否与寄宿家庭交接完毕：','id'=>'homestay_ok','options'=>array(0=>'没有',1=>'交接完毕')));
					?>
					</div>
				</div>
				<?php
			}
		?>
	</div>
	<div class="columns clearfix">
		<div id="modify_app_return_btn" class="short_message_btn">修改归国状态</div>
		<div id="save_app_return_btn" class="short_message_btn">保存归国状态</div>
	</div>
</div>
			
			<br />
			<h3>&nbsp;&nbsp;申请人的相册</h3>
			<div class="grid_16">
				<ul class="clearfix">
					<?php 
						foreach ($photos as $value) {
							?>
							<li class="photo_frame">
								<a rel="collection" 
								href="/img/student_files/<?php echo $value['CheckinPhoto']['enquiry_id'].'/'.$value['CheckinPhoto']['file_path']; ?>"
								title="<?php echo $value['CheckinPhoto']['description'];?>"> 
									<?php 
										echo $this->Html->image(
											'student_files/'.$value['CheckinPhoto']['enquiry_id'].'/'.$value['CheckinPhoto']['file_path'],
											array('height'=>84,'width'=>150)
										);
									?>
								</a>
								<p><?php echo $value['CheckinPhoto']['title'];?></p> 
								<p><?php echo round($value['CheckinPhoto']['file_size']/1000,0);?>kb</p>
							</li>
							<?php
						}
					?>
				</ul>
			</div>
			<?php
		}
	}
?>