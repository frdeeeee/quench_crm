<div class="cog">+</div>
	<a href="http://www.youth-edu.org/" class="logo" target="_blank"><span>Youth-edu</span></a>
	<div class="user_box clearfix">
		<?php echo $this->Html->image('profile_small.png',array('width'=>'55','alt'=>'Profile Photo')); ?>
		<h2>
		<?php 
			echo $this->Session->read('enquiry_name').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		?>
		</h2>
		<h3><a href="#">欢迎来到优势</a></h3>
		<ul>
			<li>
			<?php echo $this->Html->link('退出系统',array('controller'=>'Students','action'=>'logout')); ?>
			</li>
		</ul>
</div>
<!-- #user_box -->
<ul class="side_accordion"> <!-- add class 'open_multiple' to change to from accordion to toggles -->
		
		<li  class="has_drawer open">
					<a href="#" id="message_box_menu">
						<?php 
							echo $this->Html->image('icons/small/grey/mail.png'); 
							echo $this->Mytext->output('students');
							/*
							if (isset($is_new_message) && $is_new_message>0) {
								echo '<span class="alert badge alert_red" id="new_message_alert">新</span>';;
							}*/
						?>
					</a>
					<ul class="drawer" style="display:block;">
						<li>
							<a href="/Students/my_messages">
								给我的短消息
								<?php echo ($new_messages>0)?'<span class="alert badge alert_red">'.$new_messages.'</span>':NULL; ?>
							</a>
						</li>
						<?php 
							foreach ($this->Mytext->output('students_sub') as $value) {
								echo '<li>',
									 $this->Html->link($value['title'],array('controller'=>$value['controller'],'action'=>$value['action'])),
									'</li>';
							}
						?>
						
						<?php 
							//根据学生当前处的阶段来显示对应的菜单
							if ($this->Session->read('current_phase')>=PHASE_APPLY) {
								?>
								<li><?php echo $this->Html->link('申请阶段资料管理',array('controller'=>'Students','action'=>'home',0,PHASE_APPLY)); ?></li>
								<?php
							}
						?>
						<?php 
							if ($this->Session->read('current_phase')>=PHASE_SETTLE) {
								?>
								<li><?php echo $this->Html->link('安置阶段资料管理',array('controller'=>'Students','action'=>'home',0,PHASE_SETTLE)); ?></li>
								<?php
							}
						?>
						<?php 
							if ($this->Session->read('current_phase')>=PHASE_VISA) {
								?>
								<li><?php echo $this->Html->link('签证阶段资料管理',array('controller'=>'Students','action'=>'home',0,PHASE_VISA)); ?></li>
								<?php
							}
						?>
						
						<?php 
							//if ($this->Session->read('current_phase')>=PHASE_BEFORE_LEAVING) {
								?>
								<li><?php echo $this->Html->link('行前阶段资料管理',array('controller'=>'Students','action'=>'home',0,PHASE_BEFORE_LEAVING)); ?></li>
								<?php
							//}
						?>
						<?php 
							//if ($this->Session->read('current_phase')>=PHASE_OVERSEA) {
								?>
								<li><?php echo $this->Html->link('赴美阶段资料管理',array('controller'=>'Profiles','action'=>'activate')); ?></li>
								<?php
							//}
						?>
						<?php 
							//if ($this->Session->read('current_phase')>=PHASE_RETURN) {
								?>
								<li><?php echo $this->Html->link('回国阶段资料管理',array('controller'=>'Students','action'=>'home',0,PHASE_RETURN)); ?></li>
								<?php
							//}
						?>
					</ul>
		</li>
		
	</ul>
	<ul id="side_links" class="side_links" style="margin-bottom:0;">
		<li><a href="#">系统功能使用帮助手册</a>
	</ul>