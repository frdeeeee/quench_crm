<?php
/**
 * 这个类是专门用来保存称为客户的联系人的信息的
 * @author justin
 *
 */
class ClientsController extends AppController{
	public $uses = array('Contact','Client','WorkingLog','ClientWebhosting',
						'ClientSocial','ClientSEO','ClientSEM','ClientOther','ClientAccounting');
	public $name = 'Clients';
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
	
	
	public function list_all_back_up(){
		$first_letters = range('a', 'z');
		$first_letters_upper = range('A', 'Z');
		$data = array();
		//取出联系人表格中所有firstname长度大于0的纪录的id字段和firstname字段，按照firstname字段排序
		$tmp_data = $this->Contact->find('all',array(
			'fields'=>array('id','first_name','middle_name','last_name','company','status'),
			'conditions'=>array(
			   'AND'=>array(
					'length(Contact.first_name)>1',
					'Contact.status'=>IS_CLIENT
				)),
			'order'=>array('Contact.first_name'=>'ASC')
		));
		$current_index = 0;
		foreach ($first_letters_upper as $key => $upper_letter){
			for ( $i = $current_index; $i < count($tmp_data); $i++) {
				if (substr( ucfirst( $tmp_data[$i]['Contact']['first_name']) ,0,1) == $upper_letter) {
					//首字母相同，则加入小写字母的数组中
					$data[$first_letters[$key]][] = $tmp_data[$i];
					//unset($tmp_data[$i]);
				}else{
					$current_index = $i;
					break;
				}
			}
		}
		$this->set('data',array('lower_letters'=>$first_letters,'upper_letters'=>$first_letters_upper,'contacts'=>$data));
		$this->set('contact_fields',$this->_get_fields('Contact'));
		$this->set('web_hosting_fields',$this->_get_fields('ClientWebhosting'));
		$this->set('social_fields',$this->_get_fields('ClientSocial'));
		$this->set('seo_fields',$this->_get_fields('ClientSEO'));
		$this->set('sem_fields',$this->_get_fields('ClientSEM'));
		$this->set('other_fields',$this->_get_fields('ClientOther'));
		$this->set('accounting_fields',$this->_get_fields('ClientAccounting'));
		//加载workinglog表的字段，用来增减新的task
		$this->set('task_fields',$this->_get_fields('WorkingLog'));
		$this->loadModel('Type');
		$this->set('contact_types',$this->Type->find('list'));
		return;
	}
	
	public function list_all(){
		$first_letters = range('a', 'z');
		$first_letters_upper = range('A', 'Z');
		$data = array();
		//取出联系人表格中所有firstname长度大于0的纪录的id字段和firstname字段，按照firstname字段排序
		$tmp_data = $this->Contact->find('all',array(
			'fields'=>array('id','first_name','middle_name','last_name','company','status'),
			'conditions'=>array(
			   'AND'=>array(
					'length(Contact.first_name)>0',
					'Contact.status'=>IS_CLIENT
				)),
			'order'=>array('Contact.company'=>'ASC')
		));
		$current_index = 0;
		foreach ($first_letters_upper as $key => $upper_letter){
			for ( $i = $current_index; $i < count($tmp_data); $i++) {
				//检查公司名称是否具备
				if (trim($tmp_data[$i]['Contact']['company']) != '') {
					if (substr( ucfirst( $tmp_data[$i]['Contact']['company']) ,0,1) == $upper_letter) {
						//首字母相同，则加入小写字母的数组中
						$data[$first_letters[$key]][] = $tmp_data[$i];
						//unset($tmp_data[$i]);
					}else{
						$current_index = $i;
						break;
					}
				}else{
					/*
					if (substr( ucfirst( $tmp_data[$i]['Contact']['company']) ,0,1) == $upper_letter) {
						//首字母相同，则加入小写字母的数组中
						$data['A'][] = $tmp_data[$i];
						//unset($tmp_data[$i]);
					}else{
						$current_index = $i;
						break;
					}
					*/
					if (!isset($tmp_data[$i]['pass'])) {
						$data['a'][] = $tmp_data[$i];
						$tmp_data[$i]['pass'] = TRUE;
					}
				}
			}
		}
		$this->set('data',array('lower_letters'=>$first_letters,'upper_letters'=>$first_letters_upper,'contacts'=>$data));
		$this->set('contact_fields',$this->_get_fields('Contact'));
		$this->set('web_hosting_fields',$this->_get_fields('ClientWebhosting'));
		$this->set('social_fields',$this->_get_fields('ClientSocial'));
		$this->set('seo_fields',$this->_get_fields('ClientSEO'));
		$this->set('sem_fields',$this->_get_fields('ClientSEM'));
		$this->set('other_fields',$this->_get_fields('ClientOther'));
		$this->set('accounting_fields',$this->_get_fields('ClientAccounting'));
		//加载workinglog表的字段，用来增减新的task
		$this->set('task_fields',$this->_get_fields('WorkingLog'));
		$this->loadModel('Type');
		$this->set('contact_types',$this->Type->find('list'));
		$this->set('sales_person',$this->User->find('list',array(
			'conditions'=>array('User.department_id'=>2),'fields'=>array('id','name')
		)));
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
	
	/**
	 * 
	 */
	public function ajax_get_client(){
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			$bean = $this->Client->find('first',array('conditions'=>array('Client.contact_id'=>$this->request->data['contact_id'])));
			$this->set('data',$bean);
			$this->render('ajax_get_contact');
		}
		return;
	}
	
