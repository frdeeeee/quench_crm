<div class="box grid_16">
	<h2 class="box_head grad_blue">学生信息搜索</h2>
	<a href="#" class="grabber"></a>
	<a href="#" class="toggle"></a>
	<div class="toggle_container">
		<div class="block">
			<?php 
				//echo $this->Form->create(null,array('url'=>'/'.$controller_name.'/search','type'=>'post')); 
				echo $this->Form->create(null,array('url'=>'/Searchs/search','type'=>'post'));
				if (isset($by_group_id)) {
					echo $this->Form->input('Search.group_id',array('type'=>'hidden','value'=>$by_group_id));
				}
				$local_projects=array(0=>'全部',1=>'暑期带薪实习',2=>'短期实习',3=>'专业实习',4=>'夏令营',5=>'高中生赴美');
				$local_phases=array(1=>'报名阶段',2=>'申请阶段',3=>'安置阶段',4=>'签证阶段',5=>'行前阶段',6=>'赴美阶段',7=>'回国阶段',9=>'因故取消');
				$local_feedback_answer=array(0=>'全部',1=>'参加',2=>'不参加',3=>'等待');
				$local_sources=array(0=>'全部',1=>'代理',2=>'学校',3=>'个人,零散报名');
				$local_job_status =array(0=>'全部',1=>'待定',2=>'已有');
				$by_date = array(1=>'全部', 2=>'签证培训日期',3=>'签证日期',4=>'行前培训日期',5=>'赴美时间',6=>'抵达中国日期',8=>'报名日期',9=>'SLEP考试日期');
			?>
				<div class="columns clearfix">
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.name',array('label'=>'学生姓名：'));?></div>
					</div>
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.school',array('label'=>'学校名称: '));?></div>
					</div>
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.project_id',array('label'=>'报名项目：','options'=>$local_projects));?></div>
					</div>
					
				</div>
				<div class="columns clearfix">
					
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.phase_id',array('label'=>'所处阶段：','options'=>$local_phases));?></div>
					</div>
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.answer_id',array('label'=>'回访结果：','options'=>$local_feedback_answer));?></div>
					</div>
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.reason_id',array('label'=>'学生来源：','options'=>$local_sources));?></div>
					</div>
				</div>
				<div class="columns clearfix">
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.by_date',array('label'=>'按日期条件：','options'=>$by_date));?></div>
					</div>
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.from',array('label'=>'起始日期：','class'=>'datepicker'));?></div>
					</div>
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.to',array('label'=>'截至日期：','class'=>'datepicker'));?></div>
					</div>
				</div>
				<div class="columns clearfix">
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.job_status',array('label'=>'工作状态：','options'=>$local_job_status));?></div>
					</div>
					<div class="col_33">
						<div class="section"><?php echo $this->Form->input('Search.orgnization_id',array('label'=>'机构名称：','class'=>$orgnizations,'empty'=>'全部'));?></div>
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
				
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>