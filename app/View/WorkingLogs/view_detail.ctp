<div class="flat_area grid_16">
	<h2>My Task</h2>
</div>

<div class="box grid_16">
	<h2 class="box_head grad_green">Task's detail</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">
			<?php //pr($data); ?>
			<div class="block" style="opacity: 1;">
				<div class="section">
					<p><b>Subject：</b><?php echo $data['WorkingLog']['name']?></p>
				</div>
			</div>
			<div class="block" style="opacity: 1;">
				<div class="section">
					<p><b>Created：</b><?php echo $data['WorkingLog']['created']?></p>
				</div>
			</div>
			<div class="block" style="opacity: 1;">
				<div class="section">
					<p><b>Content：</b><?php echo $data['WorkingLog']['content']?></p>
				</div>
			</div>
			<div class="block" style="opacity: 1;">
				<div class="section">
					<p><b>Result：</b><?php echo $data['WorkingLog']['result']?></p>
				</div>
			</div>
			<div class="block" style="opacity: 1;">
				<div class="section">
					<p><b>Pending issues：</b><?php echo $data['WorkingLog']['questions']?></p>
				</div>
			</div>
			<div class="block" style="opacity: 1;">
				<div class="section">
					<p><b>Next Appointment：</b><?php echo $data['WorkingLog']['next_appointment_date']?></p>
				</div>
			</div>
		</div>
</div>