<p><?php echo  $data['Enquiry']['name']; ?>，您好</p>
<p>我是优势项目的<?php echo $data['User']['name']; ?>，我很高兴的通知您，您申请的<?php echo $data['Project']['name']; ?>已经进入正式的行前准备阶段。</p>
<p>恭喜你通过了面签，得到了赴美签证！</p>

<p>目前，需要你完成以下五项工作：</p>
<ul>
	<li>1）通过邮件与雇主联系，告知雇主你已获得赴美签证，会按照Job Offer上规定的日期到岗工作。通过此邮件可与雇主再确认你可按时上岗工作。</li>
	<li>2）尽快根据Job Offer上的住宿信息预订你们在美期间的住所，以便尽早落实在美期间的住宿，如已预订完成，请将你在美的住宿信息告知优势办。信息包括住所名称，地址，房东联系人及电话。请将以上信息发送至邮箱XXXXXX。
	</li>
	<li>3）机票预订：需购买往返国际机票。请将电子行程单上传至优势后台（<?php echo Router::url(array('controller'=>'Students','action'=>'login'),TRUE); ?>），并填写机票信息。（注意：护照一般在三个工作日后才能寄出）</li>
	<li>4）请自行购买工作期结束后，旅游期间的海外意外保险。</li>
	<li>5）拿到护照后请将签证页扫描，上传至优势后台（<?php echo Router::url(array('controller'=>'Students','action'=>'login'),TRUE); ?>）</li>
</ul>
<hr />
<ul>
	<li>您的登陆用户名是您目前使用的电子邮件：<?php echo $data['Enquiry']['email'];  ?></li>
	<li>您的登陆口令是您的手机号码: <?php echo $data['Enquiry']['mobile'];  ?></li>
</ul>
<p>如有任何问题，欢迎您随时通过电话或者电子邮件<?php echo $data['User']['username'];?>与我联系，我将为您提供最优质的服务。</p>
<hr>
<p>优势项目办公室: <?php echo $data['User']['name'];?></p>
<p>地址：北京市朝阳区西大望路15号外企大厦B座1802B 100022</p>
<p>电话：4006-501-801</p>