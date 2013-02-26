<div style="display:none">
	<div id="transfer_enq_form" style="width:700px;height:315px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		请选择这个学生被转给哪个工作组
		</h2>
		<?php 
			echo $this->Form->create(NULL,array('url'=>'/Enquiries/transfer'));
			$to_project_id = 0;
			if ($this->Session->read('my_project')==PROJECT_STEP) {
				$to_project_id = PROJECT_SWT;
			}elseif ($this->Session->read('my_project')==PROJECT_SWT){
				$to_project_id = PROJECT_STEP;
			}
			echo $this->Form->input('Enquiry.project_id',array('type'=>'hidden','value'=>$to_project_id));
			echo $this->Form->input('Enquiry.id',array('type'=>'hidden','value'=>''));
		?>
		<fieldset class="label_side">
			<label>工作组</label>
				<div>
					<?php 
						echo $this->Form->input('Enquiry.group_id',
							array('label'=>'','div'=>false,'options'=>$other_groups,'id'=>'transfer_group_selector'));
					?>
				</div>
		</fieldset>
		<input type="submit" class="short_message_btn" value="确认" />
				
		<?php echo $this->Form->end();?>
	</div>
</div>