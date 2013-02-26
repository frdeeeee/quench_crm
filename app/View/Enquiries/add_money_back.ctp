<div class="flat_area grid_16">
	<h2>返点费用表</h2>
	<p>学生姓名-<?php echo $data['Enquiry']['name']; ?>, 客户名称 - <?php echo $data['Customer']['name']; ?>, 第<?php echo count($data['MoneyReturn'])+1; ?>次返点</p>
			<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
			?>
</div>
<div class="box grid_16 tabs">
	<?php 
			echo $this->Form->create('MoneyReturn');
			//pr($data);
		?>
		<fieldset class="label_side">
			<label>请输入金额</label>
				<div>
					<?php 
						echo $this->Form->input('MoneyReturn.enquiry_id',array('type'=>'hidden','value'=>$data['Enquiry']['id']));
						echo $this->Form->input('MoneyReturn.task_id',array('type'=>'hidden','value'=>$data['Enquiry']['task_id']));
						echo $this->Form->input('MoneyReturn.customer_id',array('type'=>'hidden','value'=>$data['Customer']['id']));
						echo $this->Form->input('MoneyReturn.sum',array('label'=>false,'div'=>false,'value'=>'0'));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>付款日期</label>
				<div>
					<?php 
						echo $this->Form->input('MoneyReturn.paid_on',array('label'=>'','div'=>false,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1)));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>备注：</label>
				<div>
					<?php 
						echo $this->Form->input('MoneyReturn.comment',array('label'=>false,'div'=>false,'type'=>'textarea'));
					?>
				</div>
		</fieldset>
		<input type="submit" class="short_message_btn" value="立即保存" />
				
		<?php 
			echo $this->Form->end();
		?>				
</div>