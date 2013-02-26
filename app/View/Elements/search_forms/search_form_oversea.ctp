<div class="box grid_16">
	<h2 class="box_head grad_blue">赴美阶段学生信息搜索</h2>
	<a href="#" class="grabber"></a>
	<a href="#" class="toggle"></a>
	<div class="toggle_container">
		<div class="block">
			<?php 
				echo $this->Form->create();
				$activate_option =array(0=>'等待审核',1=>'已通过');
				$checkin_status = array(1=>'逾期未提交',2=>'状态正常');
			?>
				<div class="columns clearfix">
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.Enquiry__name',array('label'=>'学生姓名：','class'=>'need_auto_comp'));?></div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php echo $this->Form->input('Search.Enquiry__school',array('label'=>'学校名称: ','class'=>'need_auto_comp')); //这个title表明要auto complete取搜索customer的name表格?>
						</div>
					</div>
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.Applicant__phase_id',array('label'=>'目前项目阶段：','options'=>$local_phases,'empty'=>'请选择...'));?></div>
					</div>
				</div>
				
				<div class="columns clearfix">
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.ApplicantJob__company_name',array('label'=>'雇主：'));?></div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php echo $this->Form->input('Search.ApplicantJob__job_title',array('label'=>'工作职位: ','class'=>'need_auto_comp')); //这个title表明要auto complete取搜索customer的name表格?>
						</div>
					</div>
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.ApplicantJob__employer_address',array('label'=>'所在地：','class'=>'need_auto_comp','size'=>50));?></div>
					</div>
				</div>
				
				<div class="columns clearfix">
					<div class="col_25">
						<div class="section"><?php echo $this->Form->input('Search.Profile__status',array('label'=>'激活状态：','options'=>$activate_option,'empty'=>'请选择...'));?></div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php echo $this->Form->input('Search.Profile__modified',
									array('label'=>'Check-in状态：','options'=>$checkin_status,'empty'=>'请选择...'));
							?>
						</div>
					</div>
					<div class="col_25">
						<div class="section"><?php echo $this->Form->input('Search.Applicant__orgnization_id',array('label'=>'机构：','options'=>$orgnizations,'empty'=>'请选择...'));?></div>
					</div>
					
					<div class="col_25">
						<div class="section">
							<button class="green img_icon has_text" type="submit">
									<?php echo $this->Html->image('icons/small/white/bended_arrow_right.png',array('width'=>24,'height'=>24)); ?>
									<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;开始搜索</span>
							</button>
						</div>
					</div>
				</div>
			<?php 
				echo $this->Form->end(); 
			?>
			<div style="display:none" id="availble_enquiry_names">
				<?php 
					foreach ($enquiry_names as $value) {
						echo '<div class="enq_name">',$value['Enquiry']['name'],'</div>';
					}
				?>
			</div>
			<div style="display:none" id="availble_school_names">
				<?php 
					foreach ($school_names as $value) {
						echo '<div class="sch_name">',$value['Customer']['name'],'</div>';
					}
				?>
			</div>
			<div style="display:none" id="availble_employer_names">
				<?php 
					foreach ($employees as $value) {
						echo '<div class="com_name">',$value['ApplicantJob']['company_name'],'</div>';
					}
				?>
			</div>
			<div style="display:none" id="availble_employer_address">
				<?php 
					foreach ($employees as $value) {
						echo '<div class="emp_addr">',$value['ApplicantJob']['employer_address'],'</div>';
					}
				?>
			</div>
		</div>
	</div>
</div>