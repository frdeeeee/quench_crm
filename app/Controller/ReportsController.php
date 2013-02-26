<?php
class ReportsController extends AppController{
	public $uses = array('Enquiry','Applicant');
	public $name = 'Reports';
	public $helpers = array('FieldNameParser');
	
	/**
	 * 用来保存数据库中所有的字段和其对应的comment，用来形成表头的文字
	 * @var array
	 */
	private $all_fields = array();
	/**
		专门用来保存查询的时候提交的要求被导出的表单，通过_assembly_table_head()方法执行的时候，进行初始化
		一旦执行过该方法，此数组即可用了。
	 */
	private $query_fields = array();
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	/**
	 * 保存用户的报表，实际时就是保存当时的$this->request->data['Enquiry']
	 * 以后恢复的时候，也恢复成$this->request->data['Enquiry']
	 */
	public function save_my_fields_url(){
		//pr($this->request->data);
		//$this->_set_all_fields();
		//$this->_assembly_table_head();
		//由于执行了上句，queryfields已经弄好
		$msg_type = 'error';
		if (count($this->request->data['Enquiry'])>0) {
			$this->loadModel('SearchUrl');
			$this->loadModel('UsefulUrl');
			$name = $this->request->data['useful_url_name'];
			if ($this->SearchUrl->save_user_view($this->Auth->user('id'),$this->UsefulUrl,$this->request->data['Enquiry'],$name)) {
				$msg_type = 'success';
				$this->Session->setFlash('保存成功');
			}else{
				$this->Session->setFlash('保存失败，请稍后再试');
			}
		}
		$this->redirect(array('action'=>'select_fields',$msg_type));
		return;
	}
	
	/**
	 * 要求以enquiry表为基准进行查询
	 */
	public function report_by_enquiry($search_url_id=NULL){
		$this->layout = 'excel';
		$this->_set_all_fields();
		$this->Enquiry->unbindModel(
			array(
				'hasMany'=>array('EnquiryFeedback','Group'),
			)
		);
		
		if ($search_url_id) {
			$this->layout = 'excel';
			$this->loadModel('SearchUrl');
			$this->SearchUrl->id = $search_url_id;
			parse_str($this->SearchUrl->field('link'),$this->request->data['Enquiry']);
		}
		
		$this->set('field_heads',$this->_assembly_table_head());
		
		$d = $this->Enquiry->find('all',array(
				'conditions'=>array('Enquiry.group_id'=>$this->Session->read('my_group')),
				'fields'=>$this->query_fields,
				'joins'=>$this->_build_joins(),
				'recursive'=>-1
		));
		
		$this->set('output_file_name','youthedu_report_'.date('Y-m-d',time()).'.xls');
		$this->set('query_fields',$this->query_fields);
		$this->set('data',$d);
		$this->_set_useful_values();
		return;
	}
	
	//专门用来提取各个字段的id和comment的并设置到前台方法
	public function select_fields($msg_type=NULL){
		if (empty($this->request->data)) {
			$this->_set_all_fields();
		}else{
			$this->_set_all_fields();
		}
		if ($msg_type) {
			$this->set('msg_type',$msg_type);
		}
		return;
	}
	
	private function load_all_models($models){
		foreach ($models as $value) {
			$this->loadModel($value);
		}
	}
	
	private function _set_useful_values(){
		$data=array();
		$models = array('Customer','Presentation');
		$this->load_all_models($models);
		
		$data['Project']=$this->cached_data['projects'];
		$data['JobStatus']=	$this->cached_data['job_status'];
		$data['Orgnization']=$this->cached_data['orgnizations'];//国外机构列表
		$data['VisaStatus']=$this->cached_data['visa_status'];
		$data['Group']=$this->Group->find('list');
		$data['Source']=$this->cached_data['sources'];
		$data['Province']=$this->cached_data['provinces'];
		$data['FeeType']=$this->cached_data['fee_types'];
		$data['ApplyFeeStatus']=$this->cached_data['apply_fee_status'];
		$data['ContractStatus']=$this->cached_data['contract_status'];
		$data['ProjectFeeStatus']=$this->cached_data['project_fee_status'];
		$data['TrainingMethod']=$this->cached_data['training_methods'];
		$data['Embassy']=$this->cached_data['embassys'];
		$data['State']=$this->cached_data['states'];
		$data['ProjectStatus']=$this->cached_data['project_status'];
		$data['ReturnStatus']=$this->cached_data['return_status'];
		$data['Phase']=$this->cached_data['phases'];
		$data['Customer']=$this->Customer->find('list',array(
				'conditions'=>array(
					'Customer.group_id'=>$this->Session->read('my_group'),
					'Customer.available'=>1,
					'Customer.customerType_id'=>1,
				)
			));
		$data['Presentation']=$this->Presentation->find('list',array(
				'conditions'=>array(
					'Presentation.group_id'=>$this->Session->read('my_group'),
					'Presentation.available'=>1
				)
		));
		$this->set('the_value',$data);
		return;
	}
	
