<?php 
	//echo $this->Html->script('ajax_utils/send_multi_sms_utils',false); 
	//echo $this->Html->script('ajax_utils/send_emails_utils',false); 
?>
<div class="flat_area grid_16">
	<h2>返点费用记录表</h2>
</div>
<?php 
	//echo $this->element('search_forms/search_form_registration');
	//echo $this->element('general/operation_shortcuts');
?>
<div class="box grid_16">
	<h2 class="box_head grad_blue">返点费用记录</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">					
			<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
				//pr($data);
			?>
			<div class="block">
				<table class="static"> 
					<thead> 
						<tr> 
							<th>
								<?php 
								echo $this->Form->checkbox('select_all');//js会响应它的事件
								?>
							</th>
							<th>序号</th>
							<th>姓名</th> 
							<th>学校</th>
							<th>类别</th>
							<th>协议返点</th>
							<th>支付返点记录</th>
							<th>实际返点</th>
							<th>备注</th>
							<th>操作</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							$customer_type = array(1=>'学校',2=>'代理',3=>'自己报名');
							$index = 0;
							foreach ($data as $value) {
								echo '<tr><td>',$this->Form->checkbox('select_item_'.$value['Enquiry']['id'],array('class'=>'select_itmes','title'=>$value['Enquiry']['mobile'],'style'=>'height:11px;line-height:0px;margin:0px;')),'</td>';
								echo '<td>',(++$index),'</td>';
								echo '<td id="e_name'.$value['Enquiry']['id'].'">',$value['Enquiry']['name'],'</td>';
								echo '<td>',$value['Customer']['name'],'</td>';
								if (isset($customer_type[$value['Customer']['customerType_id']])) {
									echo '<td>',$customer_type[$value['Customer']['customerType_id']],'</td>';
								}else{
									echo '<td></td>';
								}
								echo '<td>',$value['Customer']['money_return_sum1'],';',$value['Customer']['money_return_sum2'],'</td>';
								$comments = '';
								if (count($value['MoneyReturn'])==0) {
									echo '<td>还没有返点纪录</td>';//签协议
								}else{
									echo '<td>';
									foreach ($value['MoneyReturn'] as $v) {
										echo $v['paid_on'],',',$v['sum'],'/';
										$comments .= '<p>'.$v['comment'].'</p>';
									}
									echo '</td>';
								}
								echo '<td><div class="mr_trigger" id="',
										$value['Enquiry']['id'],'">',$value['Enquiry']['money_return_sum'],'</div>',
										$this->Html->image('ajax_refresh.gif',array('style'=>'display:none;','id'=>'icon_ajax_refresh'.$value['Enquiry']['id'])),
										'</td>';
								$comments .= '<p>'.$value['Enquiry']['comments'].'<p>';
								echo '<td><a class="show_comments" href="#comment_',$value['Enquiry']['id'],'">查看备注</a><div style="display:none;"><div id="comment_',
										$value['Enquiry']['id'],'" style="width:300px;height:200px;">'
										,$comments,'<div></div></td>';//签协议
								
								echo '<td><div class="action_trigger" name="'.$value['Enquiry']['id'].'">更多操作</div></td></tr>';
							}
						?>
					</tbody>
				</table>
				<?php 
					if(!isset($no_pagi)){
						echo $this->element('pagination_bar');
					}
				?>
		</div>
	</div>
</div>
<?php 
	foreach ($data as $value) {
			/*
			 * 专门用来添加返点纪录的
			 */
			echo $this->ActionsBox->output_fancybox(
					$value['Enquiry']['id'],
					array('添加返点纪录','查看详请'),
					array('',''),
					array(
						'/Enquiries/add_money_back/'.$value['Enquiry']['id'],
						'/Enquiries/view_money_back/'.$value['Enquiry']['id']
					)
			);
			
	}
?>