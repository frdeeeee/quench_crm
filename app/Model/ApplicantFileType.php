<?php
/**
 * 这个类是代表申请人上传的文件的种类。每个系统项目可能有不同种类的文件需要申请人提交
 */
class ApplicantFileType extends AppModel{
	public $name = 'ApplicantFileType';
	public $belongsTo = array('Project');
	public $useTable = 'applicant_file_types';

}