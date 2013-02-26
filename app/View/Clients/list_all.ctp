<?php 
	echo $this->Html->script('ajax_utils/clients_list_all',false); 
?>
<div class="box grid_6">
		
		<div id="slider_list">
			<div class="slider-content">
				<ul>
					  <?php 
					  		foreach ($data['lower_letters'] as $key => $letter) {
					  			echo '<li id="'.$letter.'"><a name="'.$letter.'" class="title">'.$data['upper_letters'][$key].'</a><ul>';
					  			if (isset($data['contacts'][$letter]) && is_array($data['contacts'][$letter])) {
						  			foreach ($data['contacts'][$letter] as $value) {
						  				echo '<li id="contact_item_'.$value['Contact']['id'].'"><a class="contact_item" href="#" title="'.$value['Contact']['id'].'">'
						  					.$this->Html->image('icons/small/grey/admin_user.png',array('width'=>'16')).'&nbsp;&nbsp;'
						  					.$value['Contact']['company'].' '
						  					.$value['Contact']['first_name'].' '
						  					.$value['Contact']['middle_name'].' '
						  					.$value['Contact']['last_name'].' '
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
	<h2>Client's profile</h2>
	<div style="display: none" id="is_form_updated">1</div>
	<div class="box grid_16 tabs">
		<ul class="tab_header clearfix">
			<li><a href="#tabs-1">Contact</a></li>
			<li><a href="#tabs-2">Spring Water</a></li>
			<li><a href="#tabs-3">Water Filtration</a></li>
			<li><a href="#tabs-4">Water Cooler</a></li>
			<li><a href="#tabs-5">Other 1</a></li>
			<li><a href="#tabs-6">Other 2</a></li>
			<li><a href="#tabs-7">Other 3</a></li>
		</ul>
	
		<div class="toggle_container">
			<div id="tabs-1" class="block">
				<?php 
					echo $this->element('clients/add_new_form');
				?>
			</div>
			<div id="tabs-2" class="block">
				<?php 
					echo $this->element('clients/web_hosting');
				?>
			</div>
			<div id="tabs-3" class="block">
				<?php 
					echo $this->element('clients/social');
				?>
			</div>
			<div id="tabs-4" class="block">
				<?php 
					echo $this->element('clients/seo');
				?>
			</div>
			<div id="tabs-5" class="block">
				<?php 
					echo $this->element('clients/sem');
				?>
			</div>
			<div id="tabs-6" class="block">
				<?php 
					echo $this->element('clients/other');
				?>
			</div>
			<div id="tabs-7" class="block">
				<?php 
					echo $this->element('clients/accounting');
				?>
			</div>
		</div>	
	</div>
</div>
