<?php
class Enquiry extends AppModel{
	public $name = 'Enquiry';
	public $belongsTo = array(
		'Group','Project','Source','Presentation','Customer',
		'User'=>array(
			'className'=>'User',
			'foreignKey'=>'user_id',
			'fields'=>array('id','name'),
			'recursive'=>-2
		),
		'ApplyFeeStatus'=>array(
			'className'=>'ApplyFeeStatus',
			'foreignKey'=>'apply_fee_status_id'
		),
		'ContractStatus'=>array(
			'className'=>'ContractStatus',
			'foreignKey'=>'contract_status_id'
		),
		'ProjectFeeStatus'=>array(
			'className'=>'ProjectFeeStatus',
			'foreignKey'=>'project_fee_status_id'
		)
	);
	public $hasOne = array('Profile');
	public $hasMany = array('EnquiryFeedback','MoneyReturn',
		'Checkin'=>array(
			'order'=>'Checkin.id desc',
			'fields'=>array('Checkin.id','Checkin.created','Checkin.modified','Checkin.status','Checkin.is_updated_by_student','Checkin.teacher_notes'))
	);
	public $validate = array(
			'name' => array(
					'Please enter your name' => array(
							'rule' => 'notEmpty',
							'message' => '请输入用户的名称!'
					)
			),
			'mobile'=>array(
					'Mobile_Min' => array(
							'rule' => array('minLength',8),
							'message' => '报名学生的手机号码长度不对!'
					),
					'Mobile_max' => array(
							'rule' => array('maxLength',11),
							'message' => '报名学生的手机号码长度不对!'
					),
					'Mobile is number' => array(
							'rule' => 'numeric',
							'message' => '手机号码只能是阿拉伯数字!'
							),
					/*
					'mobile_exists'=>array(
							'rule'=>'isUnique',
							'message'=>'这个手机号码已经存在于系统中'
							)
					*/
					),
			'email' => array(
					'email_format_check'=>array(
							'rule'=>'email',
							'message'=>'报名学生的邮件格式不对！'
							),
							/*
					'email_exists'=>array(
							'rule'=>'isUnique',
							'message'=>'这个电子邮件已经存在于系统中'
							)*/
					)
					
	);
	
