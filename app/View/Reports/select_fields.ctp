<?php echo $this->Html->script('ajax_utils/utils_report_export',false); ?>
<div class="flat_area grid_16">
	<h2 class="section">自助报表生成工具</h2>
</div>
<div class="box grid_16">
	<div id="export_enq_btn" class="short_message_btn">
		生成并下载表格
	</div>
	<div id="save_query_fields_btn" class="short_message_btn">
		保存此报表
	</div>
	<div class="clear"></div>
	<div style="display: none" id="temp_useful_url_name_wrapper" class="block">
		<fieldset>
				<label>报表名称</label>
				<div>
					<input name="temp" id="temp_useful_url_name" title="请填写针对要保存的报表的名字"
						class="tooltip right" type="text" style="float: left">
					<div id="submit_query_fields_btn" class="short_message_btn">提交</div>
				</div>
		</fieldset>
	</div>
</div>

<?php echo $this->Form->create(NULL); ?>
<div class="box grid_16 round_all">
	<h2 class="box_head grad_navy">学生报名表</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		<div class="block">
				<fieldset>
					<p>&nbsp;</p>
						<div>
							<?php 
							echo $this->Form->input('useful_url_name',array('type'=>'hidden','value'=>'未知','name'=>'data[useful_url_name]'));
echo $this->Form->input(
		'enq_fields',
		array('options'=>$enquiry_fields,'class'=>'multisorter indent','multiple'=>'multiple','label'=>'','div'=>FALSE)
);
							?>
						</div>
				</fieldset>
		</div>
	</div>
</div>

<div class="box grid_16 round_all">
	<h2 class="box_head grad_navy">申请人信息表</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		<div class="block">
				<fieldset>
					<p>&nbsp;</p>
						<div>
							<?php 
echo $this->Form->input(
		'app_fields',
		array('options'=>$app_fields,'class'=>'multisorter indent','multiple'=>'multiple','label'=>'','div'=>FALSE)
);
							?>
						</div>
				</fieldset>
		</div>
	</div>
</div>

<div class="box grid_16 round_all">
	<h2 class="box_head grad_navy">申请人安置情况</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		<div class="block">
				<fieldset>
					<p>&nbsp;</p>
						<div>
							<?php 
echo $this->Form->input(
		'app_job_fields',
		array('options'=>$app_job_fields,'class'=>'multisorter indent','multiple'=>'multiple','label'=>'','div'=>FALSE)
);
							?>
						</div>
				</fieldset>
		</div>
	</div>
</div>

<div class="box grid_16 round_all">
	<h2 class="box_head grad_navy">申请人签证情况</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		<div class="block">
				<fieldset>
					<p>&nbsp;</p>
						<div>
							<?php 
echo $this->Form->input(
		'app_visa_fields',
		array('options'=>$app_visa_fields,'class'=>'multisorter indent','multiple'=>'multiple','label'=>'','div'=>FALSE)
);
							?>
						</div>
				</fieldset>
		</div>
	</div>
</div>

<div class="box grid_16 round_all">
	<h2 class="box_head grad_navy">申请人行程表</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		<div class="block">
				<fieldset>
					<p>&nbsp;</p>
						<div>
							<?php 
echo $this->Form->input(
		'app_itinerary_fields',
		array('options'=>$app_itinerary_fields,'class'=>'multisorter indent','multiple'=>'multiple','label'=>'','div'=>FALSE)
);
							?>
						</div>
				</fieldset>
		</div>
	</div>
</div>
<?php 
	echo $this->Form->end(); 
?>		