<?php
require_once 'ApplicantEventListener.php'; //这个是专门监听和响应和applicant有关操作的消息的
class SearchsController extends AppController{
	public $uses = array('Applicant','Orgnization','JobStatus','VisaStatus','Source','Project','Province','FeeType','DownloadFile','Enquiry','Note','Tag');
	public $name = 'Searchs';

	public $paginate = array(
			'limit' => 20,
			'recursive' => 1
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
		if (in_array($this->action, array('add','phase_visa_confirmed','phase_oversea_confirmed','phase_settle_confirmed'))) {
			$listener = new ApplicantEventListener();
			$this->Applicant->getEventManager()->attach($listener);
		}
	}
	
	public function beforeRender(){
		$this->set('current_menu','Applicants');
		$this->set('is_applicant',1);
	}
	
	public function search($search_url_id = NULL){
		$bean_name = 'Applicant';
		$view_name= 'applicant_view';
		if ($this->request->data['Search']['phase_id']==PHASE_REGISTRATION) {
			//这样判断的原是，如果是搜索报名阶段的，就可能是Enquiry表
			$bean_name = 'Enquiry';
			$view_name = 'enquiry_view';
		}else{
			$this->Applicant->unbindModel(array('belongsTo'=>array('Group')));
		}
		//到此，已经判断出应该搜索哪个表
		
		//Check the request is form search form or paginator
		if (empty($this->request->data)) {
			$result = $this->_handle_search_url($search_url_id,NULL);
		}else{
			//特别注意，下面的这一句是按地址传递的request的data
			$result = $this->_handle_search_url($search_url_id,&$this->request->data['Search']);
		}
		
		$options = null;
		if(is_array($result)){
			//表示来自pagination
			$options = $this->_get_search_options($result,$bean_name);
			$query_id = $search_url_id;
		}else{
			//the search button was clicked first time
			$options = $this->_get_search_options($this->request->data['Search'],$bean_name);
			$query_id = $result;
		}
		
		$this->paginate['conditions'] = $options;
		$this->paginate['joins'] = $this->_get_search_joins();
		$this->paginate['fields'] = $this->_get_search_fields($bean_name);
		//pr($this->paginate);
		$this->Enquiry->unbindModel(array('belongsTo'=>array('Group'),'hasMany'=>array('EnquiryFeedback')));
		$this->set('data',$this->paginate($bean_name));
		$this->set('query_id',$query_id);
		
		return;
	}
	
	public function _get_search_fields($bean_name){
		if ($bean_name=='Applicant') {
			return array(
				'Enquiry.name',
				'Enquiry.school',
				'Orgnization.name',
				'JobStatus.name',
				'VisaStatus.name',
				'Applicant.slep',
				'Applicant.apply_fee',
				'Applicant.project_fee',
				'Applicant.sign_date',
				'Applicant.application_data',
				'Applicant.project_data',
				'Applicant.visa_data',
				'Applicant.visa_signed_date',
				'Applicant.departure_date',
				'Applicant.id'
				);
		}
	}
	
	private function _get_search_joins($bean_name=null){
		if ($bean_name=='Enquiry') {
			return $result = array(
			array(
			'table'=>'applicant_visas',
			'alias'=>'ApplicantVisa',
			'type'=>'left',
			'conditions'=>array(
				'Applicant.id=ApplicantVisa.applicant_id'
				)
			),
			array(
			'table'=>'orgnizations',
			'alias'=>'Orgnization',
			'type'=>'left',
			'conditions'=>array(
				'Orgnization.id=Applicant.orgnization_id'
				)
			),
			array(
			'table'=>'job_status',
			'alias'=>'JobStatus',
			'type'=>'left',
			'conditions'=>array(
				'JobStatus.id=Applicant.job_status'
				)
			),
			array(
			'table'=>'visa_status',
			'alias'=>'VisaStatus',
			'type'=>'left',
			'conditions'=>array(
				'JobStatus.id=Applicant.visa_status'
				)
			),
		);
		}
		return array();
		/*
		else{
			return $result = array(
			array(
			'table'=>'enquiries',
			'alias'=>'Enquiry',
			'type'=>'right',
			'conditions'=>array(
				'Enquiry.id=Applicant.enquiry_id'
				)
			),
			array(
			'table'=>'applicant_visas',
			'alias'=>'ApplicantVisa',
			'type'=>'left',
			'conditions'=>array(
				'Applicant.id=ApplicantVisa.applicant_id'
				)
			),
			array(
			'table'=>'orgnizations',
			'alias'=>'Orgnization',
			'type'=>'left',
			'conditions'=>array(
				'Orgnization.id=Applicant.orgnization_id'
				)
			),
			array(
			'table'=>'job_status',
			'alias'=>'JobStatus',
			'type'=>'left',
			'conditions'=>array(
				'JobStatus.id=Applicant.job_status'
				)
			),
			array(
			'table'=>'visa_status',
			'alias'=>'VisaStatus',
			'type'=>'left',
			'conditions'=>array(
				'JobStatus.id=Applicant.visa_status'
				)
			),
		);
		}
		*/
	}
	
