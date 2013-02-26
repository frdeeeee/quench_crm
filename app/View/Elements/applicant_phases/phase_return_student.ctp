<div class="block" id="app_return_form">
	<div class="columns clearfix">
		<div class="col_25">
			<div class="section">
				<?php
					echo $this->Form->input(
							'Applicant.return_date',
							array(
								'default'=>(isset($return_form['Applicant']['return_date']))?$return_form['Applicant']['return_date']:'',
								'label'=>'归国日期：','before'=>'<div class="cake_input_date" name="return_date">','after'=>'</div>'
								,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1)
							));
				?>
			</div>
		</div>
		<div class="col_25">
			<div class="section">
			<?php
				echo $this->Form->input(
						'Applicant.project_status_id',
						array('value'=>(isset($return_form['Applicant']['project_status_id']))?$return_form['Applicant']['project_status_id']:'',
						'label'=>'项目进行状态：','id'=>'project_status_id','options'=>$project_status));
			?>
			</div>
		</div>
		<div class="col_25">
			<div class="section">
			<?php
				echo $this->Form->input(
						'Applicant.return_status_id',
						array('value'=>(isset($return_form['Applicant']['return_status_id']))?$return_form['Applicant']['return_status_id']:'',
						'label'=>'回国登记：','id'=>'return_status_id','options'=>$return_status));
			?>
			</div>
		</div>
		<?php 
			if ($this->Session->read('project_id')==2) {
				?>
				<div class="col_25">
					<div class="section">
					<?php
						echo $this->Form->input(
								'Applicant.homestay_ok',
								array('value'=>(isset($return_form['Applicant']['homestay_ok']))?$return_form['Applicant']['homestay_ok']:'',
								'label'=>'临行时是否与寄宿家庭交接完毕：','id'=>'homestay_ok','options'=>array(0=>'没有',1=>'交接完毕')));
					?>
					</div>
				</div>
				<?php
			}
		?>
	</div>
	<div class="columns clearfix">
		<div id="save_app_return_btn" class="short_message_btn">保存归国状态</div>
	</div>
</div>