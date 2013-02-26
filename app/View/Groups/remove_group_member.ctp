<div class="flat_area grid_16">
	<h2>从用户组中移除组员</h2>
</div>
<div class="box grid_16 tabs">
	<div class="toggle_container">
		<h2 class="box_head grad_blue">用户组名称：<?php echo $data['Group']['name']; ?>；负责人：<?php echo $data['Leader']['name']; ?></h2>
		<?php 
			if (isset($msg_type)) {echo $this->Msg->output( $msg_type,$this->Session->flash() );}
		?>
		<div class="block">
			<?php
			echo $this->Form->create('Gourp');
			echo $this->Form->input('Gourp.id',array('type'=>'hidden','value'=>$data['Group']['id']));
			$members = array();
			foreach ($data['GroupUser'] as $value) {
				if ($value['user_id'] !== $data['Leader']['id']) {
					$members[$value['id']] = $value['User']['name'];
				};
			}
			?>
			<fieldset class="label_side">
				<label>需要被移除的组员</label>
				<div>
					<?php 
						echo $this->Form->input('Group.remove_this_id',array('options'=>$members,'empty'=>'请选择...','label'=>'','div'=>false));
					?>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			<button class="green full_width">
				<div class="ui-icon ui-icon-carat-1-n"></div>
					<span>删除选定组员</span>
				</button>
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>