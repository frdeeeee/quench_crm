<table class="static"> 
					<thead> 
						<tr> 
							<th>姓名</th> 
							<th>学校</th> 
							<th>年级</th>
							<th>专业</th>
							<th>手机</th> 
							<th>邮箱</th> 
							<th>项目</th> 
							<th>渠道</th> 
							<th>备注</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							foreach ($data as $value) {
								echo '<tr><td>',$value['Enquiry']['name'],'</td>';
								echo '<td>',$value['Enquiry']['school'],'</td>';
								echo '<td>',$value['Enquiry']['grade'],'</td>';
								echo '<td>',$value['Enquiry']['major'],'</td>';
								echo '<td>',$value['Enquiry']['mobile'],'</td>';
								echo '<td>',$value['Enquiry']['email'],'</td>';
								echo '<td>',$value['Project']['name'],'</td>';
								echo '<td>',$value['Source']['name'],'</td>';
								echo '<td>',$value['Enquiry']['comments'],'</td>';
								echo '<td>'.$this->Html->link('恢复',array('controller'=>'Enquiries','action'=>'restore',$value['Enquiry']['id'])).'</td></tr>';
							}
						?>
					</tbody>
				</table>