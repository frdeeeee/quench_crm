<?php
	class ShortMessagesController extends AppController{
		public $name = 'ShortMessages';
		public $uses = array('ShortMessage','User','Enquiry');
		public $components = array('Sms');
		
		public $paginate = array(
			'limit' => 20,
			'order' => array(
					'ShortMessage.id'=>'DESC'
			),
			'recursive' => 1
		);
		public function beforeFilter(){
			parent::beforeFilter();
		}
		
		public function beforeRender(){
			$this->set('current_menu','ShortMessages');
		}
		
		
		public function send_sms($enquiry_id = NULL){
			if ($enquiry_id) {
				$this->Enquiry->id = $enquiry_id;
				if ($this->Enquiry->exists() OR false ) {
					//取出登记表，向其中的手机号发送短信
					$enq = $this->Enquiry->read();
					$sms_sending_result = $this->Sms->send(array('mobile_number'=>$enq['Enquiry']['mobile']));
					//检查发送的结果，发送的返回结果是xml，但已经被Sms处理过了，通过toArray变成了数组，形式为Array('string' => -10)
					if ($sms_sending_result['string'] == 1) {
						$this->Session->setFlash('手机短信发送成功');
						$msg_type = 'success';
					}else if($sms_sending_result['string'] == -10){
						$msg_type = 'error';
						$this->Session->setFlash('没有有效的手机号码');
					}
				}else{
					$msg_type = 'error';
					$this->Session->setFlash('手机短信发送失败');
				}
			}else{
				$msg_type = 'error';
				$this->Session->setFlash('系统故障，请刷新并稍候再试');
			}
			//$this->redirect(array('controller'=>'Enquiries','action'=>'list_all_for_operator',$msg_type));
			$this->set('msg_type',$msg_type);
			return;
		}
		
		public function send_email_ajax(){
			if ($this->request->is('ajax')) {
				$this->layout = 'ajax';
				App::uses('YouthEmailComponent', 'Controller/Component');
				$youth_email = new YouthEmailComponent();
				$mail_send_options = array(
					'to' => $this->request->data['receiver_addr'],
					'subject' => $this->request->data['receiver_subject'],
				);
				
				$sms_sending_result = $youth_email->send_simple_mail( 'simple_single_rec_email', NULL, $mail_send_options, $this->request->data['email_content'] );
				$this->set('data', ($sms_sending_result)?1:0 );
				$this->render('ajax_send_message','ajax');
			}
			return;
		}
		
		public function send_sms_ajax(){
			if ($this->request->is('ajax')) {
				$this->layout = 'ajax';
				$sms_sending_result = $this->Sms->send(
						array('mobile_number'=>$this->request->data['receiver_mobile']),
						$this->request->data['message_content']
				);
				$this->set('data',$sms_sending_result);
				$this->render('ajax_send_message','ajax');
			}
			return;
		}
		//群发短信时候所用的方法，因为需要把客户端传来的index回传回去
		public function send_multi_sms_ajax(){
			if ($this->request->is('ajax')) {
				$this->layout = 'ajax';
				$sms_sending_result = $this->Sms->send(
						array('mobile_number'=>$this->request->data['receiver_mobile']),
						$this->request->data['message_content']
				);
				$this->set('data',array('the_index'=>$this->request->data['the_index'],'result'=>$sms_sending_result) );
				$this->render('ajax_send_message','ajax');
			}
			return;
		}
		
		/**
		 * 用户发送短消息的是否执行的方法。支持ajax和post两种方式的发送
		 * Enter description here ...
		 */
		public function add(){
			if ($this->request->is('ajax')) {
				$this->layout = 'ajax';
				$bean = array();
				$bean['ShortMessage']['receiver_id'] = $this->request->data['receiver_id'];
				$bean['ShortMessage']['sender_id'] = $this->request->data['sender_id'];
				$bean['ShortMessage']['content'] = $this->request->data['message_content'];
				if ( $this->ShortMessage->send($bean) ) {
					$this->set('data',1);
				}else{
					$this->set('data',0);
				}
				$this->render('ajax_send_message','ajax');
			}else{
				if (!empty($this->request->data)) {
					if ($this->ShortMessage->send($this->request->data)) {
						$this->Session->setFlash('消息发送成功！');
						$this->redirect(array('action'=>'list_all_send_box','success'));
					}else{
						$this->Session->setFlash('消息发送失败，请稍候再试！');
						$this->redirect(array('action'=>'list_all_send_box','error'));
					}
				}else{
					$this->set('receivers',$this->User->find('list'));
				}
			}
			return ;
		}
		
		/**
		 * 通过ajax，用户来查询是否有新的站内短消息时的响应方法
		 * @param Integer $receiver_id :代表要查询谁的短消息
		 * @return Integer : 返回有几条新的短消息
		 */
		public function get_new_message($receiver_id = NULL){
			if ($this->request->is('ajax')) {
				$result = $this->ShortMessage->find('count',array(
					'conditions'=>array(
						'AND'=>array(
							'ShortMessage.receiver_id' => $this->Auth->user('id'),
							'ShortMessage.is_read' => 0
						) 
					)
				));
				$this->set('data',$result);
				$this->render('ajax_send_message','ajax');
			}
			return;
		}
		
		public function list_all_in_box(){
			$this->paginate['conditions'] = array(
				'AND'=>array(
					'ShortMessage.receiver_id'=>$this->Auth->user('id')
				)
			);
			$this->paginate['joins']=array(
				array(
					'table'=>'enquiries',
					'alias'=>'Enquiry',
					'type'=>'left',
					'conditions'=>array('ShortMessage.sender_id=Enquiry.id')
				)
			);
			$this->paginate['fields']=array(
				'ShortMessage.id','ShortMessage.content','ShortMessage.is_read','ShortMessage.created',
				'Sender.id','Sender.name','Enquiry.name','Enquiry.id','Enquiry.email','Enquiry.mobile'
			);
			$this->set('data',$this->paginate('ShortMessage'));
			return;
		}
		public function list_all_send_box(){
			$this->paginate['conditions'] = array(
				'AND'=>array(
					'ShortMessage.sender_id'=>$this->Auth->user('id')
				)
			);
			$this->set('data',$this->paginate('ShortMessage'));
			return;
		}
		public function remove($message_id = null){
			$this->ShortMessage->id = $message_id;
			$this->ShortMessage->delete($message_id);
			$this->redirect(array('action'=>'list_all_in_box'));
			return;
		}
		
		public function mark_as_readed($message_id = null){
			$this->ShortMessage->id = $message_id;
			if ($this->ShortMessage->exists()) {
				$this->ShortMessage->saveField('is_read',1);
			}
			$this->redirect(array('action'=>'list_all_in_box'));
			return;
		}
	}