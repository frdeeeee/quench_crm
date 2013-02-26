		<div class="flat_area grid_16">
			<h2>Meeting Agenda</h2>
		</div>
		<div class="box grid_16 tabs">
						<div id="tabs-1" class="block">
							<div class="box grid_16">
									<fieldset class="label_side">
										<label>Participants</label>
										<div>
											Host：<?php echo $data['Sponsor']['name']; ?>, invited：
											<?php 
												foreach ($data['MeetingUser'] as $value) {
													echo $value['User']['name'],'&nbsp;&nbsp;';
												}
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Subject</label>
										<div>
											<?php 
												echo $data['Meeting']['name'];
											?>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Location</label>
										<div>
											<?php 
												echo $data['Meeting']['location'];
											?>
										</div>
									</fieldset>
									
									<fieldset class="label_side">
										<label>Time</label>
										<div>
											<?php 
												echo $data['Meeting']['hold_on'];
											?>
										</div>
									</fieldset>
									
									<fieldset class="label_side">
										<label>Summary</label>
										<div>
											<?php 
												echo $data['Meeting']['agenda'];
											?>
										</div>
									</fieldset>
							</div>
					</div>
		</div>