	/**
	 * 删除Client ajax方法
	 * @param Integer $contact_id 被删的contactid
	 * @param Integer $customer_id  删除成功后的返回路径用
	 */
	public function ajax_remove(){
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
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
	
	public function ajax_save_accounting(){
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			if ($this->_ajax_save('ClientAccounting', $this->request->data)) {
				$this->set('data',array('result'=>1));
			}else{
				$this->set('data',array('result'=>0));
			}
			$this->render('ajax_get_contact');
		}
		return;
	}
	
	public function ajax_save_web_hosting(){
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			if ($this->_ajax_save('ClientWebhosting', $this->request->data)) {
				$this->set('data',array('result'=>1));
			}else{
				$this->set('data',array('result'=>0));
			}
			$this->render('ajax_get_contact');
		}
		return;
	}
	public function ajax_save_social(){
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			if ($this->_ajax_save('ClientSocial', $this->request->data)) {
				$this->set('data',array('result'=>1));
			}else{
				$this->set('data',array('result'=>0));
			}
			$this->render('ajax_get_contact');
		}
		return;
	}
	public function ajax_save_seo(){
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			if ($this->_ajax_save('ClientSEO', $this->request->data)) {
				$this->set('data',array('result'=>1));
			}else{
				$this->set('data',array('result'=>0));
			}
			$this->render('ajax_get_contact');
		}
		return;
	}
	public function ajax_save_sem(){
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			if ($this->_ajax_save('ClientSEM', $this->request->data)) {
				$this->set('data',array('result'=>1));
			}else{
				$this->set('data',array('result'=>0));
			}
			$this->render('ajax_get_contact');
		}
		return;
	}
	public function ajax_save_other(){
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			if ($this->_ajax_save('ClientOther', $this->request->data)) {
				$this->set('data',array('result'=>1));
			}else{
				$this->set('data',array('result'=>0));
			}
			$this->render('ajax_get_contact');
		}
		return;
	}
	/**
	 * 根据给定的bean的名字，保存data中的数据到db中
	 * @param string $bean
	 * @param array $data
	 */
	private function _ajax_save($bean,$data){
		return $this->$bean->save($data);
	}
	
	public function ajax_add_new(){
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			$contact_id = $this->request->data['contact_id'];
			$this->Contact->id = $contact_id;
			if ($this->Contact->exists()) {
				$count = $this->Client->find('count',array('conditions'=>array('Client.contact_id'=>$contact_id)));
				if ($count==0) {
					$bean = array('Client'=>array(
						'contact_id'=>$contact_id,
						'user_id'=>$this->Auth->user('id')
					));
					if ($this->Client->add_new_client($bean)) {
						$this->set('data',array('result'=>$this->Client->getID()));
					}else{
						//SAVE FAILED
						$this->set('data',array('result'=>-2));
					}
				}else{
					//表示该contact已经专为client了
					$this->set('data',array('result'=>-1));
				}
			}else{
				//表示client不存在或者已经被删除
				$this->set('data',array('result'=>0));
			}
			$this->render('ajax_get_contact');
		}
		return;
	}
}