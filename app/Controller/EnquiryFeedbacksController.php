<?php
class EnquiryFeedbacksController extends AppController{
	public $uses = array('Enquiry','Customer','EnquiryFeedback','Answer','Reason');
	public $name = 'EnquiryFeedbacks';
	//public $helpers = array('Html','Form','Msg','Priv');
	public $helpers = array('Html','Form');

	public $paginate = array(
			'limit' => 20,
			'order' => array(
					'EnquiryFeedback.modified'=>'DESC',
					'EnquiryFeedback.created'=>'DESC'
			),
			'recursive' => 1
	);
	
	public function list_all($msg_type = NULL){
		$this->paginate['conditions'] = array('EnquiryFeedback.operator_id'=>$this->Auth->user('id'));
		$this->set('data',$this->paginate('EnquiryFeedback'));
		return;
	}
	
	public function add($enquiry_id = null){
		
		if (!empty($this->request->data)) {
			if ($this->EnquiryFeedback->save_feedback($this->request->data,$this->request->data['EnquiryFeedback']['is_feedback'])) {
				$this->Session->setFlash('回复添加成功!');
				$this->redirect(array('controller'=>'Enquiries', 'action'=>'list_all_for_operator','success'));
			}else{
				$this->set('msg_type','error');
				$this->Session->setFlash('无法添加回复纪录, 请稍候再试!');
				$this->Enquiry->unbindModel(array('belongsTo'=>array('Group')));
				$this->set('data',$this->Enquiry->find('first',array('conditions'=>array('Enquiry.id'=>$enquiry_id),'recursive'=>2)));
				$this->set('answers',$this->Answer->find('list'));
				$this->set('reasons',$this->Reason->find('list'));
			}
		}else{
			$this->Enquiry->unbindModel(array('belongsTo'=>array('Group')));
			$this->set('data',$this->Enquiry->find('first',array('conditions'=>array('Enquiry.id'=>$enquiry_id),'recursive'=>2)));
			$this->set('answers',$this->Answer->find('list'));
			$this->set('reasons',$this->Reason->find('list'));
		}
		return;
	}
}