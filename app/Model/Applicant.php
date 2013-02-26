<?php
//Import the event for the listeners
App::uses('CakeEvent', 'Event');
class Applicant extends AppModel{
	public $name = 'Applicant';
	public $belongsTo = array(
		'Enquiry',
		'User'=>array(
			'className'=>'User',
			'foreignKey'=>'user_id',
			'fields'=>array('id','name'),
			'recursive'=>-2
		),
		'Orgnization',
		'Project',
		'Source',
		'JobStatus'=>array('foreignKey'=>'job_status'),
		'VisaStatus'=>array('foreignKey'=>'visa_status'),
		'Phase',
		'ProjectStatus',
		'ReturnStatus'
	);
	public $hasOne = array('ApplicantJob','ApplicantVisa','ApplicantItinerary');
	public $hasMany = array(
		'ApplicantFile'
	);
	
	private $rich_msg = array();
/**
	 * 即通过签证的人数。
	 * @param Integer $group_id
	 * @param Integer $project_id
	 * @param boolean $flag
	 */
	public function get_visa($group_id=NULL,$project_id=NULL,$flag = TRUE){
		return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Applicant.group_id=$group_id"):NULL,
							($project_id)?("Applicant.project_id=$project_id"):NULL,
							'Applicant.visa_status=2',//等待2次签证
						)
					),
					'recursive'=>-1,
				));
	}
/**
	 * 有签证日期的人数
	 * @param Integer $group_id
	 * @param Integer $project_id
	 * @param boolean $flag
	 */
	public function waiting_for_visa_appointment($group_id=NULL,$project_id=NULL,$flag = TRUE){
		return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Applicant.group_id=$group_id"):NULL,
							($project_id)?("Applicant.project_id=$project_id"):NULL,
							'or'=>array(
								'Applicant.visa_status=3',//等待2次签证
								'Applicant.visa_status=1'//未开始申请
							) 
						)
					),
					'recursive'=>-1,
				));
	}
/**
	 * “有行前培训的时间等信息的学生总人数”+“不参加总人数”
	 * @param Integer $group_id
	 * @param Integer $project_id
	 * @param boolean $flag
	 */
	public function get_cancelled($group_id=NULL,$project_id=NULL,$flag = TRUE){
		return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Applicant.group_id=$group_id"):NULL,
							($project_id)?("Applicant.project_id=$project_id"):NULL,
							'Applicant.status='.WAS_CANCELED
						)
					),
					'recursive'=>-1,
				));
	}
/**
	 * “有行前培训的时间等信息的学生总人数”+“不参加总人数”
	 * @param Integer $group_id
	 * @param Integer $project_id
	 * @param boolean $flag
	 */
	public function has_before_leaving_training_date($group_id=NULL,$project_id=NULL,$flag = TRUE){
		return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Applicant.group_id=$group_id"):NULL,
							($project_id)?("Applicant.project_id=$project_id"):NULL,
							'Applicant.phase_id>='.PHASE_VISA
						)
					),
					'recursive'=>-1,
				));
	}
/**
	 * 实际有签证预约日期的的人数
	 * @param Integer $group_id
	 * @param Integer $project_id
	 * @param boolean $flag
	 */
	public function has_visa_appointment_date($group_id=NULL,$project_id=NULL,$flag = TRUE){
		return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Applicant.group_id=$group_id"):NULL,
							($project_id)?("Applicant.project_id=$project_id"):NULL,
							'Applicant.phase_id='.PHASE_VISA
						)
					),
					'recursive'=>-1,
					'joins'=>array(
						array(
							'table'=>'applicant_visas',
							'alias' => 'av',
							'type' => 'LEFT',
							'conditions'=>array(
								'and'=>array(
									'Applicant.id=av.applicant_id',
									'av.visa_appointment_date IS NOT NULL'
								) 
							)
						)
					)
				));
	}
	/**
	 * 实际有签证培训日期的的人数
	 * @param Integer $group_id
	 * @param Integer $project_id
	 * @param boolean $flag
	 */
	public function has_visa_training_date($group_id=NULL,$project_id=NULL,$flag = TRUE){
		return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Applicant.group_id=$group_id"):NULL,
							($project_id)?("Applicant.project_id=$project_id"):NULL,
							'Applicant.phase_id='.PHASE_VISA
						)
					),
					'recursive'=>-1,
					'joins'=>array(
						array(
							'table'=>'applicant_visas',
							'alias' => 'av',
							'type' => 'LEFT',
							'conditions'=>array(
								'and'=>array(
									'Applicant.id=av.applicant_id',
									'av.visa_traing_date IS NOT NULL'
								) 
							)
						)
					)
				));
	}
