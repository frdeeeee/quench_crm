<div class="box grid_16">
	<h2 class="box_head grad_blue">申请阶段学生信息搜索</h2>
	<a href="#" class="grabber"></a>
	<a href="#" class="toggle"></a>
	<div class="toggle_container">
		<div class="block">
			<?php 
				//echo $this->Form->create(null,array('url'=>'/'.$controller_name.'/search','type'=>'post')); 
				echo $this->Form->create();
				//$local_phases=array(1=>'报名阶段',2=>'申请阶段',3=>'安置阶段',4=>'签证阶段',5=>'行前阶段',6=>'赴美阶段',7=>'回国阶段',9=>'因故取消');
				$is_applicant_option =array(0=>'否',1=>'是');
				$applicant_files_status = array(0=>'未完成',1=>'已完成，等待外方安置',2=>'外方已通过');
			?>
				<div class="columns clearfix">
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.Enquiry__name',array('label'=>'学生姓名：','class'=>'need_auto_comp','title'=>'Enquiry__name'));?></div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php echo $this->Form->input('Search.Enquiry__school',array('label'=>'学校名称: ','class'=>'need_auto_comp','title'=>'Customer__name')); //这个title表明要auto complete取搜索customer的name表格?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php echo $this->Form->input('Search.Applicant__application_data',
									array('label'=>'全部申请资料：','options'=>$applicant_files_status,'empty'=>'请选择...'));
							?>
						</div>
					</div>
				</div>
				<div class="columns clearfix">
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.Applicant__phase_id',array('label'=>'目前项目阶段：','options'=>$local_phases,'empty'=>'请选择...'));?></div>
					</div>
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.Applicant__orgnization_id',array('label'=>'机构：','options'=>$orgnizations,'empty'=>'请选择...'));?></div>
					</div>
					<div class="col_33">
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