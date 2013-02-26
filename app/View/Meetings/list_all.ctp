<?php 
	echo $this->Html->script('fullcalendar/fullcalendar.min',false); 
	echo $this->Html->script('fullcalendar/gcal',false); 
	echo $this->Html->script('adminica/adminica_calendar',false); 
?>
<div class="flat_area grid_16">
	<h2>Meetings Schedule</h2>
	<?php 
		if (isset($msg_type)) {
			echo $this->Msg->output( $msg_type,$this->Session->flash() );
		}
	?>
</div>

<div class="box grid_16">
	<h2 class="box_head">Meetings of the month</h2>
		<a href="#" class="grabber">&nbsp;</a>
		<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">					
						<div class="block">
							<div class="section">
								<div id="calendar">&nbsp;</div>
							</div>
						</div>
					</div>
</div>
					
</div>
<div id="day_tasks_tool_box_wrapper" class="actions_box">
	<div class="action_btn">
		<?php echo $this->Html->link('Set up a meeting',array('controller'=>'Meetings','action'=>'add')); ?>
	</div>
</div>
<div id="event_tool_box_wrapper" class="actions_box">
</div>
