<?php 
	if ($current_user['department_id'] != SALES_DEPARTMENT) {
		//销售部的人不提供修改的功能
		echo $this->Html->script('ajax_utils/utils_applicants',false); 
	}
?>
<div class="flat_area grid_16">
	<h2><?php echo $data['Enquiry']['name']; ?>: 激活表数据</h2>
	<p>
		填写日期：<?php echo $data['Profile']['created'];  ?>，
		状态：<?php echo ($data['Profile']['status']==0)?'<b style="color:red">未激活</b>':'<b style="color:green">已激活</b>' ?>
	</p>
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
			<fieldset>
				<label>到达美国航班信息是否与电子行程单上一致，<span>请说明(例如：不一致，因天气原因航班晚点2小时到达，当时已通知了接机的雇主，
				以下是我新的航班详细信息：）</span> </label>
				<div class="clearfix">
					<p><?php echo $data['Profile']['itinerary_notes']; ?></p>
				</div>
			</fieldset>
			<fieldset>
				<label>是否激活外方后台SEVIS信息，<span>请说明（例如：我已激活外方后台SEVIS信息，正等待外方审核。/我已收到外方的邮件通知我激活成功。）</span> </label>
				<div class="clearfix">
					<p><?php echo $data['Profile']['sevis_notes']; ?></p>
				</div>
			</fieldset>
			<fieldset>
				<label>是否办社保号，<span>请说明（例如：已经在6月18日办理，据通知10个工作日内会寄到雇主处。/还没有办理，但是星期二雇主会带我们去统一办理）</span> </label>
				<div class="clearfix">
					<p><?php echo $data['Profile']['social_insu_notes']; ?></p>
				</div>
			</fieldset>
			<fieldset>
				<label>工作地点<span>请说明工作地点名称和详细地址（例如，我的雇主公司名是Pizza Hut - Manteo, 实际工作地址是204 Sir Walter 
				Raleigh Road, Manteo, NC, 邮编是27954。紧急联系电话是252-473-1546）</span> </label>
				<div>
					<p><?php echo $data['Profile']['job_location']; ?></p>
				</div>
			</fieldset>
			<fieldset>
				<label>工作内容，<span>请说明（例如，前三天我们进行了简单的新员工培训，现在我和其他三名同学负责FOOD PREP，每周1个休息日，
				根据最近的调班，我是11:00到16:00，一周大概会有30个工时。我的supervisor是我的manager Chris。）</span> </label>
				<div class="clearfix">
					<p><?php echo $data['Profile']['job_description']; ?></p>
				</div>
			</fieldset>
			<fieldset>
				<label>住宿地点<span>请说明住宿地点详细地址（例如，我住在504 Budleigh Street, Manteo, NC, 邮编是27954，房东叫Kim，联系电话是252-473-2107）</span> </label>
				<div>
					<p><?php echo $data['Profile']['accommodation']; ?></p>
				</div>
			</fieldset>
			<fieldset>
				<label>住宿条件，<span>请说明（例如，这是雇主提供的员工宿舍，我和同岗位的张三共住一个公寓中的一个房间，一个月每人200美元，不包水、电、网。同公寓中还有三名优势项目的中国女孩，
				2名德国交流学生和一名俄罗斯交流学生。从住处到工作地步行10分钟就能到。）
				</span> </label>
				<div class="clearfix">
					<p><?php echo $data['Profile']['accom_conditions']; ?></p>
				</div>
			</fieldset>
		</div>
	</div>
</div>