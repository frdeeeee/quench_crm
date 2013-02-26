<p><?php echo  $data['Enquiry']['name']; ?>，您好:</p>
<p>你的JOB OFFER下来了！请登录优势后台<?php echo Router::url(array('controller'=>'Students','action'=>'login'),TRUE); ?>下载，
按照项目手册或模板的指导，在24小时内签字扫描上传，如不及时可能造成岗位丢失。</p>
<ul>
	<li>您的登陆用户名是您目前使用的电子邮件：<?php echo $data['Enquiry']['email'];  ?></li>
	<li>您的登陆口令是您的手机号码: <?php echo $data['Enquiry']['mobile'];  ?></li>
</ul>
<p>如有任何问题，欢迎您随时通过电话或者电子邮件<?php echo $data['User']['username'];?>与我联系，我将为您提供最优质的服务。</p>
<p>谢谢！</p>
<hr>
<p>优势项目办公室: <?php echo $data['User']['name'];?></p>
<p>地址：北京市朝阳区西大望路15号外企大厦B座1802B 100022</p>
<p>电话：4006-501-801</p>