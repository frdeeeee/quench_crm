		<div class="flat_area grid_16">
			<h2>我收到的短消息</h2>
		</div>
<div class="box grid_16">
	<div class="block">	
		<table class="static"> 
					<thead> 
						<tr> 
							<th>日期</th> 
							<th>状态</th>
							<th>内容</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							if ($data) {
								foreach ($data as $value) {
									?>
							<tr>
								<td><?php echo $value['ShortMessage']['created'] ?></td>
								<td>
									<?php 
										if ($value['ShortMessage']['is_read']==0 ) {
											echo '<b style="color:red">未读</b>';
										}else{
											echo '<b style="color:green">已读</b>';
										}
									?>
								</td>
								<td width="70%"><?php 
										echo '<p>',$value['ShortMessage']['content'],'</p>';
								?></td>
								<td>
								<?php 
									 echo $this->Html->link('我知道了',array('controller'=>'Students','action'=>'mask_message_as_readed',$value['ShortMessage']['id'])),'&nbsp;&nbsp';
								?>
								</td>
							</tr>		
									<?php
								};
							}
						?>
					</tbody>
		</table>
		<?php echo $this->element('pagination_bar'); ?>
	</div>
</div>