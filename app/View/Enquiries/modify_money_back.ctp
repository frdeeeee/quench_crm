<div class="flat_area grid_16">
	<h2>返点费用表</h2>
	<p>学生姓名-<?php echo $data['Enquiry']['name']; ?>, 客户名称 - <?php echo $data['Customer']['name']; ?></p>
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
						echo $this->Form->input('MoneyReturn.id',array('type'=>'hidden','value'=>$data['MoneyReturn']['id']));
						echo $this->Form->input('MoneyReturn.task_id',array('type'=>'hidden','value'=>$data['Enquiry']['task_id']));
						echo $this->Form->input('MoneyReturn.customer_id',array('type'=>'hidden','value'=>$data['Customer']['id']));
						echo $this->Form->input('MoneyReturn.sum',array('label'=>false,'div'=>false,'value'=>$data['MoneyReturn']['sum']));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>付款日期</label>
				<div>
					<?php 
						echo $this->Form->input('MoneyReturn.paid_on',array('label'=>'','value'=>$data['MoneyReturn']['paid_on'],'div'=>false,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')-1)));
					?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>备注：</label>
				<div>
					<?php 
						echo $this->Form->input('MoneyReturn.comment',array('label'=>false,'div'=>false,'type'=>'textarea','value'=>$data['MoneyReturn']['comment']));
					?>
				</div>
		</fieldset>
		<input type="submit" class="short_message_btn" value="立即更新" />
				
		<?php 
			echo $this->Form->end();
		?>				
</div>