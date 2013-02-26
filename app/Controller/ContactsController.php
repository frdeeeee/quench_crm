<?php
/**
 * 这个类是专门用来服务于客户的，客户指的是大学，代理等机构，而非学生。客户和contact联系人一起构成了crm模块的主要数据结构
 * @author justin
 *
 */
class ContactsController extends AppController{
	public $uses = array('Customer','Contact');
	public $name = 'Contacts';
	public $components = array('RequestHandler');
	//public $layout = 'default_cake';

	public $paginate = array(
			'limit' => 20,
			'order' => array(
					'Contact.modified'=>'DESC',
					'Contact.name'=>'ASC'
			),
			'conditions'=>array('Contact.available'=>1)
	);

	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function dashboard(){
		
	}
	
	public function list_all($lead_id = NULL,$type_id = NULL){
		$first_letters = range('a', 'z');
		$first_letters_upper = range('A', 'Z');
		$data = array();
		//取出联系人表格中所有firstname长度大于0的纪录的id字段和firstname字段，按照firstname字段排序
		
		if (is_null($lead_id) && is_null($type_id)) {
			$conditions = array('length(Contact.first_name)>1');
		}else{
			$conditions = array(
				'AND'=>array(
					'length(Contact.first_name)>1',
					($lead_id)?'Contact.lead_id='.$lead_id:NULL,
					($type_id)?'Contact.type_id='.$type_id:NULL
				)
			);
		}
		
		
		$tmp_data = $this->Contact->find('all',array(
			'fields'=>array('id','first_name','middle_name','last_name','company','status','lead_id'),
			'conditions'=>$conditions,
			'order'=>array('Contact.first_name'=>'ASC')
		));
		
		$current_index = 0;
		foreach ($first_letters_upper as $key => $upper_letter){
			for ( $i = 0; $i < count($tmp_data); $i++) {
				if (substr( ucfirst( $tmp_data[$i]['Contact']['first_name']) ,0,1) == $upper_letter) {
					//首字母相同，则加入小写字母的数组中
					$data[$first_letters[$key]][] = $tmp_data[$i];
					//unset($tmp_data[$i]);
				}
			}
		}
		
		$this->set('data',array('lower_letters'=>$first_letters,'upper_letters'=>$first_letters_upper,'contacts'=>$data));
		$this->set('contact_fields',$this->_get_contact_fields());
		//加载workinglog表的字段，用来增减新的task
		$this->set('task_fields',$this->_get_fields('WorkingLog'));
		$this->loadModel('Type');
		$this->set('contact_types',$this->Type->find('list'));
		$this->set('sales_person',$this->User->find('list',array(
			'conditions'=>array('User.department_id'=>2),'fields'=>array('id','name')
		)));
		return;
	}
	
	public function list_all_cold(){
		$this->list_all(1);
		$this->render('list_all');
		return;
	}
	public function list_all_hot(){
		$this->list_all(2);
		$this->render('list_all');
		return;
	}
	public function list_all_referral(){
		$this->list_all(3);
		$this->render('list_all');
		return;
	}
	public function list_all_others(){
		$this->list_all(4);
		$this->render('list_all');
		return;
	}
	
	private function _get_contact_fields(){
		$contact_fields = $this->Contact->schema();
			$data = array();
			foreach ($contact_fields as $key=>$value){
				if(isset($value['comment']) && !empty($value['comment'])){
					$data['Contact.'.$key] = $value['comment'];//运营已阅
				}
			}
		return $data;
	}
	
	public function modify($id=NULL){
		if (empty($this->request->data)) {
			$this->set('data',$this->Contact->findById($id));
			$this->set('customers',$this->Customer->find('list',array(
				'conditions'=>array(
					'and'=>array(
						'Customer.available'=>1,
						'Customer.group_id'=>$this->Session->read('my_group')
					)
				)))
			);
		}else{
			if($this->Contact->save($this->request->data)){
				//success
				$this->redirect(array('controller'=>'Customers','action'=>'view_detail',
				$this->request->data['Contact']['customer_id']));
			}
		}
		return;
	}
	
	/**
	 * 删除联系人ajax方法
	 * @param Integer $contact_id 被删的contactid
	 * @param Integer $customer_id  删除成功后的返回路径用
	 */
	public function ajax_remove(){
		if ($this->request->is('ajax')) {
			$this->Contact->id = $this->request->data['id'];
			if ($this->Contact->exists() && $this->Contact->delete($this->request->data['id'])) {
				$this->set('data',array('result'=>1));
			}else{
				$this->set('data',array('result'=>0));
			}
			$this->render('ajax_get_contact');
		}
		return;
	}
	
