<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
	//public $layout = 'default_cake';
	public $components = array(
				'Session', 
				'Auth'=>array(
					'loginRedirect' => array('controller'=>'Contacts', 'action'=>'dashboard'),
					'logoutRedirect' => array('controller'=>'Users', 'action'=>'login'),
					'authError' => 'You can not access that page',
					'authorize' => array('Controller')  //这是一个回调方法，指向下面的isAuthorized方法，表示究竟如何验证用户的登录
				)
				//'Cookie'
	); 
	public $helpers = array('Html','Form','Mytext','Session','Msg','ActionsBox','Paginator'); //Msg是自定义的帮助类,'Facebook.Facebook'
	public $uses = array('Group','GroupUser','Announcement','User','ShortMessage');
	
	protected $cached_data = NULL;
	/**
	 * 这个方法是告诉CakePHP，那些登录的用户可以去访问哪些action
	 * @param User $user
	 * @return boolean
	 */
	public function isAuthorized($user){
		return $this->Auth->user('id');
	}
	
	public function beforeFilter(){
		$this->Auth->allow('login','home','logout','download_template','download');
		$this->set('current_user',$this->Auth->user() );
		$this->set('latest_announcement',
			$this->Announcement->find('first',array(
					'conditions'=>array('Announcement.audience'=>0)
					,'order'=>array('Announcement.id'=>'DESC')))
		);
		$this->set('receivers',$this->User->find('list',array('conditions'=>array('User.available=1'),'fields'=>array('id','name'))));
		
		$this->set('is_new_message',$this->ShortMessage->find('count',array(
			'conditions'=>array(
				'AND'=>array(
					'ShortMessage.receiver_id'=>$this->Auth->user('id'),
					'ShortMessage.is_read=0'
				)
			)
		)));
		
		$this->cached_data = $this->get_cached_data();
		if (!is_null($this->cached_data)) {
			$this->set_common_used_variables();
		}
		
		$this->set('employees',$this->User->find('list',array(
			'fields'=>array('id','name')
		)));
		/*
		$this->loadModel('UsefulUrl');
		$my_excel_reports = array();
		$my_excel_reports = $this->UsefulUrl->find('all',array(
			'conditions'=>array(
				'UsefulUrl.user_id'=>$this->Auth->user('id')
			),
			'fields'=>array('UsefulUrl.name','UsefulUrl.search_url_id')
		));
		$this->set('my_excel_reports',$my_excel_reports);
		*/
		
		//Cache::clear();
		//pr($this->cached_data);
	}
	
	/**
	 * 根据schema来自动获取数据库的字段，为在view生成form表单提供方便的方法，供所有控制器使用
	 * Enter description here ...
	 */
	protected function _get_fields($bean_name){
		$this->loadModel($bean_name);;
		$fields = $this->$bean_name->schema();
		$data = array();
			foreach ($fields as $key=>$value){
				if(isset($value['comment']) && !empty($value['comment'])){
					$data[$bean_name.'.'.$key] = $value['comment'];//运营已阅
				}
			}
		return $data;
	}
	
	private function set_common_used_variables(){
		/*	
		$this->set('sources',$this->cached_data['sources']);
			$this->set('projects',$this->cached_data['projects']);
			$this->set('provinces',$this->cached_data['provinces']);
			$this->set('fee_types',$this->cached_data['fee_types']);
			$this->set('apply_fee_status',$this->cached_data['apply_fee_status']);
			$this->set('contract_status',$this->cached_data['contract_status']);
			$this->set('project_fee_status',$this->cached_data['project_fee_status']);
			$this->set('phases',$this->cached_data['phases']);
			$this->set('visa_status',$this->cached_data['visa_status']);
			$this->set('contract_status',$this->cached_data['contract_status']);
			$this->set('training_methods',$this->cached_data['training_methods']);
			$this->set('embassys',$this->cached_data['embassys']);
			$this->set('project_status',$this->cached_data['project_status']);
			$this->set('return_status',$this->cached_data['return_status']);
			$this->set('orgnizations',$this->cached_data['orgnizations']);
			$this->set('job_status',$this->cached_data['job_status']);
		*/
			$this->set('customer_types',$this->cached_data['customer_types']);
			$this->set('states',$this->cached_data['states']);
			return;
	}
	
	/**
	 * This function is just used for caching those data from db such as Province,States...
	 */
	private function get_cached_data(){
		$cache_data = Cache::read('cache_data','default');
		if (!$cache_data) {
			//start loading the cache data;
			$cache_data = array();
			/*
			$this->loadModel('ContractStatus');
			$this->loadModel('TrainingMethod');
			$this->loadModel('Embassy');
			$this->loadModel('ProjectStatus');
			$this->loadModel('ReturnStatus');
			$this->loadModel('VisaStatus');
			$this->loadModel('Province');
			$this->loadModel('Project');
			$this->loadModel('Orgnization');
			$this->loadModel('Source');
			$this->loadModel('FeeType');
			$this->loadModel('ApplyFeeStatus');
			$this->loadModel('ContractStatus');
			$this->loadModel('ProjectFeeStatus');
			$this->loadModel('Phase');
			$this->loadModel('JobStatus');
			*/
			$this->loadModel('CustomerType');
			$this->loadModel('State');
			
			
			//用来给搜索页面提供组织列表用的
			$cache_data = array(
			/*
				'provinces'=>$this->Province->find('list'),
				'contract_status' => $this->ContractStatus->find('list'),
				'projects'=>$this->Project->find('list'),
				'sources'=>$this->Source->find('list'),
				'orgnizations'=>$this->Orgnization->find('list'),
				'fee_types'=>$this->FeeType->find('list'),
				'apply_fee_status'=>$this->ApplyFeeStatus->find('list'),
				'contract_status'=>$this->ContractStatus->find('list'),
				'project_fee_status'=>$this->ProjectFeeStatus->find('list'),
				'phases'=>$this->Phase->find('list'),
				'visa_status'=>$this->VisaStatus->find('list'),
				'training_methods'=>$this->TrainingMethod->find('list'),
				'embassys'=>$this->Embassy->find('list'),
				'project_status'=>$this->ProjectStatus->find('list'),
				'return_status'=>$this->ReturnStatus->find('list'),
				'job_status'=>$this->JobStatus->find('list'),
			*/
				'states' => $this->State->find('list'),
				'customer_types'=>$this->CustomerType->find('list')
			);
			Cache::write('cache_data', $cache_data);
		}
		return $cache_data;
	}
	
	/**
	 * 根据给定的用户id返回所属的组的字符串形式
	 * @param Integer $user_id
	 * @return mixed
	 */
	public function get_group_leaders_in_string($groups = null){
		$str = '';
		if (!is_null($groups)) {
			if (!is_null($groups) && count($groups)>0) {
				foreach ($groups as $value){
					$str .= $value['Group']['group_leader'].',';
				};
				$str = substr($str,0,strlen($str)-1);
			}
		}
		return $str;
	}
	
	protected function init_auto_complete_data(){
		//加入本组的报名学生的列表，给自动补全用
			$enquiry_names = $this->Enquiry->find('all',array(
				'conditions'=>array(
					'Enquiry.group_id'=>$this->Session->read('my_group')
				),
				'fields'=>array('Enquiry.name','Enquiry.school','Enquiry.id'),
				'recursive'=>-1
			));
			$this->set('enquiry_names',$enquiry_names);
		
		//加入本组的学校的列表，给自动补全用
			$this->loadModel('Customer');
			$school_names = $this->Customer->find('all',array(
				'conditions'=>array(
					'and'=>array(
						'Customer.group_id'=>$this->Session->read('my_group'),
						'Customer.customerType_id'=>1
					) 
				),
				'fields'=>array('Customer.name'),
				'recursive'=>-1
			));
			$this->set('school_names',$school_names);
	}
	
	/**
	 * 自动根据搜索表单的字段添加搜索条件的方法，对搜索表单的input的name有特殊要求
	 * @param array $conditions: 按地址传送来的已有条件
	 * @param array $except: 不需要加model的名字，凡是已这个modeol为名字的，不加入搜索条件中
	 */
	protected function add_search_options($conditions,$fields=NULL,$joins=NULL,$except=array(),$current_query_id=NULL){
		if (is_null($current_query_id)) {
			foreach ($this->request->data['Search'] as $key=>$value) {
				if (strlen($value)>0 ) {
					$arr = split('__', $key);
					if (!in_array($arr[0], $except)) {
						if ( in_array($arr[1], array('name','company_name','employer_address','job_title')) ) {
							$conditions['AND'][$arr[0].'.'.$arr[1].' LIKE']="%$value%";
						}else if($arr[1]=='from'){
							//签证日期的起始
							$conditions['AND'][] = $arr[0].".visa_appointment_date>'$value'";
						}else if($arr[1]=='to'){
							$conditions['AND'][] = $arr[0].".visa_appointment_date<'$value'";
						}else{
							$conditions['AND'][$arr[0].'.'.$arr[1]]=$value;
						}
					}
					//按照激活的状态构造查找条件，status 0 为未激活，1为已经激活
					if ($arr[0]=='Profile' && $arr[1]=='status') {
						foreach($this->paginate['joins'] as &$join){
							if ($join['alias']=='Profile') {
								$join['conditions']=array('and'=>array("Profile.status=$value",'Profile.enquiry_id=Enquiry.id'));
							}
						}
					}
					//$checkin_status = array(1=>'逾期未提交',2=>'状态正常'); 按照checkin的状态构造查询的条件
					if ($arr[0]=='Profile' && $arr[1]=='modified') {
						foreach($this->paginate['joins'] as &$join){
							if ($join['alias']=='Profile') {
								$deadline  = date('Y-m-d', mktime(0, 0, 0, date("m")  , date("d")-30, date("Y")) ) ;
								switch ($value) {
									case 1://逾期未提交
										$join['conditions']=array('and'=>array("Profile.modified<'$deadline'",'Profile.enquiry_id=Enquiry.id'));
										break;
									case 2://状态正常
										$join['conditions']=array('and'=>array("Profile.modified>='$deadline'",'Profile.enquiry_id=Enquiry.id'));
										break;
									default:
										;
									break;
								}
								$join['conditions'][]="Profile.status=$value";
							}
						}
					}
				};
			}
			//构建查询条件的字符串
			$temp_arr = array('conditions'=>$conditions,'fields'=>$fields);
			if ($joins) {
				//有的时候需要使用joins
				$temp_arr['joins']=$joins;
			}
			$str = http_build_query($temp_arr);
			//保存当前搜索的条件到数据库中
			$this->loadModel('SearchUrl');
			//先检查申请的link是不是已经存在了
			$bean = $this->SearchUrl->find('first',array('conditions'=>array('link LIKE "'.$str.'"')));
			if (count($bean['SearchUrl']['id'])==0) {
				$bean = array(
					'SearchUrl'=>array(
						'link'=>$str
					)
				);
				$this->SearchUrl->save($bean);
				$this->set('current_query_id',$this->SearchUrl->id);
			}else{
				$this->set('current_query_id',$bean['SearchUrl']['id']);
			}
		}else{
			$conditions = $this->parse_query_id($current_query_id);
		}
		return $conditions;
	}
	
	/**
	 * 根据传入的queryid取数据库中查询，讲返回的link字段转换成需要的条件数组并返回。
	 * 同时set current_query_id到页面
	 * @param Integer $current_query_id
	 */
	protected function parse_query_id($current_query_id){
		$cond = array();
		//从数据库中直接取得原来保存的link，解析之后返回
		$this->loadModel('SearchUrl');
		$this->SearchUrl->id = $current_query_id;
		$str_query = $this->SearchUrl->field('link');
		parse_str($str_query,$cond);
		$this->set('current_query_id',$current_query_id);
		return $cond;
	}
	
	/**
	 * 这个私有方法是根据给定的to_excel来判定是用paginate还是一般的执行数据库的查询，主要是为了解决重复的代码
	 * @param integer $to_excel
	 */
	protected function _do_query( $to_excel,$fields,$conditions , $file_name='youthedu_report_applicant_' ){
		$this->loadModel('Applicant');
		if ($to_excel==0) {
			$this->paginate['fields']=$fields;
			$this->paginate['conditions'] = $conditions;
			$d = $this->paginate('Applicant');
		}else{
			$d = $this->Applicant->find('all',array(
				'conditions'=>$conditions,
				'fields'=>$fields,
				'order'=>array('Applicant.phase_id'=>'ASC')
			));
			$this->layout='excel';
			$this->set('output_file_name',$file_name.date('Y-m-d',time()).'.xls');
		}
		return $d;
	}
	protected function _do_query_enquiry( $to_excel,$fields,$conditions , $file_name='youthedu_report_applicant_' ){
		$this->loadModel('Enquiry');
		if ($to_excel==0) {
			$this->paginate['fields']=$fields;
			$this->paginate['conditions'] = $conditions;
			$d = $this->paginate('Enquiry');
		}else{
			$d = $this->Enquiry->find('all',array(
				'conditions'=>$conditions,
				'fields'=>$fields,
				'order'=>array('Enquiry.id'=>'desc')
			));
			$this->layout='excel';
			$this->set('output_file_name',$file_name.date('Y-m-d',time()).'.xls');
		}
		return $d;
	}
	
	protected function get_my_groups(){
		$this->loadModel('GroupUser');
		return $this->GroupUser->find('list',array(
				'conditions'=>array('GroupUser.user_id'=>$this->Auth->user('id')),
				'fields'=>array('GroupUser.group_id')
			));
	}
	
	/**
	 * 根据给定的group id数组，找出被分配的项目的信息
	 * 如果第二个参数为真，表示要返回list类型的数组
	 * 如果为假，则直接返回查询的结果数组
	 */
	protected function get_my_projects($group_ids_array=NULL,$in_list_format_flag = TRUE){
		$comma_separated_group_id = implode(',', $group_ids_array);
			//只取出当前用户参与的项目
			$t_tasks = $this->Task->find('all',array(
				'conditions'=>array(
					'and'=>array(
						'Task.status'=>NORMAL,
						'Task.group_id IN('.$comma_separated_group_id.')'
					)
				),
				'fields'=>array('Project.id','Project.name','Group.id')
			));
		if ($in_list_format_flag) {
			$t_projects = array();
			foreach ($t_tasks as $value){
				$t_projects[$value['Project']['id']]=$value['Project']['name'];
			}
			return $t_projects;
		}else{
			return $t_tasks;
		}
	}
	
	protected function _set_customers(){
		$arr = $this->get_my_groups();
		$this->set('Customers',$this->Customer->find('list',
				array('conditions'=>array(
							'and'=>array(
								'Customer.group_id IN('.implode(',',$arr).')',
								'Customer.available'=>1
							)	
			))));
	}
}
