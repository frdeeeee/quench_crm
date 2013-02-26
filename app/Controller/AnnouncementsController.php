<?php
	class AnnouncementsController extends AppController{
		public $uses = array('Announcement');
		public $name = 'Announcements';
	
		public $paginate = array(
				'limit' => 20,
				'order' => array(
						'Announcement.modified'=>'DESC',
						'Announcement.id'=>'DESC',
				),
				'recursive' => 1
		);
		
		public function beforeRender(){
			$this->set('current_menu','Announcements');
		}
		
		public function list_all_for_others(){
			$this->set('data',$this->paginate('Announcement'));
			return ;
		}
		
		public function view_detail($id = NULL){
			$this->Announcement->id = $id;
			if ($this->Announcement->exists()) {
				$hits = $this->Announcement->field('hits') + 1;
				$this->Announcement->saveField('hits',$hits);
				$this->set('data',$this->Announcement->read());
			}else{
				$this->Session->setFlash('The announcement has been removed.');
				$this->redirect(array('action'=>'list_all','error'));
			}
			return;
		}
		
		public function add(){
			if (!empty($this->request->data)) {
				if ( $this->Announcement->save($this->request->data) ) {
					$this->Session->setFlash('Announcement has been published successfully！');
					$this->redirect(array('action'=>'list_all','success'));
				}else{
					$this->set('msg_type','error');
					$this->Session->setFlash('Can not publish the announcement.');
				}
			}
			return;
		}
		
		public function modify($id = null){
			if (empty($this->request->data)) {
				$this->set('data',$this->Announcement->findById($id));
			}else{
				$this->Announcement->id = $this->request->data['Announcement']['id'];
				if ($this->Announcement->exists()) {
					$this->Announcement->save($this->request->data);
					$this->Session->setFlash('Announcement has been updated successfully');
					$this->redirect(array('action'=>'list_all','success'));
				}else{
					$this->Session->setFlash('Can not update the announcement.');
					$this->redirect(array('action'=>'list_all','error'));
				}
			}
			return;
		}
		
		public function remove($id = NULL){
			$this->Announcement->id = $id;
			if ($this->Announcement->delete($id)) {
				$this->Session->setFlash('Announcement has been removed successfully!');
				$this->redirect(array('action'=>'list_all','success'));
			}else{
				$this->Session->setFlash('Can not remove the announcement!');
				$this->redirect(array('action'=>'list_all','error'));
			}
			return ;
		}
		
		public function list_all($msg_type = NULL){
			$this->set('data',$this->paginate('Announcement'));
			if ($msg_type) {
				$this->set('msg_type',$msg_type);
			}
			return ;
		}
	}