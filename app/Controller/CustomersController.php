<?php
/**
 * 这个类是专门用来服务于客户的，客户指的是大学，代理等机构，而非学生。客户和contact联系人一起构成了crm模块的主要数据结构
 * @author justin
 *
 */
class CustomersController extends AppController{
	public $uses = array('Customer','Contact');
	public $name = 'Customers';
	public $components = array('RequestHandler');
	//public $layout = 'default_cake';
	
	public $paginate = array(
			'limit' => 20,
			'order' => array(
				'Customer.group_id'=>'asc',	
				'Customer.modified'=>'DESC',
				'Customer.name'=>'ASC'
			),
			'conditions'=>array('Customer.available'=>1)
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function remove($customer_id = null){
		$this->Customer->id = $customer_id;
		if ($this->Customer->saveField('available',0)) {
			$this->Session->setFlash('Successfully removed!');
			$this->redirect(array('action'=>'list_all','success'));;
		}else{
			$this->set('msg_type','error');
			$this->Session->setFlash('Can not delete this contact, please try again!');
		}
	}
	
	public function beforeRender(){
		parent::beforeRender();
		$this->set('current_menu','Customers');
	}
	
	/**
	 * 修改客户资料的方法
	 * @param Integer $customer_id
	 */
	public function modify($customer_id = null){
		if (empty($this->request->data)) {
			//提交了数据
			$this->set('data',$this->Customer->findById($customer_id));
			$this->set('groups',$this->Group->find('list'));
		}else{
			$this->Customer->id = $this->request->data['Customer']['id'];
			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash('Modification succeed!');
				$this->redirect(array('action'=>'list_all','success'));;
			}else{
				$this->set('msg_type','error');
				$this->Session->setFlash('Modification failed, please try again!');
				$this->set('groups',$this->Group->find('list'));
			}
		}
		return;
	}
	
	public function add(){
		if (!empty($this->request->data)) {
			//提交了数据
			if($this->Customer->save($this->request->data)){
				//success
				$this->Session->setFlash('Adding new contact succeed!');
				$this->redirect(array('action'=>'list_all','success'));
			}else{
				$this->set('msg_type','error');
				$this->Session->setFlash('Adding new contact failed, please try again!');
			}
		}
		return;
	}
	
	/**
	 * 列出所有的客户，
	 * 所有的客户是指自己创建的共享的客户，和属于自己当前登陆的组的客户
	 * @param String $msg_type
	 */
	public function list_all($msg_type=null) {
		if ( $this->Auth->user('role_id')==SALES_DIRECTOR || $this->Auth->user('role_id')==ADMIN ) {
			$this->paginate['conditions'] = array('Customer.available' => 1);
		}else{
			$this->paginate['conditions'] = array(
							'and'=>array(
								'Customer.group_id IN('.implode(',', $this->get_my_groups()).')',
								'Customer.available'=>1
							)	
			);
		}
		
		$this->set('data',$this->paginate('Customer'));
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);
		}
		return;
	}
	
	/**
	 * 查看客户资料的方法
	 * @param Integer $customer_id
	 * @param string $msg_type  消息类型
	 */
	public function view_detail($customer_id = null,$msg_type = null){
		if (!is_null($customer_id)) {
			$this->set('data',$this->Customer->findById($customer_id));
		}
		if (!is_null($msg_type)) {
			$this->set('msg_type',$msg_type);;
		}
		return;
	}
	/**
	 * 这个方法是用来响应：添加工作记录页面发出的查询Customer信息的请求的
	 */
	public function ajax_get_customer(){
		$this->layout = 'ajax';
		if ($this->request->is('ajax')) {
			$customer_id = trim($this->request->data['customer_id']);
			$this->set('data',$this->Customer->get_contacts_and_location($customer_id));
			$this->render('ajax_get_customer','ajax');
		}
		return;
	}
	
	/**
	 * 这个方法用来响应在添加客户联系纪录的时候，返回给定groupId的所属的customer
	 */
	public function ajax_get_group(){
		$this->layout = 'ajax';
		if ($this->request->is('ajax')) {
			$group_id = trim($this->request->data['group_id']);
			$this->set('data',$this->Customer->get_id_and_name_by_group($group_id));
			$this->render('ajax_get_customer','ajax');
		}
		return;
	}
}