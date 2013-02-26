<div class="flat_area grid_16">
	<h2>我的Check-in</h2>
	<?php 
		if (count($data)==0) {
			?>
			<p style="color: red">您还从未Check-In，请尽快添加您的Check-In纪录</p>
			<?php
		}else{
			?>
			<p>您上次Check-In是在<?php echo $data[0]['Checkin']['created']?>，距离下次Check-In还有<b style="color: red"><?php 
				echo 30- round( (time() - strtotime($data[0]['Checkin']['created']))/(1000*60*60*24),0);
			?></b>天</p>
			<?php
		}
	?>
</div>
<?php 
	echo $this->element('general/student_shortcuts');
?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">Check-in表格</h2>
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
							<th>说明</th>
						</tr> 
					</thead> 
					<tbody>
						<?php
							foreach ($data as $value) {
								?>
								<tr>
									<td>
									<?php echo $this->Html->link($value['Checkin']['created'].'的Check-in纪录',array('url'=>'#')); ?>
									</td>
								</tr>
								<?php
							}
						?>
					</tbody>
			</table>
		</div>
	</div>
</div>