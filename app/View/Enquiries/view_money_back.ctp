<div class="flat_area grid_16">
	<h2>返点费用记录详情</h2>
</div>
<div class="box grid_16">
	<?php 
	echo $this->Html->link('返回返点纪录表',array('controller'=>'Enquiries','action'=>'list_money_return'),array('class'=>'short_message_btn'));
	?>
</div>
<div class="box grid_16">
	<?php 
		foreach ($data as $key=>$value){
			?>
			<div class="box grid_8">
				<h2 class="box_head grad_blue">第<?php echo count($data)-$key; ?>次返点</h2>
				<a href="#" class="grabber"></a>
				<a href="#" class="toggle"></a>
				<div class="toggle_container">
					<div class="block">
						<fieldset>
						<p>客户名称：<?php echo $value['Customer']['name']?></p>
						<p>学生姓名：<?php echo $value['Enquiry']['name']?></p>
						<p>返点时间：<?php echo $value['MoneyReturn']['paid_on']?>, 返点金额：<?php echo $value['MoneyReturn']['sum'] ?></p>
						<p>备注：<?php echo $value['MoneyReturn']['comment']?></p>
						<?php 
							echo $this->Html->link('修改',array('controller'=>'Enquiries','action'=>'modify_money_back',$value['MoneyReturn']['id']),array('class'=>'short_message_btn'));
							echo $this->Html->link('删除',array('controller'=>'Enquiries','action'=>'remove_money_back',$value['MoneyReturn']['id']),array('class'=>'short_message_btn'));
						?>
						</fieldset>
					</div>
				</div>
			</div>
			<?php
		}
	?>
</div>