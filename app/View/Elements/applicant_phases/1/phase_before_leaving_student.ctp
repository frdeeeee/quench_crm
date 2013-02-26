<div class="block"  id="app_itineray_form">
	<?php //pr($itinerary); ?>
	<div class="columns clearfix">
					<div class="col_66">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.depart_datetime',
									array(
										'default'=>(isset($itinerary['ApplicantItinerary']['depart_datetime']))?$itinerary['ApplicantItinerary']['depart_datetime']:'',
										'label'=>'从中国出发时间：','before'=>'<div class="cake_input_datetime" name="depart_datetime">','after'=>'</div>'));
						   ?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.depart_city',
									array('default'=>(isset($itinerary['ApplicantItinerary']['depart_city']))?$itinerary['ApplicantItinerary']['depart_city']:'','label'=>'从中国出发城市：','id'=>'depart_city'));
						   ?>
						</div>
					</div>
	</div>
	<div class="columns clearfix">
					<div class="col_66">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.arrive_datetime',
									array('value'=>(isset($itinerary['ApplicantItinerary']['arrive_datetime']))?$itinerary['ApplicantItinerary']['arrive_datetime']:'',
									'label'=>'到达美国时间：','before'=>'<div class="cake_input_datetime" name="arrive_datetime">','after'=>'</div>'));
						   ?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.arrive_city',
									array('value'=>(isset($itinerary['ApplicantItinerary']['arrive_city']))?$itinerary['ApplicantItinerary']['arrive_city']:'','label'=>'到达美国的第一个城市：','id'=>'arrive_city'));
						   ?>
						</div>
					</div>
	</div>
	<div class="columns clearfix">
					<div class="col_25">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_company_go',
									array('value'=>(isset($itinerary['ApplicantItinerary']['air_company_go']))?$itinerary['ApplicantItinerary']['air_company_go']:'','label'=>'去程航空公司：','id'=>'air_company_go'));
						   ?>
						</div>
					</div>
					<div class="col_25">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_code_go',
									array('value'=>(isset($itinerary['ApplicantItinerary']['air_code_go']))?$itinerary['ApplicantItinerary']['air_code_go']:'','label'=>'去程航班号：','id'=>'air_code_go'));
						   ?>
						</div>
					</div>
					<div class="col_50">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.is_pick_up',
									array('value'=>(isset($itinerary['ApplicantItinerary']['is_pick_up']))?$itinerary['ApplicantItinerary']['is_pick_up']:'','label'=>'雇主是否来接，如不来接是否提供指示：','id'=>'is_pick_up'));
						   ?>
						</div>
					</div>
	</div>
	
	<div class="columns clearfix">
		<fieldset class="label_side">
			<label>到达雇主处的方式</label>
				<div>
					<?php 
						echo $this->Form->input('ApplicantItinerary.how_to_meet',
												array(
													'label'=>'',
													'class'=>'tooltip autogrow',
													'title'=>'填写请细致，如预定了火车、巴士请注明时间。如城市间转乘飞机请注明航班号；出发、到达城市；出发、到达时间',
													'placeholder'=>'点击开始输入',
													'type'=>'textarea',
													'div'=>false,
													'value'=>(isset($itinerary['ApplicantItinerary']['how_to_meet']))?$itinerary['ApplicantItinerary']['how_to_meet']:'',
													'id'=>'how_to_meet'
												)
					);
				?>
			</div>
		</fieldset>
	</div>
	
	<div class="columns clearfix">
					<div class="col_66">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_arrive_date',
									array('default'=>(isset($itinerary['ApplicantItinerary']['return_arrive_date']))?$itinerary['ApplicantItinerary']['return_arrive_date']:'',
									'label'=>'回程到达日期（当地）：','before'=>'<div class="cake_input_date" name="return_arrive_date">','after'=>'</div>'));
						   ?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_depart_city',
									array('value'=>(isset($itinerary['ApplicantItinerary']['return_depart_city']))?$itinerary['ApplicantItinerary']['return_depart_city']:'',
									'label'=>'回程出发城市：','id'=>'return_depart_city'));
						   ?>
						</div>
					</div>
	</div>
	
	<div class="columns clearfix">
					<div class="col_33">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.return_arrive_city',
									array('value'=>(isset($itinerary['ApplicantItinerary']['return_arrive_city']))?$itinerary['ApplicantItinerary']['return_arrive_city']:'',
									'label'=>'回程抵达城市：','id'=>'return_arrive_city'));
						   ?>
						</div>
					</div>
					<div class="col_33">
						<div class="section">
							<?php
								echo $this->Form->input(
									'ApplicantItinerary.air_code_return',
									array('value'=>(isset($itinerary['ApplicantItinerary']['air_code_return']))?$itinerary['ApplicantItinerary']['air_code_return']:'',
									'label'=>'回程航班号：','id'=>'air_code_return'));
						   ?>
						</div>
					</div>
					
					<div class="col_33">
						<div id="modify_app_itinerary_btn" class="short_message_btn">修改行程单</div>
						<div id="save_app_itinerary_btn" class="short_message_btn">保存行程单</div>
					</div>
	</div>
<!--  -->
</div>