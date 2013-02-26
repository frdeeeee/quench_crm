<?php
require_once 'Messenger.php';
class MeetingsController extends AppController{
	public $uses = array('Meeting','User','MeetingUser');
	public $name = 'Meetings';

	public $paginate = array(
			'limit' => 20,
			'order' => array(
					'Meeting.modified'=>'DESC',
					'Meeting.id'=>'DESC',
			),
			'recursive' => 2
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
		$msn = new Messenger();
		$this->Meeting->getEventManager()->attach($msn);
	}
	
	public function load_my_meetings($user_id = NULL){
		if ($user_id) {
			$data = $this->MeetingUser->find('all',array(
				'conditions'=>array(
					'MeetingUser.user_id'=>$this->Auth->user('id')
				),
				'fields'=>array('meeting_id'),
				'recursive'=>0
			));
			if (count($data)>0) {
				$in_str = '';
				foreach ($data as $value) {
					$in_str .= $value['MeetingUser']['meeting_id'].',';
				}
				$in_str = substr($in_str, 0,strlen($in_str)-1);
				$data = $this->Meeting->find('all',array(
					'conditions'=>array(
						'and'=>array(
							'Meeting.id IN('.$in_str.')',
							'Meeting.hold_on>"'.date('Y-m-d H:i:s',time()).'"'
						)
					)
				));
			}else{
				//表示没有受邀请参加人和的会议
				$data = array();
			}
		}else{
			$data = $this->paginate('Meeting');
		}
		$this->set('data',$data);
		$this->render('list_all');
		return;
	}
	
	public function ajax_load_my_meetings(){
		$this->layout = 'ajax';
		if ($this->request->is('ajax')) {
			$data = $this->MeetingUser->find('all',array(
				'conditions'=>array(
					'MeetingUser.user_id'=>$this->Auth->user('id')
				)
			));
			//$this->set('data',$data);
			$this->set('data',$this->_full_calendar_event_data_transfer($data));
			$this->render('ajax');
		};
		return;
	}
	
	private function _full_calendar_event_data_transfer( $data = array() ){
		$json_data_array = array();
		$class_name = array('calendar_red','calendar_blue','calendar_green');
		if (!is_null($data)) {
				foreach ($data as $value) {
					$d = array(
						'title'=>$value['Meeting']['name'],
						'id'=>$value['Meeting']['id'],
						'className'=> 'calendar_orange',
						'controller'=>'Meetings'
						//'url'=>'/Tasks/modify/'.$value['Task']['id']
					);
					$d['start'] = date('Y-m-d H:m',strtotime($value['Meeting']['hold_on']));
					$json_data_array[] = $d;
				}
		}
		return $json_data_array;
	}
	
	/**
	 * 当拖拽一个meeting时的响应函数
	 * @param unknown_type $project_id
	 */
    public function update_deadline(){
		$this->layout = 'ajax';
		if ($this->request->is('ajax')) {
			$result = array();
			$this->Meeting->id = $this->request->data['id'];
			if ($this->Meeting->exists()) {
				$current_deadline = $this->Meeting->field('hold_on');
				$diff = 60*60*24*$this->request->data['dayDelta'];
				$t_data = date('Y-m-d',strtotime($current_deadline)+$diff);
				if ($this->Meeting->saveField('hold_on',$t_data)) {
					$result['deadline_date'] = $t_data;
				}else{
					$result['deadline_date'] = 0;
				}
			}
			$this->set('data',$result);
			$this->render('ajax');
		}
		return;
	}
	
	public function view_detail($meeting_id = null){
		if ($meeting_id) {
				$this->Meeting->id = $meeting_id;
				if ($this->Meeting->exists()) {
					$this->set('data',$this->Meeting->read());
				}else{
					$this->Session->setFlash('The meeting has been cancelled！');
					$this->redirect(array('action'=>'list_all','error'));
				}
		}
		return;
	}
	
	public function modify($meeting_id = null){
		if ($meeting_id) {
			if (empty($this->request->data)) {
				$this->Meeting->id = $meeting_id;
				if ($this->Meeting->exists()) {
					$this->set('data',$this->Meeting->read());
				}else{
					$this->Session->setFlash('The meeting has been cancelled！');
					$this->redirect(array('action'=>'list_all','error'));
				}
			}else{
				$this->Meeting->id = $meeting_id;
				if ($this->Meeting->exists()) {
					if ($this->Meeting->save($this->request->data)) {
						$this->Session->setFlash('Meeting agenda has been updated！');
						$this->redirect(array('action'=>'list_all','success'));
					}else{
						$this->Session->setFlash('Can not update the agenda, please try later！');
						$this->redirect(array('action'=>'list_all','error'));
					}
				}
			}
		}
		return;
	}
	
	public function remove($meeting_id = null){
		if ($meeting_id) {
			$this->Meeting->remove($meeting_id);
		}
		$this->Session->setFlash('Meeting has been cancelled successfully！');
		$this->redirect(array('action'=>'list_all','success'));
		return;
	}
	
	public function list_all($msg_type = null){
		$this->set('data',$this->paginate('Meeting'));
		if ($msg_type) {
			$this->set('msg_type',$msg_type);
		}
		return;
	}
	
	public function add(){
		//添加被邀请参加的人的列表
		$this->set('invites',$this->User->find('list',array(
				'conditions'=>array(
						'AND'=>array(
								'User.available=1',
								'User.id != '.$this->Auth->user('id')
						)
				),
				'fields'=>array('id','name')
		)));
		if (!empty($this->request->data)) {
			//检查参加人字段是否为空
			if (empty($this->request->data['Meeting']['invite'])) {
				//没有邀请任何人参加会议，是不对的;
				$this->set('msg_type','error');
				$this->Session->setFlash('Please select a participant at least！');
			}else{
				if ($this->Meeting->save_meeting($this->request->data)) {
					$this->Session->setFlash('The meeting has been set up！');
					$this->redirect(array('action'=>'list_all','success'));
				}else{
					$this->set('msg_type','error');
					$this->Session->setFlash('Can not set up a new meeting, please try later！');
				}
			}
		}
		return;
	}
}
