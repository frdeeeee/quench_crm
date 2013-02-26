<div class="box grid_16">
	<h2 class="box_head grad_green">宣讲会统计</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle"></a>
	<div class="toggle_container">
		<div class="block">
			<?php echo $this->Form->create(null,array('url'=>'/Presentations/statictic_report','type'=>'post')); ?>
				<div class="columns clearfix">
					<div class="col_25">
						<div class="section">
								<?php 
									echo $this->Form->input('Statistic.customer_id',array('options'=>$schools,'label'=>'','empty'=>'所有学校..'));
								?>
						</div>
					</div>
					<div class="col_25">
									<div class="section">
										<?php echo $this->Form->input('Statistic.from_date',array('label'=>'开始日期：','class'=>'datepicker','style'=>'border:solid 1px #E0E0E0')); ?>
									</div>
					</div>
					<div class="col_25">
									<div class="section">
										<?php echo $this->Form->input('Statistic.to_date',array('label'=>'截止日期：','class'=>'datepicker','style'=>'border:solid 1px #E0E0E0')); ?>
									</div>
					</div>
					<div class="col_25">
									<div class="section">
										<button class="light text_only has_text" style="margin-top:-5px;">
											<span>开始统计</span>
										</button>
									</div>
					</div>
				</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
<?php  
	echo $this->element('general/sales_shortcuts');
	echo $this->element('tables/presentations/statistic_report');
?>
