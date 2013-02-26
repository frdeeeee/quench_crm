<?php 
	echo $this->Html->script('fullcalendar/fullcalendar.min',false); 
	echo $this->Html->script('fullcalendar/gcal',false); 
	echo $this->Html->script('adminica/adminica_calendar',false); 
?>
<div class="flat_area grid_16">
	<?php 
		if (isset($msg_type)) {
			echo $this->Msg->output( $msg_type,$this->Session->flash() );
		}
	?>
	<h2>Project Name: <?php echo $data['Project']['name']; ?></h2>
	<p><b>Project Created On: </b><?php echo $data['Project']['created']?></p>
	<p><b>Project Summary: </b>
	<?php echo $data['Project']['comments']?>
	</p>
	<div style="display: none;" id="project_id"><?php echo $data['Project']['id']; ?></div>
</div>

<div class="box grid_13">
	<h2 class="box_head">Project Routine</h2>
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

				<div class="box grid_3">
					<h2 class="box_head">Projects</h2>
					<div class="block" style="overflow:visible">						
					<ul class="flat_large">
						<?php 
							foreach ($projects as $key=>$value) {
								?>
								<li><?php echo $this->Html->link($value,array('controller'=>'Projects','action'=>'view_detail',$key)); ?></li>
								<?php
							}
						?>
					</ul>
				</div>
					
</div>
<div id="day_tasks_tool_box_wrapper" class="actions_box">
	<div class="action_btn">
		<?php echo $this->Html->link('Add New Task',array('controller'=>'Tasks','action'=>'add',$data['Project']['id'])); ?>
	</div>
	<div class="action_btn">
		<?php echo $this->Html->link('Set up a meeting',array('controller'=>'Meetings','action'=>'add')); ?>
	</div>
</div>
<div id="event_tool_box_wrapper" class="actions_box">
</div>