	private function _build_joins(){
		$tables = array();
		$result = array(
			array(
						'table'=>'applicants',
						'alias' => 'Applicant',
						'type' => 'LEFT',
						'conditions'=>array(
							'Enquiry.id = Applicant.enquiry_id',
						)
					)
		);
		//先找出被用户选择的表
		//pr($this->request->data['Enquiry'] );
		foreach ($this->request->data['Enquiry'] as $key=>$value) {
			if (!empty($value)&& count($value)>0) {
				$tables[] = $key;
			};
		}
		foreach ($tables as $value) {
			//pr($value);
			switch ($value) {
				case 'app_fields':
					
				break;
				case 'app_job_fields':
					$result[]=array(
						'table'=>'applicant_jobs',
						'alias' => 'ApplicantJob',
						'type' => 'LEFT',
						'conditions'=>array(
							'ApplicantJob.applicant_id = Applicant.id',
						)
					);
				break;
				case 'app_visa_fields':
					$result[]=array(
						'table'=>'applicant_visas',
						'alias' => 'ApplicantVisa',
						'type' => 'LEFT',
						'conditions'=>array(
							'ApplicantVisa.applicant_id = Applicant.id',
						)
					);
				break;
				case 'app_itinerary_fields':
					$result[]=array(
						'table'=>' applicant_itinerary',
						'alias' => 'ApplicantItinerary',
						'type' => 'LEFT',
						'conditions'=>array(
							'ApplicantItinerary.applicant_id = Applicant.id',
						)
					);
				break;
				
				default:
					;
				break;
			};
		}
		//pr($result);
		return $result;
	}
	
	/**
	 * 根据给定的input找出query_fields
	 * @param unknown_type $input
	 */
	private function _assembly_table_head(){
		$result = array();
		$this->query_fields = array();
		
		//$this->request->data['Enquiry']
		if (!empty($this->request->data['Enquiry'])) {
				foreach ($this->request->data['Enquiry'] as $value) {
					if (!empty($value) && count($value)>0) {
						//pr(array_values($value));
						$this->query_fields = array_merge($this->query_fields,array_values($value));
					};
					
				}
			}
		
		foreach ($this->query_fields as $value) {
			$result[]=$this->all_fields[$value];
		}
		return $result;
	}
	
	/**
	 * 设置所有可能用到的表格field的名字到all_fields成员变量中
	 * 在生成文件的时候，必须要执行它
	 */
	private function _set_all_fields(){
		$enquiry_fields = $this->Enquiry->schema();
			$data = array();
			foreach ($enquiry_fields as $key=>$value){
				if(isset($value['comment']) && !empty($value['comment'])){
					$data['Enquiry.'.$key] = $value['comment'];//运营已阅
				}
			}
			$this->set('enquiry_fields',$data);
			$this->all_fields = array_merge($this->all_fields,$data);
			
			$app_fields = $this->Applicant->schema();
			$data = array();
			foreach ($app_fields as $key=>$value){
				if (isset($value['comment'])) {
					if(isset($value['comment']) && !empty($value['comment'])){
						$data['Applicant.'.$key] = $value['comment'];
					}
				}
			}
			$this->set('app_fields',$data);
			$this->all_fields = array_merge($this->all_fields,$data);
			//安置信息
			$this->loadModel('ApplicantJob');
			$app_job_fields = $this->ApplicantJob->schema();
			$data = array();
			foreach ($app_job_fields as $key=>$value){
				if (isset($value['comment'])) {
					if(isset($value['comment']) && !empty($value['comment'])){
						$data['ApplicantJob.'.$key] = $value['comment'];
					}
				}
			}
			$this->set('app_job_fields',$data);
			$this->all_fields = array_merge($this->all_fields,$data);
			//签证信息
			$this->loadModel('ApplicantVisa');
			$app_visa_fields = $this->ApplicantVisa->schema();
			$data = array();
			foreach ($app_visa_fields as $key=>$value){
				if (isset($value['comment'])) {
					if(isset($value['comment']) && !empty($value['comment'])){
						$data['ApplicantVisa.'.$key] = $value['comment'];
					}
				}
			}
			$this->set('app_visa_fields',$data);
			$this->all_fields = array_merge($this->all_fields,$data);
			//行程单信息
			$this->loadModel('ApplicantItinerary');
			$app_itinerary_fields = $this->ApplicantItinerary->schema();
			$data = array();
			foreach ($app_itinerary_fields as $key=>$value){
				if (isset($value['comment'])) {
					if(isset($value['comment']) && !empty($value['comment'])){
						$data['ApplicantItinerary.'.$key] = $value['comment'];
					}
				}
			}
			$this->set('app_itinerary_fields',$data);
			$this->all_fields = array_merge($this->all_fields,$data);
			return;
	}
}