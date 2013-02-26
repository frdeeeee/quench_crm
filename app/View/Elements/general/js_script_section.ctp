<?php 
			echo $this->Html->script(array(
					'jquery/jquery-1.7.1.min',
					'jquery/jquery-ui-1.8.18.custom.min',
					'touchPunch/jquery.ui.touch-punch.min',
					'uitotop/js/jquery.ui.totop',
					'uniform/jquery.uniform.min',
					'autogrow/jquery.autogrowtextarea',
					'multiselect/js/ui.multiselect',
					'selectbox/jquery.selectBox.min',
					'timepicker/jquery.timepicker',
					'uistars/jquery.ui.stars.min',
					'tiptip/jquery.tipTip.minified',
					'validation/jquery.validate.min',
					'adminica/adminica_ui',
					'adminica/adminica_forms',
					'ajax_utils/utils_actions_box',
					'slidernav/slidernav',
					//'adminica/adminica_mobile',
					'isotope/jquery.isotope.min',
					'fancybox/jquery.fancybox-1.3.4',
					'adminica/adminica_gallery',
					'editable/jquery.editable-1.3.3',
					'ajax_utils/short_messages',
					'ajax_utils/timesheets',
					));
			echo $this->fetch('script');
		?>		
		<!-- Live Load (remove after development) -->