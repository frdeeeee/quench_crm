<?php
/**
 * 这个帮助类是根据给定的数组值，找出对应的类名，然后在view中显示正确的字符传。
 * 输入的应该是以_分割的字符串，比如：customer_id，那么对应的要返回Customer。
 * 也有可能输入的是visa_status_id，那么就应该返回VisaStatus
 * 如果没有找到，则返回false
 */
App::uses('AppHelper', 'View/Helper');

class FieldNameParserHelper extends AppHelper {
	private $yes_no = array(0=>'否',1=>'是');
	private $is_ready = array(0=>'未准备好','准备好');
	
	public function parse($input = null){
		if (is_null($input)) {
			return FALSE;
		}else{
			$source = $this->_get_source();
			if (isset($source[$input])) {
				return $source[$input];
			}else{
				return FALSE;
			}
		}
	}
	
	private function _get_source(){
		return array(
		//Enquiry
		'customer_id'=>'Customer',
		'source_id'=>'Source',
		'presentation_id'=>'Presentation',
		'is_viewed_by_operation'=>array(0=>'未看',1=>'已看'),
		'gender'=>array(0=>'女',1=>'男'),
		'group_id'=>'Group',
		'project_id'=>'Project',
		'task_id'=>'Task',
		'is_feedback'=>array(0=>'未回访',1=>'已回访'),
		'is_applicant'=>$this->yes_no,
		'province_id'=>'Province',
		'contract_status_id'=>array(0=>'未签',1=>'已签'),
		'apply_fee_type'=>'FeeType',
		'apply_fee_status_id'=>'ApplyFeeStatus',
		'project_fee_type'=>'FeeType',
		'project_fee_status_id'=>'ProjectFeeStatus',
		'contract_status_id'=>'ContractStatus',
		'project_fee_period'=>array(1=>'1个月',2=>'2个月'),
		'accom_period'=>array(1=>'1个月',2=>'2个月'),
		'status'=>array(NORMAL=>'正常',DELETED=>'退出'),
		'intention_oversea'=>$this->yes_no,
		'intention_internship'=>$this->yes_no,
		'cancel_fee_form_status'=>$this->yes_no,
		'cancel_fee_type'=>'FeeType',
		//Applicant
		'orgnization_id'=>'Orgnization',
		'visa_status'=>'VisaStatus',
		'job_status'=>'JobStatus',
		'project_status_id'=>'ProjectStatus',
		'return_status_id'=>'ReturnStatus',
		'phase_id'=>'Phase',
		'slep'=>$this->yes_no,
		'application_data'=>array(0=>'未完成',1=>'已完成，等待外方安置',2=>'外方已通过'),
		'project_data'=>array(0=>'未完成',1=>'已完成'),
		'visa_data'=>array(0=>'不全',1=>'已全，等待签证'),
		'job_offer_upload_oversea_status'=>array(0=>'未上传',1=>'已上传外方机构'),
		'usa_informed'=>$this->yes_no,
		//ApplicantJob
		'provide_accom'=>array(0=>'雇主不提供',1=>'雇主提供'),
		'interview'=>$this->yes_no,
		'hf_status'=>$this->yes_no,
		//ApplicantVisa
		'training_method_id'=>'TrainingMethod',
		'embassy_id'=>'Embassy',
		'is_passport_ok'=>$this->is_ready,
		'visa_fee_billing'=>$this->is_ready,
		'is_photo_ok'=>$this->is_ready,
		'is_application_form_ok'=>$this->is_ready,
		'is_father_income_ok'=>$this->is_ready,
		'is_mother_income_ok'=>$this->is_ready,
		'is_bank_deposit1_ok'=>$this->is_ready,
		'is_bank_deposit2_ok'=>$this->is_ready,
		'sevis'=>array(0=>'未交',1=>'已交'),
		'ds2019'=>array(0=>'未收到',1=>'已收到'),
		'form160'=>array(0=>'未做好',1=>'已做好'),
		//ApplicantItinerary
		'air_port_pick_status'=>array(0=>'等待安排',1=>'已安排')
		);
	}
}