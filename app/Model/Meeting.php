<?php
App::uses('CakeEvent', 'Event');
class Meeting extends AppModel{
	public $name = 'Meeting';
	public $recursive = 2;
	public $belongsTo = array('Sponsor'=>array(
			'className'=>'User',
			'foreignKey'=>'sponsor'
			));
	public $hasMany = array('MeetingUser');
	public $hasOne = array('MeetingMinute'=>array(
				'className'=>'MeetingMinute',
				'foreighKey'=>'meeting_minutes'
			));

	public $validate = array(
			'name' => array(
					'Please enter your name' => array(
							'rule' => 'notEmpty',
							'message' => 'Please enter the subject!'
					)
			),
			'location' => array(
					'Please enter location' => array(
							'rule' => 'notEmpty',
							'message' => 'Please enter the location!'
					)
			)
	);
	
	public function save_meeting($bean = null){
		$flag = true;
		if ($bean) {
			$ds = $this->getDataSource();
			$ds->begin();
			if ($this->save($bean)) {
				App::uses('MeetingUser', 'Model');
				$meeting_user = new MeetingUser();
				foreach ($bean['Meeting']['invite'] as $value){
					$tmu = array(
							'MeetingUser'=>array(
									'meeting_id' => $this->id,
									'user_id'=>$value,
									'hold_on'=>$bean['Meeting']['hold_on']
									)
							);
					$meeting_user->create();
					if(!$meeting_user->save($tmu)){
						$flag = false;
						break;
					}
				}
				//必须把自己也作为参加人添加到Meeting User表中
				$tmu = array(
							'MeetingUser'=>array(
									'meeting_id' => $this->id,
									'user_id'=>$bean['Meeting']['sponsor'],
									'hold_on'=>$bean['Meeting']['hold_on']
									)
							);
				$meeting_user->create();
				if(!$meeting_user->save($tmu)){
					$flag = false;
				}
				//所有的相关数据保存完毕
				if ($flag) {
					//想与会者发送广播消息
					$event = new CakeEvent('Model.Meeting.add',$this,array($this->read()));
					$this->getEventManager()->dispatch($event);
					if ($event->result['msg'] == SUCCESS) {
						$ds->commit();
					}else{
						//无法通知到所有的与会者
						$flag = false;
					}
				}else{
					$ds->rollback();
				}
			}else{
				//Meeting保存失败
				$flag = false;
			}
		}
		return $flag;
	}
	
	public function remove($meeting_id = null){
		$this->id = $meeting_id;
		if ($this->exists()) {
			$this->recursive = 1;
			$event = new CakeEvent('Model.Meeting.delete',$this,array($this->read()));
			$this->getEventManager()->dispatch($event);
			if($event->result['msg'] == SUCCESS){
				$this->delete($meeting_id);
				return true;
			}else{
				return false;
			}
		}
	}
}
?>