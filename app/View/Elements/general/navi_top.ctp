<div id="nav_top" class="clearfix round_top">
			<ul class="clearfix">
				<li>
					<?php 
						echo $this->Html->link(
								$this->Html->image('icons/small/grey/laptop.png'),
								array('controller'=>'Contacts','action'=>'dashboard'),
								array('escape'=>false,'title'=>'Home')
						); 
					?>
				</li>
					<li>
							<?php 
								echo $this->Html->link(
									'<span>Home</span>',
									array('controller'=>'Contacts','action'=>'dashboard'),
									array('escape'=>false,'title'=>'Home')
								); 
							?>
					</li>
					<li>
						<a href="#">
							<?php 
								echo $this->Html->image('icons/small/grey/create_write.png'); 
							?>
							<span>Working Logs</span>
						</a>
						<ul>
							<li>
								<a href="/Tasks/list_all"><span>My Tasks</span></a>
							</li>
							<li>
								<a href="/WorkingLogs/list_all"><span>My Contact History</span></a>
							</li>
						</ul>
					</li>
				
				<li>
					<a href="/Meetings/list_all">
						<?php 
							echo $this->Html->image('icons/small/grey/blocks_images.png'); 
						?>
						<span>Meetings</span>
					</a>
				</li>
				<li>
					<a href="/DownloadFiles/list_all">
						<?php 
							echo $this->Html->image('icons/small/grey/file_cabinet.png'); 
						?>
						<span>Files Manager</span>
					</a>
				</li>
				
				<li>
					<a href="/Announcements/list_all">
						<?php 
							echo $this->Html->image('icons/small/grey/coverflow.png'); 
						?>
						<span>Notifications</span>
						<?php 
							if (!empty($latest_announcement) ){
								echo '<span class="alert badge alert_blue">New</span>';
							}
						?>
					</a>
				</li>
				
				<li>
					<?php 
						echo $this->Html->link(
								$this->Html->image('icons/small/grey/locked_2.png'),
								array('controller'=>'Users','action'=>'logout'),
								array('escape'=>false,'title'=>'Logout')
								); 
					?>
				</li>
					<p id="announcement_box" style="margin: 5px;float:right;">
						<?php echo $this->Html->image('gif011.gif',array('height'=>'12px')); ?>
						<b style="color: red">New message：</b>
						<?php 
						if (empty($latest_announcement)) {
							echo 'No new message';
						}else{
							/*
							echo $this->Html->link(
								$latest_announcement['Announcement']['name'],
								array('controller'=>'Announcements','action'=>'list_all')
							); 
							*/
						}
						?>
					</p>
			</ul>



<script type="text/javascript">
	var currentPage = 1 - 1; // This is only used in php to tell the nav what the current page is
	$('#nav_top > ul > li').eq(currentPage).addClass("current");
	$('#nav_top > ul > li').addClass("icon_only").children("a").children("span").parent().parent().removeClass("icon_only");
</script>
		</div>
		<!-- #nav_top -->