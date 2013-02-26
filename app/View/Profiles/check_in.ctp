<?php 
	echo $this->Html->script('ajax_utils/utils_students',false); 
?>
<div class="flat_area grid_16">
	<h2>欢迎来到赴美阶段Check-In管理系统</h2>
	<?php 
		if (count($data)==0) {
			?>
			<p style="color: red">您还从未Check-In，请尽快添加您的Check-In纪录</p>
			<?php
		}else{
			?>
			<p>您上次Check-In是在<?php echo $data[0]['Checkin']['created']?>，距离下次Check-In还有<b style="color: red"><?php 
				echo 30- round( (time() - strtotime($data[0]['Checkin']['created']))/(1000*60*60*24),0);
			?></b>天</p>
			<?php
		}
	?>
</div>
<?php 
	echo $this->element('general/student_shortcuts');
?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">Check-in表格</h2>
	<div class="toggle_container">
		<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
				$changed_options = array(0=>'不变',1=>'已变更为');
		?>
		<div class="block">
			<h2 class="section">基本信息</h2>
<?php echo $this->Form->create('Checkin'); 
	echo $this->Form->input('Checkin.enquiry_id',array('type'=>'hidden','value'=>$this->Session->read('enquiry_id')));
?>
			<fieldset>
				<label>工作地点<span>如变更请填写新的地址</span> </label>
				<div class="clearfix">
						<?php 
						echo $this->Form->input('Checkin.is_job_location_changed',array(
							'options'=>$changed_options,
							'label'=>'','div'=>false
						));
						echo $this->Form->input('Checkin.new_job_location',array(
							'type'=>'text',
							'label'=>false,'div'=>false,
							'style'=>'display:none;float:left;',
							'value'=>'新工作地址：',
							'onclick'=>'this.value=""'
						)); 
						?>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			
			<fieldset>
				<label>工作内容<span>请说明</span> </label>
				<div class="clearfix">
					<textarea name="data[Checkin][job_description]" title="请填写详细的工作内容说明" class="tooltip autogrow"
						placeholder="情况说明…"></textarea>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			<fieldset>
				<label>住宿地点<span>如变更请填写新的地址</span> </label>
				<div class="clearfix">
						<?php 
						echo $this->Form->input('Checkin.is_accom_changed',array(
							'options'=>$changed_options,
							'label'=>'','div'=>false
						));
						echo $this->Form->input('Checkin.new_accom',array(
							'type'=>'text',
							'label'=>false,'div'=>false,
							'style'=>'display:none;float:left;',
							'value'=>'新住宿地址：',
							'onclick'=>'this.value=""'
						)); 
						?>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			<fieldset>
				<label>住宿条件<span>如变更请填写新的说明</span> </label>
				<div class="clearfix">
						<?php 
						echo $this->Form->input('Checkin.accom_cond_changed',array(
							'options'=>$changed_options,
							'label'=>'','div'=>false
						));
						echo $this->Form->input('Checkin.new_accom_cond',array(
							'type'=>'textarea',
							'label'=>false,'div'=>false,
							'style'=>'display:none;float:left;',
							'value'=>'新住宿条件：',
							'onclick'=>'this.value=""'
						)); 
						?>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			
			<h2 class="section">项目反馈</h2>
			
			<fieldset>
				<label>生活方面有何问题？<span>请说明</span> </label>
				<div class="clearfix">
					<textarea name="data[Checkin][living_notes]" title="请填写详细的说明信息" class="tooltip autogrow"
						placeholder="生活方面的问题…"></textarea>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			<fieldset>
				<label>工作方面有何问题?<span>请说明</span> </label>
				<div>
					<textarea name="data[Checkin][job_notes]" title="请填写详细的内容" class="tooltip autogrow"
						placeholder="工作方面的问题…"></textarea>
					<div class="required_tag tooltip hover left"
						title="必填项目"></div>
				</div>
			</fieldset>
			<fieldset>
				<label>是否参加文化交流活动？<span>请说明</span> </label>
				<div class="clearfix">
					<?php 
						echo $this->Form->input('Checkin.is_social',array(
							'options'=>array(0=>'没有参加',1=>'有参加'),
							'label'=>'','div'=>false
						));
					?>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			<fieldset>
				<label>文化交流活动1的描述，<span>请说明</span> </label>
				<div class="clearfix">
					<textarea name="data[Checkin][social_desc_1]" title="请填写详情" class="tooltip autogrow"
						placeholder="文化交流活动1的描述…"></textarea>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			<fieldset>
				<label>文化交流活动2的描述，<span>请说明</span> </label>
				<div class="clearfix">
					<textarea name="data[Checkin][social_desc_2]" title="请填写详情" class="tooltip autogrow"
						placeholder="文化交流活动2的描述…"></textarea>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			<fieldset>
				<label>对项目有何感受或建议，<span>（不少于300字）</span> </label>
				<div class="clearfix">
					<textarea name="data[Checkin][comments]" title="请填写感受或建议" class="tooltip autogrow"
						placeholder="感受或建议（不少于300字）…"></textarea>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			<button class="green full_width div_icon has_text">
				<div class="ui-icon ui-icon-carat-1-n"></div>
				<span>提交Check-in</span>
			</button>
<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>