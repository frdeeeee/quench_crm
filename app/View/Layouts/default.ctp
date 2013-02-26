<?php 
	//echo $this->Facebook->html(); 
	echo $this->Html->docType('html5');
?>
<html>
<!--[if lt IE 7]> <html lang="en-us" class="no-js ie6"> <![endif]-->
<!--[if IE 7]>    <html lang="en-us" class="no-js ie7"> <![endif]-->
<!--[if IE 8]>    <html lang="en-us" class="no-js ie8"> <![endif]-->
<!--[if IE 9]>    <html lang="en-us" class="no-js ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-us" class="no-js"> <!--<![endif]-->
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo 'Quench | Office CRM '.$title_for_layout; ?>:
	</title>
	<meta name="author" content="Justin Wang">
	<!-- iPhone, iPad and Android specific settings -->	
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1;">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<link rel="apple-touch-icon" href="images/iOS_icon.png">
		<link rel="apple-touch-startup-image" href="images/iOS_startup.png">
	<!-- iPhone, iPad and Android specific settings end-->
	<!-- Styles start-->
	
	<!-- Styles end-->	
	<?php
		echo $this->element('general/css_section');
		echo $this->element('general/js_script_section');
	?>
</head>
<body>
	<div id="wrapper">
		<!-- #topbar -->
		<div id="sidebar">
			<?php echo $this->element('general/left_sidebar'); ?>
		</div>
		<!-- #sidebar -->
		<div id="main_container" class="main_container container_16 clearfix">
			<?php echo $this->element('general/navi_top'); ?>
			<?php 
				echo $this->fetch('content'); 
			?>
		</div>
	</div>
	<?php echo $this->element('general/document_footer'); ?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>