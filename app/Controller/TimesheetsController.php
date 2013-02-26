<?php
class TimesheetsController extends AppController{
	public $uses = array('User','Timesheet');
	public $name = 'Timesheets';
	public $components = array('RequestHandler');
	
	public $paginate = array(
			'limit' => 20,
			'order' => array(
				'Timesheet.id'=>'DESC'
			),
			'recursive' => 1
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function list_all($user_id = NULL){
		
		if (!is_null($user_id)) {
			$this->paginate['conditions'] = array(
				'Timesheet.user_id'=>$user_id,
			);
		}
		$this->set('data',$this->paginate('Timesheet'));
		return;
	}
	
	public function checkin(){
		if ($this->request->is('ajax')) {
			//提交了数据
			$bean = array();
			$bean['Timesheet'] = array(
				'user_id'=>$this->Auth->user('id'),
				'type'=>'Checkin'
			);
			if ($this->_is_checkin_today()) {
				$this->set('data',array('result'=>2));
			}else{
				if ($this->Timesheet->save($bean)) {
					$this->set('data',array('result'=>1));
				}else{
					$this->set('data',array('result'=>0));
				}
			}
			$this->render('ajax');
		}
		return;
	}
	
	public function checkout(){
		if ($this->request->is('ajax')) {
			//提交了数据
			$bean = array();
			$bean['Timesheet'] = array(
				'user_id'=>$this->Auth->user('id'),
				'type' => 'Checkout'
			);
			if ($this->_is_checkin_today()) {
				if ($this->_is_checkout_today()) {
					$this->set('data',array('result'=>2));;
				}else{
					if ($this->Timesheet->save($bean)) {
						$this->set('data',array('result'=>1));
					}else{
						$this->set('data',array('result'=>0));
					}
				}
			}else{
				$this->set('data',array('result'=>3));;
			}
			$this->render('ajax');
		}
		return;
	}
	
	private function _is_checkin_today(){
		$today = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
		$rs = $this->Timesheet->find('all',array(
			'conditions'=>array(
				'and'=>array(
					'Timesheet.user_id'=>$this->Auth->user('id'),
					'Timesheet.stamp>'.$today,
					'Timesheet.type LIKE "Checkin"'
				)
			)
		));
		
		if (count($rs)>0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	private function _is_checkout_today(){
		$today = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
		$rs = $this->Timesheet->find('all',array(
			'conditions'=>array(
				'and'=>array(
					'Timesheet.user_id'=>$this->Auth->user('id'),
					'Timesheet.stamp>'.$today,
					'Timesheet.type LIKE "Checkout"'
				)
			)
		));
		if (count($rs)>0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}