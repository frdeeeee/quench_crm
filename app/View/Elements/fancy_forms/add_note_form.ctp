<div style="display:none">
	<div id="add_note_form_wrapper" style="width:700px;height:515px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		我的新便条
		<?php echo $this->Html->image('ajax_refresh.gif',array('style'=>'margin-top:-15px;float:right;display:none;','id'=>'icon_note_adding_refresh')); ?>&nbsp;
		</h2>
		<?php 
			echo $this->Form->create();
		?>
		<fieldset class="label_side">
			<label>请选择标签</label>
				<div>
					<?php 
						echo $this->Form->input('Note.user_id',array('type'=>'hidden','value'=>$current_user['id']));
						echo $this->Form->input('Note.tag_id',array('label'=>'','div'=>false,'options'=>array()));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>重要性</label>
				<div>
					<?php 
						echo $this->Form->input('Note.is_cool',array('label'=>'','div'=>false,'options'=>array(0=>'一般',1=>'重要')));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>收藏在</label>
				<div>
					<?php 
						echo $this->Form->input('Note.on_desktop',array('label'=>'','div'=>false,'options'=>array(0=>'便条夹子',1=>'桌面上')));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>便条标题：</label>
				<div>
					<?php 
						echo $this->Form->input('Note.name',array('label'=>false,'div'=>false,'value'=>'标题：'));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>内容：</label>
				<div>
					<?php 
						echo $this->Form->input('Note.content',array('label'=>false,'div'=>false,'type'=>'textarea'));
					?>
				</div>
		</fieldset>
		<div id="note_add_btn" class="short_message_btn">
				立即保存
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>
<!-- 用来显示便条的内容 -->
<div style="display:none">
	<div id="note_content_viewer_wrapper" style="width:400px;height:315px;overflow:auto;">
		<fieldset class="label_side">
			<label>便条内容</label>
				<div id="current_note_content">
				</div>
		</fieldset>
		<?php echo $this->Form->input('Note.delete_id',array('type'=>'hidden')); //用来保存想要删除的note的id?>
		<div id="note_remove_btn" class="short_message_btn">
				删除便条
		</div>
	</div>
</div>