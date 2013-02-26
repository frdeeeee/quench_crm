<div class="flat_area grid_16">
		<h2>客户资料</h2>
		<?php 
			if (isset($msg_type)) {
				echo $this->Msg->output( $msg_type,$this->Session->flash() );
			}
		?>
</div>
<div class="box grid_16">
	<h2 class="box_head">客户名称:<?php echo $data['Customer']['name']?></h2>
	<a href="#" class="grabber"></a>
	<a href="#" class="toggle"></a>
	<div class="toggle_container">
		<div class="block">
		<div class="columns clearfix">
								<div class="col_25">
									<div class="section">
										<p>地区：<?php echo $data['Province']['name'],',',$data['Customer']['city']; ?></p>
									</div>
								</div>
								<div class="col_25">
									<div class="section">
										<p>类别：<?php echo $data['CustomerType']['name']?></p>
									</div>
								</div>
								<div class="col_25">
									<div class="section">
										<p>返点金额：第一次<?php echo $data['Customer']['money_return_sum1']?>元，第二次<?php echo $data['Customer']['money_return_sum2']?>元</p>
									</div>
								</div>
								<div class="col_25">
									<div class="section">
										<p>创建者：<?php echo $data['User']['name']?></p>
									</div>
								</div>
		</div>
		<div class="columns clearfix">
								<div class="col_60">
									<div class="section">
										<p>备注：<?php echo $data['Customer']['comments']?></p>
									</div>
								</div>
								<div class="col_40">
									<div class="section">
										<p>
										<?php 
											echo $this->Html->link('修改客户资料',array('controller'=>'Customers','action'=>'modify',$data['Customer']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
											echo $this->Html->link('添加新的联系人',array('controller'=>'Contacts','action'=>'add',$data['Customer']['id']));
										?>
										</p>
									</div>
								</div>
		</div>
		</div>
	</div>
	
</div>
<?php 
	foreach ($data['Contact'] as $value) {
		?>
		<div class="box grid_8">
					<h2 class="box_head grad_blue"><?php echo $value['name']?></h2>
					<a href="#" class="grabber"></a>
					<a href="#" class="toggle"></a>
					<div class="toggle_container">					
						<div class="block">
							<div class="col_33">
									<div class="section">
										<p>工作部门：<?php echo $value['department']?></p>
									</div>
							</div>
							<div class="col_33">
									<div class="section">
										<p>上级领导：<?php echo $value['manager']?></p>
									</div>
							</div>
							<div class="col_33">
									<div class="section">
										<p>手机：<?php echo $value['mobile']?></p>
									</div>
							</div>
							<div class="col_50">
									<div class="section">
										<p>办公室：<?php echo $value['office']?></p>
									</div>
							</div>
							<div class="col_50">
									<div class="section">
										<p>传真：<?php echo $value['fax']?></p>
									</div>
							</div>
							<div class="col_50">
									<div class="section">
										<p>电子邮件：<?php echo $value['email']?></p>
									</div>
							</div>
							<div class="col_50">
									<div class="section">
										<p>
										</p>
									</div>
							</div>
							<div class="col_50">
									<div class="section">
										<p>
										<?php
											echo $this->Html->link('修改联系人资料',array('controller'=>'Contacts','action'=>'modify',$value['id'],$value['customer_id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
											echo $this->Html->link('删除该联系人',array('controller'=>'Contacts','action'=>'remove',$value['id'],$value['customer_id']));
										?>
										</p>
									</div>
							</div>
						</div>
					</div>
		</div>		
		<?php
	}
?>