<div class="flat_area grid_16">
	<h2>学生报名登记表统计</h2>
</div>
<?php 
	echo $this->element('search_forms/search_form_registration');
	echo $this->element('general/operation_shortcuts');
 ?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">报名登记表汇总</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">					
			<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
			?>
			<div class="block">
				<?php 
					echo $this->element('tables/list_all_removed');
					echo $this->element('pagination_bar');
				?>
			</div>
		</div>
</div>