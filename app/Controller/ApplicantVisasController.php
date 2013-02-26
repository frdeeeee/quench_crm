<?php
class ApplicantVisasController extends AppController{
	public $uses = array('Applicant','ApplicantVisa');
	public $name = 'ApplicantVisas';
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function ajax_save_app_visa(){
		if ($this->request->is('ajax')) {
			
			$bean = $this->ApplicantVisa->find('first',array('conditions'=>array(
				'ApplicantVisa.applicant_id' => $this->request->data['applicant_id']
			)));
			
			$this->ApplicantVisa->id = $bean['ApplicantVisa']['id'];
			
			$bean=array('ApplicantVisa'=>array());
			
			foreach ($this->request->data as $key=>$value) {
				$bean['ApplicantVisa'][$key]=$value;
			}
			
			if ($this->ApplicantVisa->save($bean)) {
				$this->set('data',1);
			}else{
				$this->set('data',0);
			}
			$this->render('ajax_save_app_visa','ajax');
		}
		return;
	}
	
	public function ajax_modify_d160(){
		if ($this->request->is('ajax')) {
			$this->ApplicantVisa->id = $this->request->data['app_visa_id'];
			
			$data = 0;
			if ($this->ApplicantVisa->exists()) {
				if ($this->ApplicantVisa->saveField('form160',$this->request->data['d160'])) {
					$data = 1;
				}
			}
			$this->set('data',$data);
			$this->render('ajax_save_app_visa','ajax');
		}
	}
}