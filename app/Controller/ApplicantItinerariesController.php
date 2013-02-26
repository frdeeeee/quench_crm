<?php
	class ApplicantItinerariesController extends AppController{
		public $name = 'ApplicantItineraries';
		public $uses = array('ApplicantItinerary');
		
		public function beforeFilter(){
			parent::beforeFilter();
		}
		
		public function ajax_save_app_itinerary(){
			if ($this->request->is('ajax')) {
				//先根据app id的值看看是不是更新操作
				$bean = $this->ApplicantItinerary->find('first',
					array('conditions'=>array(
						'ApplicantItinerary.applicant_id'=>$this->request->data['applicant_id']
					)));
				
				$this->ApplicantItinerary->id = $bean['ApplicantItinerary']['id'];
				foreach ($this->request->data as $key=>$value) {
					$bean['ApplicantItinerary'][$key]=$value;
				}
				//$bean['ApplicantItinerary']['group_id']=$this->Session->read('my_group');
				$bean['ApplicantItinerary']['user_id']=$this->Auth->user('id');
				if ($this->ApplicantItinerary->save($bean)) {
					$this->set('data',1);
				}else{
					$this->set('data',0);
				}
				$this->render('ajax_result','ajax');
			}
		}
	}