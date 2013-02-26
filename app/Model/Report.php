<?php
class Report extends AppModel{
	public $name = 'Report';
	public $useTable = FALSE;
	
	/**
	 * 所有可以用来供用户选择的报表的字段，统一来自Enquiry，Applicant等
	 * @var array
	 */
	private $available_fields = array(
		
	);
	
	public function get_available_fields(){
		return $this->available_fields;
	}
}