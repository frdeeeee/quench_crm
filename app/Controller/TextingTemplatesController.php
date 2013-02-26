<?php
class TextingTemplatesController extends AppController{
	public $uses = array('TextingTemplate');
	public $name = 'TextingTemplates';
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('current_menu','smsmanagers');
	}
	
	public function get_texting_templates_list_ajax(){
		$this->set('data',$this->TextingTemplate->find('list'));
		$this->render('get_texting_templates_list_ajax','ajax');
		return;
	}
	
	public function get_template_content_ajax(){
		if ($this->request->is('ajax')) {
			$this->TextingTemplate->id = $this->request->data['template_id'];
			$this->set('data',$this->TextingTemplate->field('content'));
			$this->render('get_texting_templates_list_ajax','ajax');
		}
		return;
	}
	
	public function add(){
		if (!empty($this->request->data)) {
			if ($this->TextingTemplate->save($this->request->data)) {
				$this->Session->setFlash('短信模板添加成功');
				$this->redirect(array('action'=>'list_all','success'));
			}else{
				$this->Session->setFlash('短信模板添加失败，请稍候再试！');
				$this->redirect(array('action'=>'list_all','error'));
			}
		}
		return;
	}
	
	public function modify($id){
		if (!empty($this->request->data)) {
			if ($this->TextingTemplate->save($this->request->data)) {
				$this->Session->setFlash('短信模板更新成功');
				$this->redirect(array('action'=>'list_all','success'));
			}else{
				$this->Session->setFlash('短信模板更新失败，请稍候再试！');
				$this->redirect(array('action'=>'list_all','error'));
			}
		}else{
			$this->set('data',$this->TextingTemplate->findById($id));
		}
		return;
	}
	
	public function remove($id=NULL){
		if ($id) {
			$this->TextingTemplate->id = $id;
			if ($this->TextingTemplate->delete($id)) {
				$this->Session->setFlash('短信模板删除成功');
				$this->redirect(array('action'=>'list_all','success'));
			}else{
				$this->Session->setFlash('短信模板删除失败，请稍候再试！');
				$this->redirect(array('action'=>'list_all','error'));
			}
		}
		return;
	}
	
	public function list_all($msg_type = NULL){
		if ($msg_type) {
			$this->set('msg_type',$msg_type);
		}
		$this->set('data',$this->TextingTemplate->find('all',array(
				'order'=>array('TextingTemplate.name ASC')
				)));
		return;
	}
}