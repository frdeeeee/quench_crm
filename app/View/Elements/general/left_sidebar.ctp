<div class="cog">+</div>
	<a href="http://www.nova4you.com.au/" class="logo" target="_blank"><span>Nova4you Aus</span></a>
	<div class="user_box clearfix">
		<h2>
		<?php 
			echo $current_user['title'],':&nbsp;&nbsp;',$current_user['name'];
		?>
		</h2>
		<hr>
</div>
<!-- #user_box -->
<ul class="side_accordion"> <!-- add class 'open_multiple' to change to from accordion to toggles -->
			
		
		
		<li <?php echo (isset($current_menu) && $current_menu=='Customers')?' class="has_drawer open"':' class="has_drawer"';?>>
					<a href="#">
						<?php 
							echo $this->Html->image('icons/small/grey/users.png'); 
							echo $this->Mytext->output('contacts');
						?>
					</a>
					<ul class="drawer" <?php echo (isset($current_menu) && $current_menu=='Customers')?' style="display:block;"':' style="display:none;"';?>>
						<?php 
							foreach ($this->Mytext->output('contacts_sub') as $value) {
								echo '<li>',
									 $this->Html->link($value['title'],array('controller'=>$value['controller'],'action'=>$value['action'])),
									'</li>';
							}
						?>
					</ul>
		</li>
		<li <?php echo (isset($current_menu) && $current_menu=='Customers')?' class="has_drawer open"':' class="has_drawer"';?>>
					<a href="#">
						<?php 
							echo $this->Html->image('icons/small/grey/users.png'); 
							echo $this->Mytext->output('clients');
						?>
					</a>
					<ul class="drawer" <?php echo (isset($current_menu) && $current_menu=='Customers')?' style="display:block;"':' style="display:none;"';?>>
						<?php 
							foreach ($this->Mytext->output('clients_sub') as $value) {
								echo '<li>',
									 $this->Html->link($value['title'],array('controller'=>$value['controller'],'action'=>$value['action'])),
									'</li>';
							}
						?>
					</ul>
		</li>
		
		<li <?php echo (isset($current_menu) && $current_menu=='ShortMessages')?' class="has_drawer open"':' class="has_drawer"';?>>
					<a href="#" id="message_box_menu">
						<?php 
							echo $this->Html->image('icons/small/grey/mail.png'); 
							echo $this->Mytext->output('message_box');
							if (isset($is_new_message) && $is_new_message>0) {
								echo '<span class="alert badge alert_red" id="new_message_alert">New</span>';;
							}
						?>
					</a>
					<ul class="drawer" <?php echo (isset($current_menu) && $current_menu=='ShortMessages')?' style="display:block;"':' style="display:none;"';?>>
						<li>
							<a id="send_message_btn" href="#short_message_send_form_wrapper">
								Compose
							</a>
						</li>
						<?php 
							foreach ($this->Mytext->output('message_box_sub') as $value) {
								echo '<li>',
									 $this->Html->link($value['title'],array('controller'=>$value['controller'],'action'=>$value['action'])),
									'</li>';
							}
						?>
					</ul>
		</li>
		
	</ul>