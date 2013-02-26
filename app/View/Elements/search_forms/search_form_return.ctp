<div class="box grid_16">
	<h2 class="box_head grad_blue">回国阶段学生信息搜索</h2>
	<a href="#" class="grabber"></a>
	<a href="#" class="toggle"></a>
	<div class="toggle_container">
		<div class="block">
			<?php 
				echo $this->Form->create();
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
					<div class="col_25">
						<div class="section"><?php echo $this->Form->input('Search.Applicant__return_status_id',
							array('label'=>'回国登记：','options'=>$return_status,'empty'=>'请选择...'));?></div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php echo $this->Form->input('Search.Applicant__project_status_id',
									array('label'=>'项目情况：','options'=>$project_status,'empty'=>'请选择...'));
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
		</div>
	</div>
</div>