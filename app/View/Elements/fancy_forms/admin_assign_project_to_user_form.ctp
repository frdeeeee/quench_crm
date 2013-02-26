<div style="display:none">
	<div id="assign_project_to_user" style="width:700px;height:325px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		向运营部员工分配任务
		</h2>
		<?php echo $this->Form->create('Users',array('action'=>'assign_project_to_user')); ?>
		<fieldset class="label_side">
			<label>运营部员工:(必填)</label>
				<div>
					<select name="data[UserProject][user_id]">
						<?php 
							foreach ($data as $value) {
								if ($value['User']['department_id']==OPERATION_DEPARTMENT) {
									echo '<option value="'.$value['User']['id'].'">'.$value['User']['name'].'</option>';
								};
							}
						?>
					</select>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>负责项目:(必填)</label>
				<div>
					<?php 
						echo $this->Form->input('UserProject.project_id',array('label'=>'','div'=>false,'options'=>$projects));
					?>
				</div>
		</fieldset>
		<?php echo $this->Form->end('提交'); ?>
	</div>
</div>