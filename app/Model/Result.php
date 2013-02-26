<?php
/**
 * 描述学生的签证结果是等待、成功、失败
 * @author candicezhong
 *
 */
class Result extends AppModel{
		public $name = 'Result';
		public $hasMany = array('Applicant');
}