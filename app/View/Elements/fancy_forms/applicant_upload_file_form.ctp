<div style="display:none">
	<div id="applicant_submit_file_form" style="width:500px;height:300px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		上传我的资料
		</h2>
		<?php 
			echo $this->Form->create(NULL,array('type'=>'file','url'=>'/Students/upload')); 
			echo $this->Form->input('ApplicationFile.applicant_id',array('type'=>'hidden','value'=>$this->Session->read('applicant_id')));
			echo $this->Form->input('ApplicationFile.download_file_id',array('type'=>'hidden','value'=>''));
			echo $this->Form->input('ApplicationFile.phase_id',array('type'=>'hidden','value'=>$phase_id));
		?>
		<fieldset class="label_side">
			<label>选择文件</label>
				<div>
					<?php echo $this->Form->file('Applicant.application_form',array('class'=>'uniform','id'=>'fileupload','type'=>'file')); ?>
				</div>
		</fieldset>
		<input type="submit" class="short_message_btn" value="上传我的资料" />
		<?php echo $this->Form->end();?>
	</div>
</div>