/**
	 * 在学生的签证资料中有160已做好的信息的所有学生的人数总和
	 * @param Integer $group_id
	 * @param Integer $project_id
	 * @param boolean $flag
	 */
	public function done_160($group_id=NULL,$project_id=NULL,$flag = TRUE){
		return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Applicant.group_id=$group_id"):NULL,
							($project_id)?("Applicant.project_id=$project_id"):NULL,
							'Applicant.phase_id>='.PHASE_VISA
						)
					),
					'recursive'=>-1,
					'joins'=>array(
						array(
							'table'=>'applicant_visas',
							'alias' => 'av',
							'type' => 'LEFT',
							'conditions'=>array(
								'and'=>array(
									'Applicant.id=av.applicant_id',
									'av.form160=1'
								) 
							)
						)
					)
				));
	}
	
	/**
	 * 即学生到达申请阶段后准备的几项签证资料未准备好的学生总人数，此项的设置为了便于运营老师点进去后收集学生的申请资料
	 * @param Integer $group_id
	 * @param Integer $project_id
	 * @param boolean $flag
	 */
	public function been_phase($group_id=NULL,$project_id=NULL,$phase_id=NULL,$flag = TRUE){
		return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Applicant.group_id=$group_id"):NULL,
							($project_id)?("Applicant.project_id=$project_id"):NULL,
							($phase_id)?"Applicant.phase_id>=$phase_id":NULL
						)
					),
					'recursive'=>-1
				));
	}
	/**
	 * 即学生到达申请阶段后准备的几项签证资料未准备好的学生总人数，此项的设置为了便于运营老师点进去后收集学生的申请资料
	 * @param Integer $group_id
	 * @param Integer $project_id
	 * @param boolean $flag
	 */
	public function visa_data_done($group_id=NULL,$project_id=NULL,$flag = TRUE,$done=TRUE){
		return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Applicant.group_id=$group_id"):NULL,
							($project_id)?("Applicant.project_id=$project_id"):NULL,
							($done)?'Applicant.visa_data=1':'Applicant.visa_data=0'
						)
					),
					'recursive'=>-1
				));
	}
	
	/**
	 * 即学生到达申请阶段后准备的几项申请资料未准备好的学生总人数，此项的设置为了便于运营老师点进去后收集学生的申请资料
	 * @param Integer $group_id
	 * @param Integer $project_id
	 * @param boolean $flag
	 */
	public function app_data_not_done($group_id=NULL,$project_id=NULL,$flag = TRUE){
		return $this->find(
				($flag)?'count':'all',
				array(
					'conditions'=>array(
						'and'=>array(
							($group_id)?("Applicant.group_id=$group_id"):NULL,
							($project_id)?("Applicant.project_id=$project_id"):NULL,
							'Applicant.application_data=0'
						)
					),
					'recursive'=>-1
				));
	}
	
	/**
	 * 切换学生的状态到赴美阶段
	 * @param Integer $id
	 * @param Array $sender: 就是$this->Auth->user()
	 */
	public function change_to_phase_oversea($id,$sender){
		$this->id = $id;
		$result = FALSE;
		if ($this->saveField('phase_id', PHASE_OVERSEA)) {
			//开始通过监听器来发送邮件和短信
			$result = TRUE;
			$this->inform_student('Model.Applicant.change_to_phase_oversea', $sender,$this->field('enquiry_id'));
		}
		$this->rich_msg['result']=$result;
		return $this->rich_msg;
	}
	
	public function confirm_phase_return($id,$sender){
		$this->id = $id;
		$result = FALSE;
		if ($this->saveField('phase_id', PHASE_RETURN)) {
			//开始通过监听器来发送邮件和短信
			$result = TRUE;
			$this->inform_student('Model.Applicant.change_to_phase_return', $sender,$this->field('enquiry_id'));
		}
		$this->rich_msg['result']=$result;
		return $this->rich_msg;
	}
	
