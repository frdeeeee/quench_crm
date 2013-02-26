<?php 
	//echo $this->Html->script(array('isotope/jquery.isotope.min','fancybox/jquery.fancybox-1.3.4','adminica/adminica_gallery'));
?>


<div id="loading_overlay">
	<div class="loading_message round_bottom">
		<?php echo $this->Html->image('loading.gif',array('alt'=>'Loading pages...')); ?>
	</div>
</div>
<?php echo $this->element('fancy_forms/short_message_add_form'); ?>