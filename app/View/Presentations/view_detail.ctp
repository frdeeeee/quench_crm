<div class="flat_area grid_16">
	<h2>宣讲会登记表</h2>
</div>
<div class="box grid_16">
					<h2 class="box_head">客户信息</h2>
					<a href="#" class="grabber"></a>
					<a href="#" class="toggle"></a>
					<div class="toggle_container">					
						<div class="block">
							<div class="columns clearfix">
								<div class="col_50">
									<div class="section">
										<p>宣讲会预定日期：<?php echo $data['Presentation']['hold_on']?></p>
									</div>
								</div>
								<div class="col_50">
									<div class="section">
										<p>学校：<?php echo $data['Customer']['name']?></p>
									</div>
								</div>
							</div>
							<div class="columns clearfix">
								<div class="col_33">
									<div class="section">
										<p>宣讲会预定主讲人：<?php echo $data['Presentation']['speaker']?></p>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
										<p>负责人：<?php echo $data['Presentation']['manager']?></p>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
										<p>互动学生：<?php echo $data['Presentation']['student_name']?></p>
									</div>
								</div>
							</div>
							<div class="columns clearfix">
								<div class="col_33">
									<div class="section">
										<p>学校联系人：<?php echo $data['Presentation']['contact_name']?></p>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
										<p>部门：<?php echo $data['Presentation']['dept_name']?></p>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
										<p>电话：<?php echo $data['Presentation']['contact_phone']?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
</div>
<div class="box grid_16">
			<h2 class="box_head grad_blue">项目信息</h2>
					<a href="#" class="grabber"></a>
					<a href="#" class="toggle"></a>
					<div class="toggle_container">	
						<div class="block">
							<div class="block" style="opacity: 1;">
								<div class="section">
										<p>项目:<?php 
											$projs = '';
											if (strlen($data['Presentation']['projects'])==1) {
												$projs = $projects[$data['Presentation']['projects']];
											}elseif (strlen($data['Presentation']['projects'])>1){
												$temp = explode(',', $data['Presentation']['projects']);
												foreach ($temp as $v) {
													if ($v) {
														$projs .= $projects[$v].',';
													}
												}
											}
											echo $projs;
										?></p>
								</div>
							</div>
							<div class="block" style="opacity: 1;">
								<div class="section">		
										<p>项目:<?php 
											$projs = '';
											if (strlen($data['Presentation']['channels'])==1) {
												$projs = $channels[$data['Presentation']['projects']];
											}elseif (strlen($data['Presentation']['channels'])>1){
												$temp = explode(',', $data['Presentation']['projects']);
												foreach ($temp as $v) {
													if ($v) {
														$projs .= $channels[$v].',';
													}
												}
											}
											echo $projs;
										?></p>
								</div>
							</div>
						</div>
				</div>
</div>

<div class="box grid_16">
					<h2 class="box_head grad_magenta">宣讲会进行情况</h2>
					<a href="#" class="grabber"></a>
					<a href="#" class="toggle"></a>
					<div class="toggle_container">					
						<div class="block">
							<div class="columns clearfix">
								<div class="col_33">
									<div class="section">
										<p>到场人数：<?php echo $data['Presentation']['arrived_number']?></p>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
										<p>报名人数：<?php echo $data['Presentation']['regist_number']?></p>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
										<p>考试日期：<?php echo $data['Presentation']['exam_date']?></p>
									</div>
								</div>
							</div>
							<div class="block" style="opacity: 1;">
								<div class="section">
									<p>宣讲会情况: <?php echo $data['Presentation']['summary']?></p>
								</div>
							</div>
							<div class="block" style="opacity: 1;">
								<div class="section">
									<p>需改进及建议: <?php echo $data['Presentation']['comments']?></p>
								</div>
							</div>
						</div>
					</div>
</div>