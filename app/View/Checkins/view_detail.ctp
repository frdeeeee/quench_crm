<?php 
	echo $this->Html->script('ajax_utils/utils_students',false); 
?>
<div class="flat_area grid_16">
	<h2>学生姓名：<?php echo $data['Enquiry']['name']?></h2>
	<?php 
		if (count($data)==0) {
			?>
			<p style="color: red">您还从未Check-In，请尽快添加您的Check-In纪录</p>
			<?php
		}else{
			?>
			<p>上次Check-In是在<?php echo $data['Checkin']['created']?>，距离下次Check-In还有<b style="color: red"><?php 
				echo 30- round( (time() - strtotime($data['Checkin']['created']))/(1000*60*60*24),0);
			?></b>天</p>
			<?php
		}
		//pr($data);
	?>
	<p>Checkin时间：<?php echo $data['Checkin']['created']?></p>
</div>
<?php 
	//echo $this->element('general/student_shortcuts');
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
			<fieldset>
				<label>工作地点<span>如变更请填写新的地址</span> </label>
				<div class="clearfix">
						<?php 
						echo '<p>',$changed_options[$data['Checkin']['is_job_location_changed']],'</p>';
						if ($data['Checkin']['is_job_location_changed']==1) {
							echo '<p>',$data['Checkin']['new_job_location'],'</p>';
						}
						?>
				</div>
			</fieldset>
			
			<fieldset>
				<label>工作内容<span>请说明</span> </label>
				<div class="clearfix">
					<?php echo '<p>',$data['Checkin']['job_description'],'</p>'; ?>
				</div>
			</fieldset>
			<fieldset>
				<label>住宿地点<span>如变更请填写新的地址</span> </label>
				<div class="clearfix">
						<?php 
						echo '<p>',$changed_options[$data['Checkin']['is_accom_changed']],'</p>';
						if ($data['Checkin']['is_accom_changed']==1) {
							echo '<p>',$data['Checkin']['new_accom'],'</p>';
						}
						?>
				</div>
			</fieldset>
			<fieldset>
				<label>住宿条件<span>如变更请填写新的说明</span> </label>
				<div class="clearfix">
						<?php 
						echo '<p>',$changed_options[$data['Checkin']['accom_cond_changed']],'</p>';
						if ($data['Checkin']['accom_cond_changed']==1) {
							echo '<p>',$data['Checkin']['new_accom_cond'],'</p>';
						}
						?>
				</div>
			</fieldset>
			
			<h2 class="section">项目反馈</h2>
			
			<fieldset>
				<label>生活方面有何问题？<span>请说明</span> </label>
				<div class="clearfix">
					<?php echo '<p>',$data['Checkin']['living_notes'],'</p>'; ?>
				</div>
			</fieldset>
			<fieldset>
				<label>工作方面有何问题?<span>请说明</span> </label>
				<div>
					<?php echo '<p>',$data['Checkin']['job_notes'],'</p>'; ?>
				</div>
			</fieldset>
			<fieldset>
				<label>是否参加文化交流活动？<span>请说明</span> </label>
				<div class="clearfix">
					<?php 
						if ($data['Checkin']['is_social']==1) {
							echo '<p>有参加</p>'; 
						}else{
							echo '<p>没有参加</p>';
						}
					?>
				</div>
			</fieldset>
			<fieldset>
				<label>文化交流活动1的描述，<span>请说明</span> </label>
				<div class="clearfix">
					<?php echo '<p>',$data['Checkin']['social_desc_1'],'</p>'; ?>
				</div>
			</fieldset>
			<fieldset>
				<label>文化交流活动2的描述，<span>请说明</span> </label>
				<div class="clearfix">
					<?php echo '<p>',$data['Checkin']['social_desc_2'],'</p>'; ?>
				</div>
			</fieldset>
			<fieldset>
				<label>对项目有何感受或建议，<span>（不少于300字）</span> </label>
				<div class="clearfix">
					<?php echo '<p>',$data['Checkin']['comments'],'</p>'; ?>
				</div>
			</fieldset>
		</div>
	</div>
</div>