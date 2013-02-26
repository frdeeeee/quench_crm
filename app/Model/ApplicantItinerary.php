<?php
	class ApplicantItinerary extends AppModel{
		public $name = 'ApplicantItinerary';
		public $useTable = 'applicant_itinerary';
		
		public function beforeSave(){
			$this->data['ApplicantItinerary']['depart_datetime'] = date("Y-m-d H:i:s",strtotime($this->data['ApplicantItinerary']['depart_datetime']));
			$this->data['ApplicantItinerary']['arrive_datetime'] = date("Y-m-d H:i:s",strtotime($this->data['ApplicantItinerary']['arrive_datetime']));
			$this->data['ApplicantItinerary']['return_arrive_date'] = date("Y-m-d",strtotime($this->data['ApplicantItinerary']['return_arrive_date']));
			return TRUE;
		}
		
		public function afterFind($results){
			if (isset($results['ApplicantItinerary']['depart_datetime'])) {
				$results['ApplicantItinerary']['depart_datetime'] = date("F j, Y, g:i a",strtotime($results['ApplicantItinerary']['depart_datetime'] ));
			}
			if (isset($results['ApplicantItinerary']['arrive_datetime'])) {
				$results['ApplicantItinerary']['arrive_datetime'] = date("F j, Y, g:i a",strtotime($results['ApplicantItinerary']['arrive_datetime'] ));
			}
			return $results;
		}
	}