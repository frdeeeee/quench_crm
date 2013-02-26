<?php
/**
 * 描述报名学生的来源是代理、学校、个人
 * @author candicezhong
 *
 */
class Source extends AppModel{
		public $name = 'Source';
		public $hasMany = array('Enquiry');
}