	/**
	 * 专门用来根据给定的参数，构造数据库查询条件数组的私有方法
	 * @param Array $params
	 * @return Ambigous <multitype:multitype:string  , unknown>
	 */
	private function _get_search_options($params = NULL,$bean_name=NULL){
		$options = array('AND'=>array());
		//解决日期的条件，如果忽略日期条件的情况
		if (isset($params['from'])) {
			$key = $this->_get_by_date_conditions($params['by_date'], $bean_name);
			if (!is_null($key)) {
				$from = $params['from'];
				$options['AND'][]=$key.'>'."'$from'";
			}
		}
		if (isset($params['to'])) {
			$key = $this->_get_by_date_conditions($params['by_date'], $bean_name);
			if (!is_null($key)) {
				$from = $params['to'];
				$options['AND'][]=$key.'<'."'$from'";
			}
		}
		if (isset($params['school'])) {
				$school = $params['school'];
				$options['AND']['Enquiry.school LIKE'] = "%$school%";
			}
			
		if (isset($params['name'])) {
				$name = $params['name'];
				$options['AND']['Enquiry.name LIKE'] = "%$name%";
		}
		if (
				$this->Auth->user('role_id')!=ADMIN && 
				$this->Auth->user('role_id')!=SALES_DIRECTOR &&
				$this->Auth->user('role_id')!=OPERATION_DERECTOR
			) {
				//如果不是管理员和总监级别，就要加上组的限制
				$options['AND'][$bean_name.'.group_id']=$this->Session->read('my_group');
			}
			
		if (isset($params['project_id'])) {
				$options['AND'][$bean_name.'.project_id']=$params['project_id'];
		}
		if ($params['phase_id']!=1) {
				$options['AND'][$bean_name.'.phase_id']=$params['phase_id'];
		}
		
		if ($bean_name=='Enquiry') {
			$options['AND']['Enquiry.is_applicant']=0;//报名阶段就肯定是0
		}
		return $options;
	}
	
	private function _get_by_date_conditions($by_date,$bean_name){
		$result = NULL; //这个表示按照全部条件
		if ($bean_name=='Enquiry') {
			//只能按照报名日期和slep考试日期搜索;或者没有条件表示全部
			switch ($by_date) {
				case 9://表示按照slep考试日期搜索
				$result = 'Enquiry.exam_date';
				break;
				default://表示其它的任何条件，都按照报名日期来搜索
				$result = 'Enquiry.created';
				break;
			}
		}else{
			//要搜索ApplicantaVisa表
			switch ($by_date) {
				case 2:
				$result = 'ApplicantVisa.visa_traing_date';//签证培训日期
				break;
				case 3:
				$result = 'ApplicantVisa.visa_appointment_date';//签证日期，表示哪一天去使馆签证
				break;
				case 4:
				$result = 'ApplicantVisa.last_training_date';//签证日期，表示哪一天去使馆签证
				break;
				case 5:
				$result = 'ApplicantVisa.departure_date';//签证日期，表示哪一天去使馆签证
				break;
				case 6:
				$result = 'ApplicantVisa.return_date';//签证日期，表示哪一天去使馆签证
				break;
				default:
				$result = $bean_name.'.created';
				break;
			}
		}
		
		return $result;
	}
	
	/**
	 * 根据提交的表单或者paginator提供的search_url的id来取得查询所用的数组；
	 * 同时要删除提交的表单中所有内容为另或者为空的数据
	 * @param Integer $search_url_id
	 * @param Array $bean
	 */
	private function _handle_search_url($search_url_id,$bean){
		$result = NULL;
		if ($search_url_id) {
			//不为空，表示来自pagination
			$this->loadModel('SearchUrl');
			$this->SearchUrl->id = $search_url_id;
			if ($this->SearchUrl->exists()) {
				$result = array();
				$get_query_str = $this->SearchUrl->field('link');
				parse_str($get_query_str,$result);
			}
		}else{
			//为空，表示来自form的search按钮，这个是有要先生成一个search_url的记录
			//首先把POST的数据转换成GET的字符串,为了减少字符串的长度，需要把用户没有输入的项目给删除掉
			//$bean = $this->request->data['Search'];
			foreach ($bean as $key => $value) {
				if ( strlen(trim($value))==0 || $value==0 ) {
					unset($bean[$key]);
				}
			}
			$get_query_str = http_build_query( $bean );
			if (strlen($get_query_str) > 0) {
				$temp_bean = array();
				$temp_bean['SearchUrl'] = array('link'=>$get_query_str);
				$this->loadModel('SearchUrl');
				$this->SearchUrl->save($temp_bean);
				$result = $this->SearchUrl->id;
			}
		}
		return $result;
	}
	
	private function _build_applicant_options(){
		
	}
	
	private function _build_enquiry_options(){
		
	}
}