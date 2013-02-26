<div style="display:none">
	<div id="applicant_cancel_form" style="width:700px;height:550px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		取消报名人<span id="cancel_app_name" style="color: red"></span>的申请
		<?php echo $this->Html->image('ajax_refresh.gif',array('style'=>'margin-top:-15px;float:right;display:none;','id'=>'icon_email_sending_refresh')); ?>&nbsp;
		</h2>
		<?php 
			echo $this->Form->create('Applicant',array('url'=>'/Applicants/cancel'));
			echo $this->Form->input('Enquiry.id',array('type'=>'hidden'));
		?>
		<fieldset class="label_side">
			<label>退款金额</label>
				<div>
					<?php 
						echo $this->Form->input('Enquiry.cancel_fee',array('label'=>'','div'=>false,'type'=>'text'));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>退款收据编号</label>
				<div>
					<?php 
						echo $this->Form->input('Enquiry.cancel_fee_receipt',array('label'=>'','div'=>false));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>退款方式</label>
				<div>
					<?php 
						echo $this->Form->input('Enquiry.cancel_fee_type',array('label'=>'','div'=>false,'options'=>$fee_types));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>退款日期</label>
				<div>
					<?php 
						echo $this->Form->input('Enquiry.cancel_fee_date',array('label'=>'','div'=>false));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>退款申请书是否签字提交</label>
				<div>
					<?php 
						echo $this->Form->input('Enquiry.cancel_fee_form_status',array('label'=>'','div'=>false,'options'=>array(0=>'否',1=>'是')));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>取消申请的原因</label>
				<div>
					<?php 
						echo $this->Form->input('Enquiry.cancel_fee_reason',array('label'=>'','div'=>false,'type'=>'textarea'));
					?>
				</div>
		</fieldset>
		<input type="submit" class="short_message_btn" value="确认取消" />
		<?php echo $this->Form->end();?>
	</div>
</div>