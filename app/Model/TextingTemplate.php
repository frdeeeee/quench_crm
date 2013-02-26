<?php
	/**
	 * 这个类是用来操作短信模板的，模板的基本结构就是id，模板名称和模板内容
	 * Enter description here ...
	 * @author candicezhong
	 *
	 */
	class TextingTemplate extends AppModel{
		public $name = 'TextingTemplate';
		public $useTable = 'texting_templates';
	}