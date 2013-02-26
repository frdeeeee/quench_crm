<?php
	class Profile extends AppModel{
		public $name = 'Profile';
		public $belongsTo = array('Enquiry');
		
		public function update_status($id,$sender){
			$result = 0;
			$this->id = $id;
			if ($this->exists()) {
				if($this->saveField('status', 1)){
					//更新成功，学生check-in功能已经被激活
					//发送邮件通知
					$result = $this->inform_student('Model.Profile.update_status', $sender);
					//$result = 1;
				}
			}
			return $result;
		}
		
		private function inform_student($event_name,$sender){
			App::uses('CakeEvent', 'Event');
			App::uses('Enquiry', 'Model');
			$enq = new Enquiry();
			$enq->unbindModel(array('belongsTo'=>array('Group','Source','Channel','Project'),'hasMany'=>array('EnquiryFeedback','Checkin'),'hasOne'=>array('Profile')));
			$d = $enq->find('first',array(
				'conditions'=>array('Enquiry.id'=>$this->field('enquiry_id')),
				'fields'=>array('Enquiry.name','Enquiry.mobile','Enquiry.email')
			));
			$d['User']=$sender; //这是为了在发邮件的时候，能够知道是哪个老师发的邮件，及其姓名
			$event = new CakeEvent($event_name,$this,array($d));
			$this->getEventManager()->dispatch($event);
			if ($event->isStopped() ) {
				return 2;//发送通知失败
			}else if($event->result['msg'] == FAILED){
				return 3;//发送通知失败
			}else if($event->result['msg_sms'] == FAILED){
				return 4;
			}else{
				return 1;
			}
		}
	}