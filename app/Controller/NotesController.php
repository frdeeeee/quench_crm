<?php
	class NotesController extends AppController{
		public $uses = array('User','Note','Tag');
		public $name = 'Notes';
		public $layout = 'ajax';
		
		public $paginate = array(
				'limit' => 40,
				'order' => array(
						'Note.modified'=>'desc'
				),
				'conditions'=>array('Note.is_deleted=0')
		);
		
		public function beforeFilter(){
			parent::beforeFilter();
		}
		
		/**
		 * 这个方法用来再页面动态加载和note相关的所有的tags的列表
		 */
		public function load_all_tags(){
			if ($this->request->is('ajax')) {
				$this->set('data',$this->Tag->find('list'));
				$this->render('notes_ajax_result','ajax');
			}
			return;
		}
		
		public function remove(){
			if ($this->request->is('ajax')) {
				if ($this->Note->delete($this->request->data['note_id'])) {
					$this->set('data',$this->request->data['note_id']);
				}else{
					$this->set('data',0);
				}
				$this->render('notes_ajax_result','ajax');
			}
			return;
		}
		
		public function add(){
			if ($this->request->is('ajax')) {
				$bean = array(
					'Note'=>array(
						'name'=>$this->request->data['name'],
						'content'=>$this->request->data['content'],
						'user_id'=>$this->request->data['user_id'],
						'on_desktop'=>$this->request->data['on_desktop'],
						'is_cool'=>$this->request->data['is_cool'],
						'tag_id'=>$this->request->data['tag_id']
					)
				);
				if ($this->Note->save($bean)) {
					$this->set('data',$this->Note->id);
				}else{
					$this->set('data',0);
				}
				$this->render('notes_ajax_result','ajax');
			}
			return;
		}
		
		public function list_all(){
			
			return;
		}
	}