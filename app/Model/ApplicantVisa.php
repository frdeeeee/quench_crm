<?php
	/**
	 * 这个是代表一个申请人的签证信息的类，对应数据库中的applicant_visas表格。
	 * 由老师来填写，申请人在学生登陆界面中可以浏览
	 */
class ApplicantVisa extends AppModel{
	public $name = 'ApplicantVisa';
	public $belongsTo = array(
		//'Applicant',
		'TrainingMethod'=>array('className'=>'TrainingMethod','foreignKey'=>'training_method_id'),
		'Embassy'=>array('className'=>'Embassy','foreignKey'=>'embassy_id')
	);
}