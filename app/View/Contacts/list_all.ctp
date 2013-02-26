<?php 
	echo $this->Html->script('ajax_utils/start_slider_nav',false); 
	$customer_types[0]='Undefined';
?>
<div class="box grid_6">
		
		<div id="slider_list">
			<div class="slider-content">
				<ul>
					  <?php 
					  	foreach ($data['lower_letters'] as $key => $letter) {
					  			echo '<li id="'.$letter.'"><a name="'.$letter.'" class="title">'.$data['upper_letters'][$key].'</a><ul id="contacts_list_holder_'.$data['upper_letters'][$key].'">';
					  			if (isset($data['contacts'][$letter])) {
						  			foreach ($data['contacts'][$letter] as $value) {
						  				if ($value['Contact']['lead_id']==1) {
						  					$lead_str = '<span id="customer_type_'.$value['Contact']['id'].'">(<b style="color:blue">'.$customer_types[$value['Contact']['lead_id']].'</b>)</span>';
						  				}else if($value['Contact']['lead_id']==2){
						  					$lead_str = '<span id="customer_type_'.$value['Contact']['id'].'">(<b style="color:red">'.$customer_types[$value['Contact']['lead_id']].'</b>)</span>';
						  				}else if($value['Contact']['lead_id']==3){
						  					$lead_str = '<span id="customer_type_'.$value['Contact']['id'].'">(<b style="color:green">'.$customer_types[$value['Contact']['lead_id']].'</b>)</span>';
						  				}else{
						  					$lead_str = '<span id="customer_type_'.$value['Contact']['id'].'">(<b>'.$customer_types[$value['Contact']['lead_id']].'</b>)</span>';
						  				}
						  				
						  				if($value['Contact']['status']==IS_CLIENT){
						  					$lead_str = '';
						  				}
						  				echo '<li id="contact_item_'.$value['Contact']['id'].'"><a class="contact_item" href="#" title="'.$value['Contact']['id'].'">'
						  					.(($value['Contact']['status']==IS_CLIENT)?
						  						$this->Html->image('icons/small/grey/admin_user.png',array('width'=>'16')).'&nbsp;&nbsp;':
						  						NULL)
						  					.$value['Contact']['company'].' '
						  					.$value['Contact']['first_name'].' '
						  					.$value['Contact']['middle_name'].' '
						  					.$value['Contact']['last_name'].$lead_str
						  					.'</a></li>';
						  				
						  			}
					  			}
					  			echo '</ul></li>';
					  		}
					  ?>
				</ul>
			</div>
		</div>
</div>	
<div class="flat_area grid_10">
	<h2>Contact Form</h2>
	<?php 
		echo $this->element('contacts/operation_shortcuts');
	 ?>
	<?php 
		echo $this->element('contacts/add_new_form');
	?>		
</div>
