<?php
class PresentationsController extends AppController{
	public $uses = array('Presentation','User','GroupUser','Customer','Contact','CustomerType');
	public $name = 'Presentations';
	
	public $paginate = array(
			'limit' => 20,
			'order' => array(
					'Presentation.id'=>'DESC',
			),
			'recursive' => 1
	);
	
	private $channels = array(
			1=>'海报 ',2=>'校网',3=>'学生会',4=>'指导员',5=>'短信',6=>'其他'
			);
	
	public function beforeFilter(){
		parent::beforeFilter();
		//$this->set('projects',$this->Project->find('list'));
		$this->set('channels',$this->channels);
		$this->set('controller_name',$this->name);
		$this->set('action_name',$this->action);
	}
	
	public function beforeRender(){
		$this->set('current_menu','Presentations');
	}
	
	public function add(){
		if (empty($this->request->data)) {
			//首先根据groupid找到它拥有的学校客户
			//$this->set('schools',$this->Customer->find_my_schools($this->Session->read('my_group')));
			$this->_set_customers();
		}else{
			$this->request->data['Presentation']['user_id'] = $this->Auth->user('id'); //谁填写的这个记录，要保存起来
			if (count($this->request->data['Presentation']['projects'])>0) {
				$str = '';
				foreach( $this->request->data['Presentation']['projects'] as $value){
					$str .= $value.',';
				}
				$this->request->data['Presentation']['projects'] = $str;
			}
			if (count($this->request->data['Presentation']['channels'])>0) {
				$str = '';
				foreach( $this->request->data['Presentation']['channels'] as $value){
					$str .= $value.',';
				}
				$this->request->data['Presentation']['channels'] = $str;
			}
			
			if($this->Presentation->save($this->request->data)){
				$this->Session->setFlash('宣讲会记录添加成功!');
				$this->redirect(array('action'=>'statistic_report'));
			}else{
				//添加失败
				$this->set('msg_type','error');
				$this->Session->setFlash('无法添加您的宣讲会记录, 请稍候再试!');
			}
		}
		return;
	}
	
	public function view_detail($pid = null){
		if ($pid) {
			$this->Presentation->id = $pid;
			if ($this->Presentation->exists()) {
				$this->set('channels',$this->channels);
				//$this->set('projects',$this->Project->find('list'));
				$this->set('data',$this->Presentation->read());
			}else{
				throw new NotFoundException('无法找到您需要宣讲会纪录');
			}
		}
		return;
	}
	
	/**
	 * For admin and directors use
	 * @param Integer group_id
	 */
	public function list_all_by_group_id($group_id = null){
		$this->paginate['conditions'] = array('Presentation.group_id'=>$group_id);
		//$this->set('projects',$this->Project->find('list'));
		$this->set('data',$this->paginate('Presentation'));
		$this->render('list_all');
		return;
	}
	
	public function remove($pid = null){
		if ($pid) {
			$this->Presentation->id = $pid;
			if ($this->Presentation->exists()) {
				if($this->Presentation->delete($pid)){
					$this->Session->setFlash('宣讲会记录删除成功!');
					$this->redirect(array('action'=>'statistic_report'));
				}else{
					$this->Session->setFlash('无法删除宣讲会记录，请稍候再试!');
					$this->redirect(array('action'=>'statistic_report'));
				}
			}else {
				$this->Session->setFlash('宣讲会记录删除成功!');
				$this->redirect(array('action'=>'statistic_report'));
			}
		}
		return;
	}
	
	/**
	 * View presentations by the current login user's group id
	 * @param unknown_type $msg_type
	 */
	public function list_all($msg_type = null){
		$this->set('schools',$this->Customer->find('list',array('conditions'=>array('Customer.group_id'=>$this->Session->read('my_group')))));
		$d = $this->Presentation->sales_statistic($this->request->data,$this->Session->read('my_group'));
		$this->set('data',$d);
		$this->set('no_pagi',1);
		if ($msg_type) {
			$this->set('msg_type',$msg_type);
		}
		$this->render('statistic_report');
		return;
	}
	
	public function statistic_report($customer_id = NULL,$to_excel=0,$search_url_id=NULL){
		$this->loadModel('SearchUrl');
		if ($search_url_id) {
			//检查是否提交了search url id，如果提交了，找出对应的纪录并解析后存到request中
			$this->SearchUrl->id = $search_url_id;
			parse_str($this->SearchUrl->field('link'),$this->request->data);
		}else {
			//如果没有，检查是否已经有了对应的search url id
			if ($this->request->data) {
				$search_str = http_build_query($this->request->data);
				$bean = $this->SearchUrl->find('first',array('conditions'=>array('SearchUrl.link'=>$search_str)));
				if (empty($bean['SearchUrl']['id'])) {
					$bean['SearchUrl']['link']=$search_str;
					$this->SearchUrl->save($bean);
					$search_url_id = $this->SearchUrl->id;
				}else{
					$search_url_id = $bean['SearchUrl']['id'];
				}
			}
		}
		$this->set('current_query_id',$search_url_id);
		$this->set('schools',$this->Customer->find('list',array('conditions'=>array('Customer.group_id'=>$this->Session->read('my_group')))));
		if ($customer_id){
			$this->request->data['Statistic']['customer_id'] = $customer_id;
		}
		$d = $this->Presentation->sales_statistic($this->request->data,$this->Session->read('my_group'));
		$this->set('data',$d);
		$this->set('no_pagi',1);
		if ($to_excel==1) {
			$output_file_name = 'presentation_statistic_'.time().'.xls';
			$this->set('output_file_name',$output_file_name);
			$this->render('to_excel','excel');
		}
		return;
	}
}