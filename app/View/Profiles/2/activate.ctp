<div class="flat_area grid_16">
	<h2><?php echo $this->Session->read('enquiry_name'); ?>你好，欢迎来到赴美阶段管理系统</h2>
	<p>您还没有激活您的赴美行程，请先完成下面的表格并提交，以激活Check In功能</p>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_blue">激活表格</h2>
	<a href="#" class="grabber">&nbsp;</a> <a href="#" class="toggle">&nbsp;</a>
	<div class="toggle_container">
		<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
		?>
		<div class="block">
			<h2 class="section">请务必准确回答下列的问题</h2>
<?php echo $this->Form->create('Profile'); ?>
			<fieldset>
				<label>到达美国航班信息是否与电子行程单上一致，<span>请说明(例如：不一致，因天气原因航班晚点2小时到达，当时已通知了接机的家庭，
				以下是我新的航班详细信息：）</span> </label>
				<div class="clearfix">
					<textarea name="data[Profile][itinerary_notes]" title="请填写详细的说明信息" class="tooltip autogrow"
						placeholder="情况说明…"></textarea>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			<fieldset>
				<label>工作地点<span>请说明工作地点名称和详细地址（例如，我的雇主公司名是Pizza Hut - Manteo, 实际工作地址是204 Sir Walter 
				Raleigh Road, Manteo, NC, 邮编是27954。紧急联系电话是252-473-1546）</span> </label>
				<div>
					<input name="data[Profile][job_location]" title="请填写详细的说明信息"
						class="tooltip right" type="text">
					<div class="required_tag tooltip hover left"
						title="必填项目"></div>
				</div>
			</fieldset>
			
			<fieldset>
				<label>工作内容，<span>请说明</span> </label>
				<div class="clearfix">
					<textarea name="data[Profile][job_description]" title="请填写详细的工作内容信息" class="tooltip autogrow"
						placeholder="工作内容…"></textarea>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			
			<fieldset>
				<label>住宿地点<span>请说明住宿地点详细地址（例如，我住在504 Budleigh Street, Manteo, NC, 邮编是27954，房东叫Kim，联系电话是252-473-2107）</span> </label>
				<div>
					<input name="data[Profile][accommodation]" title="请填写详细信息"
						class="tooltip right" type="text">
					<div class="required_tag tooltip hover left"
						title="必填项目"></div>
				</div>
			</fieldset>
			<fieldset>
				<label>住宿条件，<span>请说明</span> </label>
				<div class="clearfix">
					<textarea name="data[Profile][accom_conditions]" title="请填写住宿条件信息" class="tooltip autogrow"
						placeholder="住宿条件…"></textarea>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			<fieldset>
				<label>离开寄宿家庭时，是否已经交接清楚以及让房主检查完毕<span>请说明</span> </label>
				<div class="clearfix">
					<select id="ProfileAccomHandover" name="data[Profile][accom_handover]">
						<option value="empty">请选择...</option>
						<option value="0">未交接</option>
						<option value="1">已交接完毕</option>
					</select>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
			<button class="green full_width div_icon has_text">
				<div class="ui-icon ui-icon-carat-1-n"></div>
				<span>激活</span>
			</button>
<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
