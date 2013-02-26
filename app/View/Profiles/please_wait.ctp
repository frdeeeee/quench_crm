<div class="flat_area grid_16">
	<h2><?php echo $this->Session->read('enquiry_name'); ?>你好，欢迎来到赴美阶段管理系统</h2>
	<p>您已经申请激活优势办的赴美学生管理系统，请耐心等待老师核实您的信息之后，正式激活您的信息。谢谢！</p>
	<p>如果您觉得您提交的激活信息有误，
	<?php echo $this->Html->link('可以点击这里修改',array('controller'=>'Profiles','action'=>'modify')); ?>
	</p>
	<hr />
	<h4>老师留言：</h4>
	<p><?php echo $data['Profile']['teacher_notes']; ?></p>
</div>