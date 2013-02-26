<div class="box grid_16">
	<h2 class="box_head grad_blue">报名阶段学生信息搜索</h2>
	<a href="#" class="grabber"></a>
	<a href="#" class="toggle"></a>
	<div class="toggle_container">
		<div class="block">
			<?php 
				//echo $this->Form->create(null,array('url'=>'/'.$controller_name.'/search','type'=>'post')); 
				echo $this->Form->create();
				$local_projects=array(1=>'暑期带薪实习',2=>'短期实习',3=>'专业实习',4=>'夏令营',5=>'高中生赴美');
				$local_phases=array(1=>'报名阶段',2=>'申请阶段',3=>'安置阶段',4=>'签证阶段',5=>'行前阶段',6=>'赴美阶段',7=>'回国阶段',9=>'因故取消');
				$is_applicant_option =array(0=>'未提交',1=>'已提交');
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
						<?php 
						$presentations[OPERATION_OWNED_STUDENT]='自主报名';
						echo $this->Form->input('Search.Enquiry__presentation_id',array('label'=>'宣讲会日期场次：','options'=>$presentations,'empty'=>'全部'));
						?>
						</div>
					</div>
				</div>
				<div class="columns clearfix">
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.Enquiry__is_app_form_submit',array('label'=>'提交报名表：','options'=>$is_applicant_option,'empty'=>'全部'));?></div>
					</div>
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.Enquiry__project_id',array('label'=>'报名项目：','options'=>$local_projects,'empty'=>'全部'));?></div>
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