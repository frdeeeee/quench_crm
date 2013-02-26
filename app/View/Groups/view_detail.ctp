<div class="flat_area grid_16">
		<h2>用户组资料</h2>
		<?php //pr($data); ?>
		<?php 
			if (isset($msg_type)) {
				echo $this->Msg->output( $msg_type,$this->Session->flash() );
			}
			//pr($data);
		?>
</div>
<div class="box grid_16">
	<h2 class="box_head">用户组名称:<?php echo $data['Group']['name']?></h2>
	<a href="#" class="grabber"></a>
	<a href="#" class="toggle"></a>
	<div class="toggle_container">
		<div class="block">
		<div class="columns clearfix">
								<div class="col_33">
									<div class="section">
										<p>负责人：<?php echo $data['Leader']['name']; ?></p>
									</div>
								</div>
								<div class="col_60">
									<div class="section">
										<p>成员：
										<?php 
											foreach ($data['GroupUser'] as $value) {
												echo $value['User']['name'],'&nbsp;&nbsp;';
											}
										?>
										</p>
									</div>
								</div>
		</div>
		</div>
	</div>
	
</div>

<div class="box grid_16">
	<h2 class="box_head">宣讲会统计</h2>
	<a href="#" class="grabber"></a>
	<a href="#" class="toggle"></a>
	<div class="toggle_container">
		<?php 
			if (!empty($data['Presentation'])) {
				foreach ($data['Presentation'] as $value) {
					?>
					<div class="block">
					<div class="section">
						<p>
						在<?php echo $value['hold_on']?>于<?php echo $value['Customer']['name'] ?>举办了一次宣讲会。参加的人数为<?php echo $value['arrived_number']?>，
						现场报名人数为<?php echo $value['regist_number']?>。
						<?php echo $this->Html->link('了解详情',array('controller'=>'Presentations','action'=>'view_detail',$value['id'])); ?>
						</p>
					</div>
					</div>
					<?php
				};
			}
		?>
	</div>
</div>