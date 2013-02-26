<p><?php echo  $data['Enquiry']['name']; ?>，您好</p>
<p>我是优势项目的<?php echo $data['User']['name']; ?>，欢迎加入优势项目大家庭，您申请的<?php echo $data['Project']['name']; ?>，由于某些原因，目前重新回到<?php $data['Enquiry']['phase_name']?>。</p>
<p>请您访问我们的服务平台<?php echo Router::url(array('controller'=>'Students','action'=>'login'),TRUE); ?>，我们将竭尽全力协助您尽快成行。</p>
<ul>
	<li>您的登陆用户名是您目前使用的电子邮件：<?php echo $data['Enquiry']['email'];  ?></li>
	<li>您的登陆口令是您的手机号码: <?php echo $data['Enquiry']['mobile'];  ?></li>
</ul>
<p>如有任何问题，欢迎您随时通过电话或者电子邮件<?php echo $data['User']['username'];?>与我联系，我将为您提供最优质的服务。</p>
<hr>
<p>优势项目办公室: <?php echo $data['User']['name'];?></p>
<p>地址：北京市朝阳区西大望路15号外企大厦B座1802B 100022</p>
<p>电话：4006-501-801</p>