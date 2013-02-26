<div class="flat_area grid_16">
	<h2>公司公告列表</h2>
</div>
<div class="box grid_16">
	<h2 class="box_head grad_blue">所有公告</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">					
			<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
			?>
			<div class="block">
				<table class="static"> 
					<thead> 
						<tr> 
							<th>编号</th>
							<th>公告标题</th> 
							<th>发布对象</th> 
							<th>截止日期</th>
							<th>状态</th>
							<th>点击数</th> 
						</tr> 
					</thead> 
					<tbody>
						<?php 
							$audiences = array('任何人可见','仅总监可见','仅销售部可见','仅运营部可见');
							$status = array('重要公告','一般公告');
							foreach ($data as $value) {
								echo '<tr><td>',$value['Announcement']['id'],'</td>';
								echo '<td>',$this->Html->link($value['Announcement']['name'],array('controller'=>'Announcements','action'=>'view_detail',$value['Announcement']['id'])),'</td>';
								echo '<td>',$audiences[$value['Announcement']['audience']],'</td>';
								echo '<td>',$value['Announcement']['deadline'],'</td>';
								echo '<td>',$status[$value['Announcement']['important']],'</td>';
								echo '<td>',$value['Announcement']['hits'],'</td></tr>';
							}
						?>
					</tbody>
				</table>
				<?php 
					echo $this->element('pagination_bar');
				?>
			</div>
		</div>
</div>