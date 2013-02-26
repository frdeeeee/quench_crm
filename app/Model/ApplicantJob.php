<?php
	/**
	 * 代表申请人所申请的工作的信息的类，主要是雇主方面的信息。最重要的是回执文件名，它代表的是服务器上的一个文件名
	 */
class ApplicantJob extends AppModel{
	public $name = 'ApplicantJob';
	public $belongsTo = array('Applicant','State');
	public $useTable = 'applicant_jobs';
}