	/**
	 * 根据给定的group id 取得所有参加或未参加slep的人数
	 * @param integer $group_id
	 * @param boolean $flag: 如果为真，给出人数，如果未false，给出纪录
	 */
	public function total_enquiry_is_app($group_id=NULL,$project_id=NULL,$flag = TRUE){
			return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Enquiry.group_id=$group_id"):NULL,
							($project_id)?("Enquiry.project_id=$project_id"):NULL,
							'Enquiry.is_applicant=1'
						)
					),
					'recursive' => ($flag)?(-1):1
				));
	}
	
	public function total_slep_not_pass($group_id=NULL,$project_id=NULL,$flag = TRUE,$pass = TRUE){
		return $this->total_slep_pass($group_id,$project_id,$flag,FALSE);
	}
	
	/**
	 * 根据给定的group id 取得所有参加或未参加slep的人数
	 * @param integer $group_id
	 * @param boolean $flag: 如果为真，给出人数，如果未false，给出纪录
	 */
	public function total_slep_pass($group_id=NULL,$project_id=NULL,$flag = TRUE,$pass = TRUE){
			return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Enquiry.group_id=$group_id"):NULL,
							($project_id)?("Enquiry.project_id=$project_id"):NULL,
							($pass)?'Enquiry.slep_scores>=42':'Enquiry.slep_scores<42'
						)
					),
					'recursive' => ($flag)?(-1):1
				));
	}
	
	public function total_slep_not_attend($group_id=NULL,$project_id=NULL,$flag = TRUE,$attend = TRUE){
		return $this->total_slep_attend($group_id,$project_id,$flag,FALSE);
	}
	
	/**
	 * 根据给定的group id 取得所有参加或未参加slep的人数
	 * @param integer $group_id
	 * @param boolean $flag: 如果为真，给出人数，如果未false，给出纪录
	 */
	public function total_slep_attend($group_id=NULL,$project_id=NULL,$flag = TRUE,$attend = TRUE){
			return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Enquiry.group_id=$group_id"):NULL,
							($project_id)?("Enquiry.project_id=$project_id"):NULL,
							($attend)?'Enquiry.slep_scores>0':'Enquiry.slep_scores=0'
						)
					),
					'recursive' => ($flag)?(-1):1
				));
	}
	
	/**
	 * 根据给定的group id 取得所有的提交了中文报名表的人数
	 * @param integer $group_id
	 * @param boolean $flag: 如果为真，给出人数，如果未false，给出纪录
	 */
	public function total_app_form_submitted($group_id=NULL,$project_id=NULL,$flag = TRUE){
			return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Enquiry.group_id=$group_id"):NULL,
							($project_id)?("Enquiry.project_id=$project_id"):NULL,
							'Enquiry.is_app_form_submit'=>1
						)
					),
					'recursive' => ($flag)?(-1):1
				));
	}
	
	/**
	 * 根据给定的group id 取得所有的报名人数
	 * @param integer $group_id
	 * @param boolean $flag: 如果为真，给出人数，如果未false，给出纪录
	 */
	public function total_enquiry($group_id=NULL,$project_id=NULL,$flag = TRUE){
			return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Enquiry.group_id=$group_id"):NULL,
							($project_id)?("Enquiry.project_id=$project_id"):NULL,
						)
					),
					'recursive' => ($flag)?(-1):1
				));
	}
	
	/**
	 * 增加一个新的学生纪录的实际执行方法
	 * $request_data包含了用户提交的表单数据。$money_return_sum是对应的给学校或代理商的返点金额。$possible_project_group_pair是当前操作用户可用的project id和group id的值对
	 * @param array $request_data
	 * @param Integer $money_return_sum
	 * @param array $possible_project_group_pair
	 */
	public function add_new_enquiry($request_data=NULL,$money_return_sum=NULL,$possible_project_group_pair = NULL){
		if ( is_array($request_data['Enquiry']['how_to_konw_youthedu'] ) && count($request_data['Enquiry']['how_to_konw_youthedu'])>0) {
				$str = '';
				foreach( $request_data['Enquiry']['how_to_konw_youthedu'] as $value){
					$str .= $value.',';
				}
				$request_data['Enquiry']['how_to_konw_youthedu'] = $str;
		}
		//首先从customer库中取出合同中约定的返点金额
		$request_data['Enquiry']['money_return_sum'] = (is_null($money_return_sum))?0:$money_return_sum;
		
		/*
		//对传入的group project的值对进行整理
		$group_project_pair = array();
		foreach ($possible_project_group_pair as $value) {
			$group_project_pair[$value['Project']['id']]=$value['Group']['id'];
		}
		
		
		//检查学生选择对几个项目感兴趣
		$ds = $this->getDataSource();
		$ds->begin();
		$result = TRUE;
		//检查是否操作员选择了学生感兴趣的项目
		if (count($request_data['Enquiry']['interested_projects']) > 0) {
			if (!in_array($request_data['Enquiry']['project_id'], $request_data['Enquiry']['interested_projects'])) {
				//如果默认的project id不在选择中，就把他加入到其中
				$request_data['Enquiry']['interested_projects'][] = $request_data['Enquiry']['project_id'];
			}
			$interest_projects = $request_data['Enquiry']['interested_projects'];
			//根据project_id找出task_id
			unset($request_data['Enquiry']['interested_projects']);
			foreach ( $interest_projects as $value) {
				$request_data['Enquiry']['project_id'] = $value;
				$request_data['Enquiry']['group_id'] = $group_project_pair[$value];
				if (!$this->save($request_data)) {
					$result = FALSE;
					break;
				}else{
					$this->id = NULL;
				}
			}
		}else{
			//表示操作员没有选择任何的一项，那么就使用当前登陆的
			if (!$this->save($request_data)) {
				$result = false;
			}
		}
		
		if ($result) {
			$ds->commit();
		}else{
			$ds->rollback();
		}
		*/
		return $this->save($request_data);
	}
	
	public function student_login($bean = NULL){
		$this->unbindModel(array('belongsTo'=>array('Group','Project','Source','Channel')));
		return $this->find('first',array(
			'conditions'=>array(
				'AND'=>array(
					'Enquiry.email LIKE'=>$bean['Enquiry']['username'],
					'Enquiry.mobile LIKE'=>$bean['Enquiry']['password'],
					'Enquiry.status'=>NORMAL,
					'Enquiry.is_applicant=1'//必须是申请人才可登陆,
				)
			),
			'joins'=>array(
				array(
					'table'=>'applicants',
					'alias'=>'Applicant',
					'type'=>'LEFT',
					'conditions'=>array(
						'Enquiry.id=Applicant.enquiry_id'
					)
				),
				array(
					'table'=>'users',
					'alias'=>'User',
					'type'=>'LEFT',
					'conditions'=>array(
						'User.id=Applicant.user_id'
					)
				)
			),
			'fields'=>array(
				'Enquiry.id','Enquiry.name','Enquiry.project_id','User.id','User.name','User.username','Applicant.phase_id'//取得当前学生在哪个阶段的信息
			)
		));
	}
	
	public function get_today_enquiries($group_id = null){
		//App::uses('CakeTime', 'Utility');
		$pattern = 'Y-m-d';
		$yesterday =  mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
		if ( $group_id ) {
			return $this->find('all',array(
					'conditions'=>array(
							'AND'=>array(
									'Enquiry.group_id'=>$group_id,
									'Enquiry.status'=>NORMAL,
									'Enquiry.created>'."'".Date($pattern,$yesterday)."'"
								)
							),
					'order'=>array('Enquiry.id'=>'DESC')
					));
		}else{
			//表示是高级的领导，给出全部的
			return $this->find('all',array(
					'conditions'=>array(
								'AND'=>array(
									'Enquiry.created='."'".Date($pattern,$yesterday)."'",
									'Enquiry.status'=>NORMAL
								)	
							),
					'order'=>array('Enquiry.id'=>'DESC')
					));
		}
	}
	/**
	 * 搜索enquiry的方法，通过给定的关键字来寻找
	 * @param array $param : school, name, mobile
	 */
	public function search($param,$group_id){
		$option = array();
		$name = $param['name'];
		$school = $param['school'];
		$mobile = $param['mobile'];
		$option['conditions'] = array(
			'AND'=>array(
				(strlen($school)>0)?array('Enquiry.school LIKE'=>"%$school%"):NULL,
				(strlen($name)>0)?array('Enquiry.name LIKE'=>"%$name%"):NULL,
				(strlen($mobile)>0)?array('Enquiry.mobile LIKE'=>"%$mobile%"):NULL,
				'Enquiry.is_applicant' => 0,
				'Enquiry.group_id'=>$group_id,
				'Enquiry.status'=>NORMAL
			)
		);
		$option['order'] = array('Enquiry.id DESC');
		return $this->find('all',$option);
	}
	
	/**
	 * 删除报名者的纪录，同时也删除可能的applicant的纪录
	 * @param Integer $id
	 */
	public function remove($id){
		$this->id = $id;
		if ($this->saveField('status', DELETED) ) {
				App::uses('Applicant', 'Model');
				$app = new Applicant();
				$temp = $app->find('first',array('conditions'=>array(
					'Applicant.enquiry_id'=>$id
				)));
				if ($temp['Applicant']['id']) {
					$app->id = $temp['Applicant']['id'];
					if($app->saveField('status', DELETED)){
						return TRUE;
					}else{
						return FALSE;
					}
				}else{
					return TRUE;
				}
		}else{
			return FALSE;
		}
	}
	
/**
	 * 删除报名者的纪录，同时也删除可能的applicant的纪录
	 * @param Integer $id
	 */
	public function restore($id){
		$this->id = $id;
		if ($this->saveField('status', NORMAL) ) {
				App::uses('Applicant', 'Model');
				$app = new Applicant();
				$temp = $app->find('first',array('conditions'=>array(
					'Applicant.enquiry_id'=>$id
				)));
				if ($temp['Applicant']['id']) {
					$app->id = $temp['Applicant']['id'];
					if($app->saveField('status', NORMAL)){
						return TRUE;
					}else{
						return FALSE;
					}
				}else{
					return TRUE;
				}
		}else{
			return FALSE;
		}
	}
}