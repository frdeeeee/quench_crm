<?php
/**
 * 这个监听器类监视所有的需要发送电子邮件的事件，特别是所有的Applicant有关的操作需要发送很多的电子邮件，还有学生Students控制器中也需要
 */
App::uses( 'CakeEventListener', 'Event');
App::uses('YouthEmailComponent', 'Controller/Component');
App::uses('SmsComponent', 'Controller/Component');
class ApplicantEventListener implements CakeEventListener {
	/*
	 * this method must be implemented
	*/
	function implementedEvents() {
		return array(
			'Model.Applicant.confirmed' => 'inform_applicant_confirmed_by_email', //当运营部的用户确认了某个学生为正式的申请人之后，需要发送的邮件通知的事件
			'Model.Applicant.change_to_phase_oversea' => 'inform_applicant_in_phase_oversea',
			'Model.Applicant.change_to_phase_visa' => 'inform_applicant_in_phase_visa',
			'Model.Applicant.change_to_phase_settle'=>'inform_applicant_in_phase_settle',
			'Model.Applicant.change_to_phase_apply'=>'inform_applicant_return_phase_apply',
			'Model.Applicant.change_to_phase_settle'=>'inform_applicant_return_phase_settle',
			'Model.Profile.update_status'=>'inform_student_is_activated',
			'Model.Applicant.change_to_phase_before_leaving'=>'inform_applicant_in_phase_before_leaving',
			'Model.Applicant.change_to_phase_return'=>'inform_applicant_in_phase_return'
		);
	}
	
	public function inform_applicant_in_phase_return($event){
		$this->send_email(
			$event,
			'你好，'.$event->data[0]['Enquiry']['name'].', 欢迎回国。', 
			'inform_applicant_in_phase_return'
		);
		//$this->send_sms($event, 'check_in_activated');
		return;
	}
	
	public function inform_student_is_activated($event){
		$this->send_email(
			$event,
			'你好，'.$event->data[0]['Enquiry']['name'].', 您的Check-in功能已经被激活。', 
			'check_in_activated'
		);
		$this->send_sms($event, 'check_in_activated');
		return;
	}
	
	/**
	 * 响应学生被转到行前阶段的事件处理方法。
	 * @param mix $event
	 */
	public function inform_applicant_in_phase_before_leaving($event){
		$event->data[0]['Enquiry']['phase_name'] = '行前阶段';
		return $this->send_email(
			$event,
			'你好，'.$event->data[0]['Enquiry']['name'].', 您的申请现在到了行前准备阶段。', 
			'inform_applicant_in_phase_before_leaving'
		);
	}
	
	/**
	 * 响应学生被退回到安置阶段的事件处理方法。改方法统一使用一个邮件模版，return_phase
	 * @param mix $event
	 */
	public function inform_applicant_return_phase_settle($event){
		$event->data[0]['Enquiry']['phase_name'] = '安置阶段';
		return $this->send_email(
			$event,
			'你好，'.$event->data[0]['Enquiry']['name'].', 您的申请现在重新回到了安置阶段。', 
			'return_phase'
		);
	}
	
	public function inform_applicant_return_phase_apply($event){
		$event->data[0]['Enquiry']['phase_name'] = '申请材料准备阶段';
		return $this->send_email(
			$event,
			'你好，'.$event->data[0]['Enquiry']['name'].', 您的申请现在重新到了申请材料准备阶段。', 
			'return_phase'
		);
	}
	
	public function inform_applicant_in_phase_settle($event){
		return $this->send_email(
			$event,
			'你好，'.$event->data[0]['Enquiry']['name'].', 您的申请已经进入了安置阶段。', 
			'inform_applicant_in_phase_settle'
		);
	}
	
	/**
	 * 处理一个学生从签证阶段进入赴美阶段的事件
	 */
	public function inform_applicant_in_phase_oversea($event){
		return $this->send_email(
			$event,
			'你好，'.$event->data[0]['Enquiry']['name'].', 您的申请已经进入了赴美阶段。', 
			'inform_applicant_in_phase_oversea'
		);
	}
	
	/**
	 * 处理一个学生从申请阶段进入签证阶段的事件
	 */
	public function inform_applicant_in_phase_visa($event){
		return $this->send_email(
			$event,
			'你好，'.$event->data[0]['Enquiry']['name'].', 您的申请已经进入了签证阶段。', 
			'inform_applicant_in_phase_visa'
		);
	}
	
	/**
	 * 监听一个学生正式成为申请人的事件的处理类
	 * @param mix $event
	 */
	public function inform_applicant_confirmed_by_email($event){
		return $this->send_email(
			$event,
			'你好，'.$event->data[0]['Enquiry']['name'].', 欢迎来到优势项目的大家庭。', 
			'applicant_confirmed'
		);
	}
	
	/**
	 * 私有方法，专门提供发送邮件的功能
	 * @param mix $event ：事件对象
	 * @param String $email_subject：发送邮件的标题
	 * @param String $email_template  ：邮件内容对应的模版，也可以是短信的
	 */
	private function send_email($event,$email_subject,$email_template){
		$youth_email = new YouthEmailComponent();
		$mail_send_options = array(
			'to' => $event->data[0]['Enquiry']['email'],
			'subject' => $email_subject,
		);
		//尝试向用户发送一封电子邮件
		if ( $youth_email->send_mail($email_template,NULL,$mail_send_options,$event->data[0])  ) {
				//发送邮件成功,通知用户
				$event->result['msg'] = SUCCESS;
		}else{
				//发送邮件失败，但是数据已经保存，则不提示用户收邮件
				$event->result['msg'] = FAILED;
		}
	}
	
	/**
	 * 私有方法，专门提供发送手机短消息的功能  wukefei@youth-edu.org
	 * @param mix $event
	 * @param string $sms_template
	 */
	private function send_sms($event,$content_key){
		$youth_sms = new SmsComponent();
		//按照收信手机号码和template发送
		$receiver = array(
			'mobile_number'=>$event->data[0]['Enquiry']['mobile'],
			'name'=>$event->data[0]['Enquiry']['name']
		);
		//这里是按照模版来发送的
		if($youth_sms->send_template( $receiver,$content_key )){
			//发送短信成功,通知用户
			$event->result['msg_sms'] = SUCCESS;
		}else{
			$event->result['msg_sms'] = FAILED;
		}
	}
	
}