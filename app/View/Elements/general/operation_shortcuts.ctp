<div class="box grid_16">
	<?php 
	echo $this->Html->link('添加学生报名登记',
		array('controller'=>'Enquiries','action'=>'add'),
		array('class'=>'short_message_btn')); 
	?>
	<a id="load_multi_sms_send_form_btn" class="short_message_btn" href="#sms_send_all_selected_form">
			群发短信
	</a>
	<a id="export_selected_emails_btn" class="short_message_btn" href="#shortcuts_content">
		导出邮件地址
	</a>
	<a id="export_selected_mobiles_btn" class="short_message_btn" href="#shortcuts_content">
		导出手机号码
	</a>
	<div id="export_to_excel_file" class="short_message_btn">
		导出Excel文件
	</div>
	<?php 
		if($current_user['role_id']==OPERATION){
			?>
			<a id="assign_students_to_operation_assistant_btn" class="short_message_btn" href="#assign_students_to_operation_assistant_form">
				分配任务
			</a>
			<p></p>
			<?php
			if ($not_assign_number==0) {
				echo '<p style="margin-top:16px;">所有学生已经分配完毕。</p>';
			}else{
				echo '<p style="margin-top:16px;">还有<b style="color:red">'.$not_assign_number.'</b>个学生还没有指定运营老师。</p>';
			}
			echo $this->element('fancy_forms/assign_students_to_operation_assistant_form');
		}
	?>
	
	<?php 
		echo $this->element('general/send_multi_sms_form'); 
	?>
</div>