/**
	 * 切换学生的状态到行前阶段
	 * @param Integer $id
	 * @param Array $sender: 就是$this->Auth->user()
	 */
	public function change_to_phase_before_leaving($id,$sender){
		$this->id = $id;
		$result = FALSE;
		if ($this->saveField('phase_id', PHASE_BEFORE_LEAVING)) {
			//开始通过监听器来发送邮件和短信
			$result = TRUE;
			$this->inform_student('Model.Applicant.change_to_phase_before_leaving', $sender,$this->field('enquiry_id'));
		}
		$this->rich_msg['result']=$result;
		return $this->rich_msg;
	}
	

	
	/**
	 * 用来处理从安置状态退回申请状态的学生
	 * @param Integer $id
	 * @param Array $sender
	 */
	public function return_to_phase_apply($id,$sender){
		$this->id = $id;
		$result = FALSE;
		if ($this->saveField('phase_id', PHASE_APPLY)) {
			//开始通过监听器来发送邮件和短信
			$result = $result = $this->inform_student('Model.Applicant.change_to_phase_apply', $sender);
		}
		return $result;
	}
	
	public function return_to_phase_settle($id,$sender){
		$this->id = $id;
		$result = FALSE;
		if ($this->saveField('phase_id', PHASE_SETTLE)) {
			$result = TRUE;
			//开始通过监听器来发送邮件和短信
			App::uses('Enquiry', 'Model');
			$enq = new Enquiry();
			$enq->unbindModel(array('belongsTo'=>array('Group','Source','Channel'),'hasMany'=>array('EnquiryFeedback')));
			$d = $enq->find('first',array(
				'conditions'=>array('Enquiry.id'=>$this->field('enquiry_id')),
				'fields'=>array('Enquiry.name','Enquiry.mobile','Enquiry.email','Project.name')
			));
			$d['User']=$sender; //这是为了在发邮件的时候，能够知道是哪个老师发的邮件，及其姓名
			$event = new CakeEvent('Model.Applicant.change_to_phase_settle',$this,array($d));
			$this->getEventManager()->dispatch($event);
			
			if ($event->isStopped()) {
				return FAILED;
			}
			/*
			if ($event->result['msg'] == FAILED) {
				pr('Email notification false.');
			}
			*/
		}
		return $result;
	}
	
	/**
	 * 更改一个申请人的状态，根据给定的id值，对应的纪录变成phase的值
	 * @param Integer $id
	 * @param Integer $phase
	 */
	public function change_to_phase_settle($id,$sender){
		$ds = $this->getDataSource();
		$ds->begin();
		$this->id = $id;
		$result = FALSE;
		if ($this->saveField('phase_id', PHASE_SETTLE)) {
			//开始加入一条applicant job的纪录
			App::uses('ApplicantJob', 'Model');
			$aj = new ApplicantJob();
			$bean = $aj->find('first',array('conditions'=>array('applicant_id'=>$id)));
			if (is_null($bean['ApplicantJob']['id'])) {
				$bean = array(
					'ApplicantJob'=>array(
						'applicant_id'=>$id,
						'group_id'=>$this->field('group_id')
					)
				);
				if ($aj->save($bean)) {
					$result = TRUE;
				}
			}else{
				//如果已经有app对应的app job纪录存在，就直接使用它了
				$result = TRUE;
			}
		}
		
		if ($result) {
			$ds->commit();
			//开始通过监听器来发送邮件和短信
			$this->inform_student('Model.Applicant.change_to_phase_settle',$sender,$this->field('enquiry_id'));
		}else{
			$ds->rollback();
		}
		$this->rich_msg['result']=$result;
		return $this->rich_msg;
	}
	
	/**
	 * 更改一个申请人的状态，根据给定的id值，对应的纪录变成phase的值
	 * @param Integer $id
	 * @param Integer $phase
	 */
	public function change_to_phase_visa($id,$sender){
		$this->id = $id;
		$result = FALSE;
		if ($this->saveField('phase_id', PHASE_VISA)) {
			$result = TRUE;
			//开始通过监听器来发送邮件和短信
			$this->inform_student('Model.Applicant.change_to_phase_visa',$sender,$this->field('enquiry_id'));
		}
		$this->rich_msg['result']=$result;
		return $this->rich_msg;
	}
	
	/**
	 * 通过注册的监听器类发送消息
	 * @param String $event_name
	 * @param Array $sender
	 */
	private function inform_student($event_name,$sender=NULL,$enquiry_id=NULL){
		//开始通过监听器来发送邮件和短信
			App::uses('Enquiry', 'Model');
			$enq = new Enquiry();
			$enq->unbindModel(array('belongsTo'=>array('Group','Source','Channel'),'hasMany'=>array('EnquiryFeedback')));
			
			$d = $enq->find('first',array(
				'conditions'=>array('Enquiry.id'=>$enquiry_id),
				'fields'=>array('Enquiry.name','Enquiry.mobile','Enquiry.email','Project.name')
			));
			$d['User']=$sender; //这是为了在发邮件的时候，能够知道是哪个老师发的邮件，及其姓名
			$event = new CakeEvent($event_name,$this,array($d));
			$this->getEventManager()->dispatch($event);
			/*
			if ($event->isStopped() || $event->result['msg'] == FAILED) {
				return 2;
			}else{
				return 1;
			}*/
		$this->rich_msg['msg']= $event->result['msg'];
		return;
	}
	
	/**
	 * 当确认某个学生可以称为申请人时，执行的方法。
	 * 1：添加一条新纪录到applicants表中，除了enquiry_id, project_id and user_id(指谁增加的这条纪录)外都是缺省值
	 * 2：立刻更新enquiry表格的is_applicant字段为真
	 * 3：都成功完成之后commit，否则rollback
	 * @param Integer $enquiry_id
	 * @return Boolean
	 */
	public function confirm_applicant($enquiry_id=NULL,$sender){
			$ds = $this->getDataSource();
			$ds->begin();
			$flag = FALSE;
			
			App::uses('Enquiry', 'Model');
			$enquiry = new Enquiry();
			$enquiry->id = $enquiry_id;
			$enquiry->saveField('is_applicant', 1);
			$temp = $enquiry->find('first',array(
				'conditions'=>array('Enquiry.id'=>$enquiry_id),
				'recursive'=>-1,
				'fields'=>array('Enquiry.project_id','Enquiry.task_id','Enquiry.source_id','Enquiry.group_id','Enquiry.slep_scores','Enquiry.name','Enquiry.email','Enquiry.mobile','Project.name','User.name','User.username'),
				'joins'=>array(
					array(
						'table'=>'projects',
						'alias' => 'Project',
						'type' => 'LEFT',
						'conditions'=>array(
							'Enquiry.project_id = Project.id'
						)
					),
					array(
						'table'=>'users',
						'alias' => 'User',
						'type' => 'LEFT',
						'conditions'=>array(
							'User.id' => $sender['id']
						)
					)
				)
			));
			
			//check is there an applicant record already
			$app = $this->find('first',array('conditions'=>array('Applicant.enquiry_id'=>$enquiry_id),'recursive'=>-1));
			if (is_null($app['Applicant']['id'])) {
				$app = array('Applicant'=>array(
					'enquiry_id'=>$enquiry_id,
					'user_id'=>$sender['id'],
					'project_id'=>$temp['Enquiry']['project_id'],  //to get the project name easily
					'source_id'=>$temp['Enquiry']['source_id'],
					'group_id'=>$temp['Enquiry']['group_id'],
					'task_id'=>$temp['Enquiry']['task_id'] //No need, all applicant's slep must pass
					)
				);
				if ($this->save($app)) {
					$flag = TRUE;
				}
			}else{
				//已经有applicant的纪录了，就把它的状态转成申请阶段
				$this->id = $app['Applicant']['id'];
				if($this->saveField('phase_id', PHASE_APPLY)){
					$flag = TRUE;
				}
			}
			
			if ($flag) {
				$ds->commit();
				//the applicant's info has been saved, then send a email to the student
				//需要找出收信学生的邮件，姓名和手机号码,申请的项目名称,这些都要作为邮件的内容发送给学生
				$d = array(
					'Enquiry'=>array(
						'name'=>$temp['Enquiry']['name'],
						'email'=>$temp['Enquiry']['email'],
						'mobile'=>$temp['Enquiry']['mobile']
					),
					'Project'=>array(
						'name'=>$temp['Project']['name']
					),
					'User'=>$sender
				);
				$event = new CakeEvent('Model.Applicant.confirmed',$this,array($d));
				$this->getEventManager()->dispatch($event);
				$this->rich_msg['msg']= $event->result['msg'];
			}else{
				$ds->rollback();
			}
			$this->rich_msg['result']=$flag;
			return $this->rich_msg;
	}
	
	public function cancel($bean = NULL){
		$result = FALSE;
		$ds = $this->getDataSource();
		$ds->begin();
		App::uses('Enquiry', 'Model');
		$enquiry = new Enquiry();
		$enquiry->id = $bean['Enquiry']['id'];
		$bean['Enquiry']['is_applicant'] = 0;
		/*
		$temp = array(
			'Enquiry'=>array(
				'is_applicant'=>0,
				'comments'=>$bean['Applicant']['comments'],
				'status'=>DELETED
			)
		);
		*/
		if($enquiry->save($bean)){
			//enquiry表格已经更新成功
			$temp = $this->find(
				'first',
				array(
					'conditions'=>array('Applicant.enquiry_id'=>$bean['Enquiry']['id']),
					'recursive'=>-1,
					'fields'=>array('Applicant.id','Applicant.status'))
			);
			if ($temp) {
				$this->id = $temp['Applicant']['id'];
				if($this->saveField('status',WAS_CANCELED)){
					$ds->commit();
					$result = TRUE;
				}else{
					$ds->rollback();
				}
			}else{
				//没有找到对应的applicant数据，应该是已经被删除
				$ds->commit();
				$result = TRUE;
			}
		}else{
			//更新enquiry表格失败
			$ds->rollback();
		}
		return $result;
	}
}