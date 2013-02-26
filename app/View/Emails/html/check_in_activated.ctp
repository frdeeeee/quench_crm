<p><?php echo  $data['Enquiry']['name']; ?>，您好</p>
<p>你的优势后台Check-In功能已经被成功激活。</p>
<p>距你的下一次优势后台Check-In时间还有30天，请及时登陆优势后台（<?php echo Router::url(array('controller'=>'Students','action'=>'login'),TRUE); ?>）进行Check-In。一周内请常上后台和邮箱查看新信息。</p>
<p>注意：不按时Check-In可能造成项目终止！</p>
<p>同时请注意及时完成外方机构后台的Check-In。</p>
<p>如有任何问题，欢迎咨询免费服务电话：4006-501-801或邮件至<?php echo $data['User']['username'];?></p>
<p>谢谢！</p>
<hr>
<p>优势项目办公室: <?php echo $data['User']['name'];?></p>
<p>地址：北京市朝阳区西大望路15号外企大厦B座1802B 100022</p>
<p>电话：4006-501-801</p>