	/**
	 * 删除联系人的方法
	 * @param Integer $contact_id 被删的contactid
	 * @param Integer $customer_id  删除成功后的返回路径用
	 */
	public function remove($contact_id=null,$customer_id=null){
		$this->Contact->id = $contact_id;
		if ($this->Contact->saveField('available',0)) {
			$this->Session->setFlash('联系人已经被成功删除!');
			$this->redirect(array('controller'=>'Customers','action'=>'view_detail',$customer_id,'success'));
		}else{
			$this->Session->setFlash('无法删除联系人, 请稍候再试!');
			$this->redirect(array('controller'=>'Customers','action'=>'view_detail',$customer_id,'error'));
		}
	}
	
	public function ajax_add_new(){
		if ($this->request->is('ajax')) {
			//提交了数据
			$is_update = 1;
			$new_type = 0;//先设置为0,如果前端接收到0,表示不需要更新customer type信息
			if ( empty($this->request->data['Contact']['id']) ) {
				$is_update = 0;
			}else{
				//如果是更新操作，检查是否更新了contact的状态信息，即hot，cold，referral，others
				$this->Contact->id = $this->request->data['Contact']['id'];
				if ($this->Contact->exists()) {
					if($this->Contact->field('lead_id') != $this->request->data['Contact']['lead_id']){
						$new_type = $this->request->data['Contact']['lead_id'];
					};
				}
			}
			
			//$bean = json_decode($this->request->data);
			if ($this->Contact->save($this->request->data)) {
				$this->set(
					'data',
					array(
						'result'=>$this->Contact->getID(),
						'is_update'=>$is_update,
						'customer_type'=>$new_type,
						'modified'=>$this->Contact->field('modified'),
						'created'=>$this->Contact->field('created')
					)
				);
			}else{
				$this->set('data',array('result'=>0));
			}
			$this->render('ajax_get_contact');
		}
		return;
	}
	/**
	 * 根据给定或者用户提交上来的customerId而添加联系人信息
	 * @param integer $customer_id
	 */
	public function add($customer_id = null){
		if (is_null($customer_id)) {
			//把所有登录的用户输入的customer列表给前台
			$this->set(
					'customers',
					$this->Customer->find(
							'list',
							array('conditions'=>array(
									'AND'=>array(
											'Customer.group_id'=>$this->Session->read('my_group'),
											'Customer.available'=>1
											)
									))));
			
		}else{
			$this->set('current_customer',$this->Customer->findById($customer_id) );
		}
		if (!empty($this->request->data)) {
			//提交了数据
			$this->request->data['Contact']['user_id'] = $this->Auth->user('id');
			if($this->Contact->save($this->request->data)){
				//success
				$this->redirect(array('controller'=>'Customers','action'=>'view_detail',$this->request->data['Contact']['customer_id']));
			}
		}
		return;
	}
	
	/**
	 * 这个方法是用来响应：添加工作记录页面发出的查询Contact详细信息的请求的
	 */
	public function ajax_get_contact(){
		$this->layout = 'ajax';
		if ($this->request->is('ajax')) {
			$contact_id = trim($this->request->data['contact_id']);
			$this->set('data',$this->Contact->findById($contact_id));
			$this->render('ajax_get_contact','ajax');
		}
		return;
	}
	
	public function retrive_all_emails($is_client = NULL){
		$data = $this->Contact->find('all',array(
			'fields'=>array('Contact.first_name','Contact.last_name','Contact.email')
		));
		
		$available_emails = array();
		foreach ($data as $value){
			if ( preg_match("/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i", $value['Contact']['email'] ) ) {
				$available_emails[] = $value;
			}
		}
		
		$csv_folder = WEBROOT_DIR.DS.'files'.DS.'csv';
		if (!file_exists($csv_folder)) {
			 mkdir($csv_folder,0755,true); // or 0644 for file
		}
		
		$fp = fopen( $csv_folder.DS.'contacts_emails.csv', 'w');
		
		foreach ($available_emails as $fields) {
		    fputcsv($fp, $fields);
		}
		fclose($fp);
		
		$this->set('link',DS.'files'.DS.'csv'.DS.'contacts_emails.csv');
		return;
	}
}