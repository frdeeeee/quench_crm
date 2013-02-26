<?php
App::uses( 'CakeEventListener', 'Event');
App::uses( 'ShortMessage', 'Model');
class Messenger implements CakeEventListener {
	/*
	 * this method must be implemented
	*/
	function implementedEvents() {
		return array(
				'Model.Meeting.add' => 'inform_participants_new',  //任何人发起了一个会议，之后要通过短消息系统通知与会者
				'Model.Meeting.delete' => 'inform_participants_cancel'  //任何人发起了一个会议，之后要通过短消息系统通知与会者
		);
	}
	
	public function inform_participants_cancel($event){
		//给所有与会者发信
		$content = 'Notice：The meeting on '.$event->data[0]['Meeting']['hold_on'].' about "'.$event->data[0]['Meeting']['name'].'" has been cancelled!';
		if ( $this->tell_everyone($event->data[0]['MeetingUser'],$event->data[0]['Meeting']['sponsor'],$content) ) {
			$event->result['msg'] = SUCCESS;;
		}else{
			$event->result['msg'] = FAILED;
		}
		return;
	}
	
	public function inform_participants_new($event){
		$content = 'Notice: You have been invited to attend the meeting hold on '.$event->data[0]['Meeting']['hold_on'].'. Subject: "'.$event->data[0]['Meeting']['name'].'". ';
		if ( $this->tell_everyone($event->data[0]['MeetingUser'],$event->data[0]['Meeting']['sponsor'],$content) ) {
			$event->result['msg'] = SUCCESS;;
		}else{
			$event->result['msg'] = FAILED;
		}
		return;
	}
	
	private function tell_everyone( $receivers, $sender_id ,$content ){
		$short_message = new ShortMessage();
		$ds = $short_message->getDataSource();
		$ds->begin();
		$flag = true;
		foreach ($receivers as $value) {
			$short_message->create();
			$sms = array(
					'ShortMessage'=>array(
							'sender_id'=>$sender_id,
							'receiver_id' => $value['user_id'],
							'content'=>$content
							)
					);
			if(!$short_message->save($sms)){
				$flag = false;
				break;
			}
		}
		if ($flag) {
			$ds->commit();
		}else{
			$ds->rollback();
		}
		return $flag;
	}

	public function updateHits($event){
		//pr($event->subject());
		$subject = $event->subject();
		$subject->id = $event->data['subject_id'];
		$hits = $subject->field('hits')+1;
		$subject->saveField('hits',$hits);
		pr( Debugger::trace() );
		pr('update hits');
		$event->result['msg'] = 'success';
		return;
	}
}