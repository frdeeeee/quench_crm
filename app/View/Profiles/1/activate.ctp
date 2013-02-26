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
				<label>到达美国航班信息是否与电子行程单上一致，<span>请说明(例如：不一致，因天气原因航班晚点2小时到达，当时已通知了接机的雇主，
				以下是我新的航班详细信息：）</span> </label>
				<div class="clearfix">
					<textarea name="data[Profile][itinerary_notes]" title="请填写详细的说明信息" class="tooltip autogrow"
						placeholder="情况说明…"></textarea>
					<div class="required_tag tooltip hover left" title="必填项目"></div>
				</div>
			</fieldset>
					<fieldset>
						<label>是否激活外方后台SEVIS信息，<span>请说明（例如：我已激活外方后台SEVIS信息，正等待外方审核。/我已收到外方的邮件通知我激活成功。）</span> </label>
						<div class="clearfix">
							<textarea name="data[Profile][sevis_notes]" title="请填写详细的说明信息" class="tooltip autogrow"
								placeholder="情况说明…"></textarea>
							<div class="required_tag tooltip hover left" title="必填项目"></div>
						</div>
					</fieldset>
					<fieldset>
						<label>是否办社保号，<span>请说明（例如：已经在6月18日办理，据通知10个工作日内会寄到雇主处。/还没有办理，但是星期二雇主会带我们去统一办理）</span> </label>
						<div class="clearfix">
							<textarea name="data[Profile][social_insu_notes]" title="请填写详细的说明信息" class="tooltip autogrow"
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
				<label>工作内容，<span>请说明（例如，前三天我们进行了简单的新员工培训，现在我和其他三名同学负责FOOD PREP，每周1个休息日，
				根据最近的调班，我是11:00到16:00，一周大概会有30个工时。我的supervisor是我的manager Chris。）</span> </label>
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
				<label>住宿条件，<span>请说明（例如，这是雇主提供的员工宿舍，我和同岗位的张三共住一个公寓中的一个房间，一个月每人200刀，不包水、电、网。同公寓中还有三名优势项目的中国女孩，
				2名德国交流学生和一名俄罗斯交流学生。从住处到工作地步行10分钟就能到。）
				</span> </label>
				<div class="clearfix">
					<textarea name="data[Profile][accom_conditions]" title="请填写住宿条件信息" class="tooltip autogrow"
						placeholder="住宿条件…"></textarea>
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
