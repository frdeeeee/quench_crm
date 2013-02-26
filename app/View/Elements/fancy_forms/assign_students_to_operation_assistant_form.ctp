<div style="display:none">
	<div id="assign_students_to_operation_assistant_form" style="width:700px;height:425px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		为以下学生指定运营老师
		</h2>
		<?php 
			echo $this->Form->create('Enquiry',array('action'=>'assign_to_operator_assistant')); 
			echo $this->Form->input('Enquiry.student_ids',array('type'=>'hidden','id'=>'student_ids_wrapper'));
		?>
		<fieldset class="label_side">
			<label>学生姓名：</label>
				<div id="student_names_wrapper">
					
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>被分配給:(必填)</label>
				<div>
					<?php 
						echo $this->Form->input('Enquiry.user_id',array('label'=>'','div'=>false,'options'=>$operator_assistants));
					?>
				</div>
		</fieldset>
		<?php echo $this->Form->end('提交'); ?>
	</div>
</div>