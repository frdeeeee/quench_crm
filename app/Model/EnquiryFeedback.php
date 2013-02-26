<?php
	class EnquiryFeedback extends AppModel{
		public $name = 'EnquiryFeedback';
		public $belongsTo = array(
			'User'=>array(
				'foreignKey'=>'operator_id'
			),
			'Answer','Reason'
		);
		
		public $order = array('EnquiryFeedback.create desc');
		
		public function save_feedback($req_data = null, $is_feedback = null){
			$ds = $this->getDataSource();
			$ds->begin();
			$flag = false;
			if ($this->save($req_data)) {
				if ($is_feedback==1) {
					$flag = true;
				}else{
					App::uses('Enquiry', 'Model');
					$enquiry = new Enquiry();
					$enquiry->id = $req_data['EnquiryFeedback']['enquiry_id'];
					if ($enquiry->saveField('is_feedback', 1)) {
						$flag = true;
					}
				}
			}
			
			if ($flag) {
				$ds->commit();
				return true;
			}else{
				$ds->rollback();
				return false;
			}
		}
	}