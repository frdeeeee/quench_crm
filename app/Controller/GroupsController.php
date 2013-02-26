<?php
class GroupsController extends AppController{
	public $uses = array('Group','User','Department','Role','GroupUser');
	public $name = 'Groups';
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function beforeRender(){
		$this->set('current_menu','Users');
	}
	
	public function view_detail($group_id = NULL){
		$this->set('data',$this->Group->get_detail($group_id));
		return;
	}
	
	
	
	/**
	 * Add new group into system
	 */
	public function add(){
		$this->set('leaders',$this->User->find_group_leaders());
		if ( !empty($this->request->data) ) {
			if( $this->Group->save( $this->request->data ) ){
				$bean = array(
						'GroupUser'=>array(
								'group_id' => $this->Group->id,
								'user_id' => $this->request->data['Group']['group_leader']
								)
						);
				$this->GroupUser->save($bean);
				$this->Session->setFlash('系统用户组-'.$this->request->data['Group']['name'].'-添加成功!');
				$this->redirect(array('action'=>'list_all','success'));
			}else{
				//添加失败
				$this->set('msg_type','error');
				$this->Session->setFlash('无法添加用户组：'.$this->request->data['Group']['name'].', 请稍候再试!');
			}
		}
		return;
	}
	
	public function modify($group_id){
		$this->set('leaders',$this->User->find_group_leaders());
		if ( empty($this->request->data) ) {
			$this->set('data',$this->Group->findById($group_id));
		}else{
			$this->Group->id = $group_id;
			if( $this->Group->save( $this->request->data ) ){
				$this->Session->setFlash('系统用户组-'.$this->request->data['Group']['name'].'-更新成功!');
				$this->redirect(array('action'=>'list_all','success'));
			}else{
				//添加失败
				$this->set('msg_type','error');
				$this->Session->setFlash('无法更新用户组：'.$this->request->data['Group']['name'].', 请稍候再试!');
			}
		}
		return;
	}
	
	public function list_all($msg_type = null){
		
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);;
		}
		//$this->set('leaders',$this->User->find_group_leaders());
		$this->set('leaders',$this->User->find('list'));
		$this->set('data',$this->Group->get_groups_info());
		return;
	}
	
	public function remove_group_member($group_id=null){
		if (empty($this->request->data) ) {
			$this->Group->unbindModel(array('hasMany'=>array('WorkingLog','Presentation','Enquiry')));
			$d = $this->Group->find('first',array('recursive'=>2,'conditions'=>array('Group.id'=>$group_id)));
			$this->set('data',$d);
		}else{
			$this->GroupUser->id = $this->request->data['Group']['remove_this_id'];
			if ($this->GroupUser->exists()) {
				if($this->GroupUser->delete($this->request->data['Group']['remove_this_id'])){
					$this->Session->setFlash('成功移除了1位成员!');
					$this->redirect(array('action'=>'list_all','success'));
				}else{
					$this->Session->setFlash('无法移除了指定的成员，请稍候再试!');
					$this->redirect(array('action'=>'list_all','error'));
				}
			}else{
				$this->Session->setFlash('无法移除了指定的成员，请稍候再试!');
				$this->redirect(array('action'=>'list_all','error'));
			}
		}
		return;
	}
	
	public function add_group_member($group_id=null){
		//$this->layout = 'default_cake';
		if (empty($this->request->data) ) {
			$d = $this->Group->find('first',array('recursive'=>2,'conditions'=>array('Group.id'=>$group_id)));
			$this->set('data',$d);
			$not_in = null;
			if (!empty($d['GroupUser'])) {
				for ($i = 0; $i < count($d['GroupUser']); $i++) {
					if( $i == (count($d['GroupUser'])-1) ){
						//表示是最后一个
						$not_in .= $d['GroupUser'][$i]['user_id'];
					}else{
						//表示不是最后一个
						$not_in .= $d['GroupUser'][$i]['user_id'].',';
					}
				}
			}
			$this->set('sales_assistants',$this->User->get_sales_assistants($not_in));
		}else{
			$flag = true;
			$amount = 0;
			if (!empty($this->request->data['GroupUser']['user_id'])) {
				//循环添加用户选择的成员到用户组
				foreach ($this->request->data['GroupUser']['user_id'] as $key => $value) {
					if ($value==1) {
						$this->GroupUser->create();
						$bean = array('GroupUser'=>array(
								'group_id'=>$this->request->data['GroupUser']['group_id'],
								'user_id'=>$key
								));
						if ($this->GroupUser->save($bean)) {
							$amount++;
						}else{
							$flag = false;
						}
					};
				};
				//添加操作完毕
				if ($flag) {
					//全部添加成功
					$this->Session->setFlash('成功添加了'.$amount.'位新成员!');
					$this->redirect(array('action'=>'list_all','success'));
				}else{
					$this->Session->setFlash('成功添加了'.$amount.'位新成员，但没有添加被选择的全部成员，请稍候再试！');
					$this->redirect(array('action'=>'list_all','error'));
				}
			}
		}
		return;
	}
	
	public function remove($group_id = null){
		$this->Group->id = $group_id;
		if ($this->Group->delete($group_id)) {
			$this->Session->setFlash('删除成功!');
			$this->redirect(array('action'=>'list_all','success'));
		}else{
			$this->Session->setFlash('删除失败，请稍候再试！');
			$this->redirect(array('action'=>'list_all','error'));
		}
	}
	
	public function check_my_teams($user_id = NULL){
		if ($user_id) {
			$this->Group->unbindModel(array(
				'hasMany'=>array('Presentation','WorkingLog','Enquiry')
			));
			$this->set('data',$this->Group->find('all',array(
				'conditions'=>array(
					'Group.id IN('.$this->_get_group_ids_in_string($user_id).')'
				),
				'recursive'=>2,
				'fields'=>array(
					'Group.name','Leader.name','Group.modified'
				)
			)));
		}
		return;
	}
	
	/**
	 * 根据给定的用户id返回所属的组的字符串形式
	 * @param Integer $user_id
	 * @return mixed
	 */
	private function _get_group_ids_in_string($user_id = null){
		$groups = $this->_get_my_groups($user_id);
		$str = '';
		if (!is_null($groups)) {
			if (!is_null($groups) && count($groups)>0) {
				foreach ($groups as $value){
					$str .= $value['GroupUser']['group_id'].',';
				};
				$str = substr($str,0,strlen($str)-1);
			}
		}
		return $str;
	}
	
