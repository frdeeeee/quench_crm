<div class="flat_area grid_16">
	<h2>我的团队信息</h2>
</div>
<div class="box grid_16">
	<div class="block">	
		<table class="static"> 
			<thead> 
				<tr>
					<th>团队名称</th> 
					<th>最后一次调整</th>
					<th>负责人</th> 
					<th>团队成员</th> 
				</tr>
			</thead> 
			<tbody>
				<?php 
					foreach ($data as $value) {
					?>
					<tr> 
						<td><?php echo $value['Group']['name']?></td>
						<td><?php echo $value['Group']['modified']?></td>
						<td><?php echo $value['Leader']['name']?></td>
						<td><?php
							foreach ($value['GroupUser'] as $v){
								echo $v['User']['name'],'&nbsp;&nbsp;';
							}
						?></td>
					</tr>
					<?php
					}
				?>
				
			</tbody>
		</table>
	</div>
</div>