<?php
/**
 * 描述学生是如何知道这个产品的，是宣讲会、零散报名
 * @author candicezhong
 *
 */
class Channel extends AppModel{
		public $name = 'Channel';
		public $hasMany = array('Enquiry');
}