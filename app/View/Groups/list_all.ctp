<div class="flat_area grid_16">
	<h2>用户组管理</h2>
</div>
<div class="box grid_16">
	<h2 class="box_head grad_green">添加新的用户组</h2>
	<a href="#" class="grabber"></a> <a href="#" class="toggle toggle_closed"></a>
	<div class="toggle_container" style="display:none;">
		<?php 
			echo $this->Form->create(null,array('url'=>'/Groups/add'));
		?>
		<div class="block">
			<div class="columns clearfix">
				<div class="col_33">
					<div class="section">
						<?php 
							echo $this->Form->input('Group.name',array('label'=>'用户组名称：','div'=>false,'type'=>'text'));
						?>
					</div>
				</div>
				<div class="col_33">
					<div class="section">
						<?php 
							echo $this->Form->input('Group.group_leader',array('options'=>$leaders,'div'=>false,'label'=>false,'empty'=>'请选择该组的负责人'));
						?>
					</div>
				</div>
				<div class="col_33">
					<div class="section">
						<button class="magenta">添加新用户组</button>
					</div>
				</div>
			</div>
		</div>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
<div class="box grid_16">
	<div class="block">	
		<?php 
			if (isset($msg_type)) {
				echo $this->Msg->output( $msg_type,$this->Session->flash() );
			}
		?>
		<table class="static"> 
			<thead> 
				<tr> 
					<th>用户组名称</th> 
					<th>负责人</th> 
					<th>任务</th>
					<th>操作</th> 
				</tr> 
			</thead> 
			<tbody>
				<?php 
					foreach ($data as $value) {
						?>
						<tr> 
							<td><?php echo $value['Group']['name']; ?></td> 
							<td>
							<?php 
								echo '负责人: ',$value['Leader']['name'],', ';
								if (count($value['GroupUser'])==1) {
									echo '未分配组员。';
								}else{
									echo '组成员: ';
									foreach ($value['GroupUser'] as $v) {
										if ($v['user_id'] != $value['Leader']['id']) {
											echo $v['User']['name'].'&nbsp;';
										};
									}
								}
							?>
							</td> 
							<td>
							<?php 
								foreach ($value['Task'] as $v) {
									echo $v['name'],';';
								}
							?>
							</td>
							<td>
								<?php 
									echo $this->Html->link('创建任务',array('controller'=>'Tasks','action'=>'add',0,$value['Group']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
									echo $this->Html->link('工作记录',array('controller'=>'WorkingLogs','action'=>'list_all_by_group_id',$value['Group']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
									echo $this->Html->link('宣讲会',array('controller'=>'Presentations','action'=>'list_all_by_group_id',$value['Group']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
									echo $this->Html->link('报名数据',array('controller'=>'Enquiries','action'=>'list_all_by_group_id',$value['Group']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
									echo $this->Html->link('有效销售',array('controller'=>'Applicants','action'=>'list_all_by_group_id',$value['Group']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
									echo $this->Html->link('修改',array('controller'=>'Groups','action'=>'modify',$value['Group']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
									echo $this->Html->link('添加成员',array('controller'=>'Groups','action'=>'add_group_member',$value['Group']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
									echo $this->Html->link('删除成员',array('controller'=>'Groups','action'=>'remove_group_member',$value['Group']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
									if ($value['Group']['available']==1) {
										echo $this->Html->link('删除用户组',array('controller'=>'Groups','action'=>'remove',$value['Group']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
									}else{
										echo $this->Html->link('恢复用户组',array('controller'=>'Groups','action'=>'restore',$value['Group']['id'])),'&nbsp;&nbsp;&nbsp;&nbsp;';
									}
								?>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php 
	//echo $this->Html->script(array('DataTables/jquery.dataTables','adminica/adminica_datatables'));
?>