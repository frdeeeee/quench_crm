<?php
	class CheckinsController extends AppController{
		public $name = 'Checkins';
		public $uses = array('Applicant','Enquiry','Checkin');
		
		public $paginate = array(
			'limit' => 20,
			'order' => array(
					'Checkin.id'=>'DESC',
					'Checkin.created'=>'DESC',
			),
			'recursive' => 1
		);
		
		public function beforeFilter(){
			parent::beforeFilter();
			$this->set('current_menu','Applicants');
		}
		
		/**
		 * 专门提供给老师用来查看学生checkin信息的方法
		 * @param Integer $id
		 */
		public function view_detail($id=NULL){
			$this->set('data',$this->Checkin->findById($id));
			return;
		}
		
		public function list_all(){
			$this->set('data',$this->paginate('Checkin'));
			return;
		}
		
		public function leave_teacher_note(){
			if ($this->request->is('ajax')) {
				$this->Checkin->id = $this->request->data['id'];
				$this->Checkin->set('teacher_notes',$this->request->data['teacher_notes']);
				$this->Checkin->set('is_updated_by_student',0);
				if ($this->Checkin->save()) {
					$data=1;
				}else{
					$data=0;
				}
				$this->set('data',$data);
				$this->render('ajax_save_basic','ajax');
			}
			return;
		}
		
		public function update_status(){
			if ($this->request->is('ajax')) {
				$this->Checkin->id = $this->request->data['id'];
				$this->Checkin->set('status',1);
				$this->Checkin->set('is_updated_by_student',0);
				if ($this->Checkin->save()) {
					$data=1;
				}else{
					$data=0;
				}
				$this->set('data',$data);
				$this->render('ajax_save_basic','ajax');
			}
			return;
		}
	}