/**
	 * 根据给定的用户id返回所属的组的数组形式
	 * @param Integer $user_id
	 * @return mixed
	 */
	private function _get_my_groups($user_id = null){
		if (!is_null($user_id)) {
			return $this->GroupUser->find(
					'all',
					array(
							'conditions'=>array('GroupUser.user_id'=>$user_id),
							'recursive'=>-1,
							'fields'=>array('GroupUser.group_id')
					)
			);
		}else{
			return null;
		}
	}
	/*
	 * 用户准备切换用户组的时候，用来加载其所属的用户组的
	 */
	public function ajax_get_my_groups(){
		if ($this->request->is('ajax')) {
			$d = $this->Group->find('list',array(
				'conditions'=>array(
					'Group.id IN('.$this->_get_group_ids_in_string( $this->Auth->user('id') ).')'
				)
			));
			
			if ($d) {
				$this->set('data',$d);
			}else{
				$this->set('data',0);
			}
			$this->render('ajax_result','ajax');
		}
	}
	
	public function ajax_switch_my_group(){
	if ($this->request->is('ajax')) {
			$this->Group->id = $this->request->data['new_group_id'];
			$this->Group->unbindModel(array(
				'hasMany'=>array('WorkingLog','Presentation','Enquiry')
			));
			$this->loadModel('Project','Model');
			$this->Project->id = $this->request->data['new_project_id'];
			if ($this->Group->exists() && $this->Project->exists() ) {
				$group = $this->Group->read();
				if (
					$this->Session->write('my_project',$this->request->data['new_project_id']) &&
					$this->Session->write('my_project_name',$this->Project->field('name')) &&
					$this->Session->write('my_group_name',$group['Group']['name']) &&
					$this->Session->write('my_group',$this->request->data['new_group_id'])
				) {
					$this->set('data',1);
				}else{
					$this->set('data',0);
				}
			}else{
				$this->set('data',0);
			}
			$this->render('ajax_result','ajax');
		}
	}
}