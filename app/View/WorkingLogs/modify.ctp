<div class="flat_area grid_16">
	<h2>Task Modification</h2>
</div>
<div class="box grid_16">
	<div class="block">
		<?php 
			echo $this->Form->create('WorkingLog'); 
			echo $this->Form->input('WorkingLog.id',array('type'=>'hidden','value'=>$data['WorkingLog']['id']));
		?>
		<fieldset class="label_side">
			<label>Subject</label>
				<div>
					<?php echo $this->Form->input('WorkingLog.name',array('label'=>'','div'=>false,'value'=>$data['WorkingLog']['name'])); ?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>Content</label>
				<div>
					<?php echo $this->Form->input('WorkingLog.content',array('label'=>'','div'=>FALSE,'type'=>'textarea','value'=>$data['WorkingLog']['content'])); ?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>Result</label>
				<div>
					<?php echo $this->Form->input('WorkingLog.result',array('label'=>'','div'=>FALSE,'type'=>'textarea','value'=>$data['WorkingLog']['result'])); ?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>Questions</label>
				<div>
					<?php echo $this->Form->input('WorkingLog.questions',array('label'=>'','div'=>FALSE,'type'=>'textarea','value'=>$data['WorkingLog']['questions'])); ?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>Next Appointment Date</label>
				<div>
					<?php echo $this->Form->input('WorkingLog.next_appointment_date',array('label'=>'','div'=>FALSE,'value'=>$data['WorkingLog']['next_appointment_date'])); ?>
				</div>
		</fieldset>
		<fieldset class="label_top">
			<p>&nbsp; </p>
			<div class="clearfix">
				<button class="green text_only has_text" id="save_working_log_ajax">
					<span>Save Now</span>
				</button>
			</div>
		</fieldset>
		<?php echo $this->Form->end();?>
	</div>
</div>