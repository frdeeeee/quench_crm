<?php
/**
 * This class just for the provinces, but will not provide the CRUD
 * @author justin
 *
 */
class Client extends AppModel{
	public $name = 'Client';
	public $useTable = 'crm_clients';
	public $belongsTo = array('Contact'=>array('foreignKey'=>'contact_id'));
	public $hasOne = array(
		'ClientWebhosting'=>array('foreignKey'=>'client_id'),
		'ClientSocial'=>array('foreignKey'=>'client_id'),
		'ClientSEO'=>array('foreignKey'=>'client_id'),
		'ClientSEM'=>array('foreignKey'=>'client_id'),
		'ClientOther'=>array('foreignKey'=>'client_id'),
		'ClientAccounting'=>array('foreignKey'=>'client_id')
	);
	public $business_areas = array('Hosting','Social','SEO','SEM');
	
	/**
	 * 专门用来保存新client的方法，一般是从contact转为client，因此要更新contact中的status字段
	 * @param array $bean
	 */
	public function add_new_client($bean = NULL){
		$ds = $this->getDataSource();
		$flag = TRUE;
		$ds->begin();
		if ($this->save($bean)) {
			App::uses('Contact', 'Model');
			$Contact = new Contact();
			$Contact->id = $bean['Client']['contact_id'];
			if(!$Contact->saveField('status', IS_CLIENT)){
				$flag = FALSE;
			}else{
				//client的数据保存成功
				App::uses('ClientWebhosting', 'Model');
				$ClientWebhosting = new ClientWebhosting();
				if (!$ClientWebhosting->save(array('ClientWebhosting'=>array('client_id'=>$this->getID())))) {
					$flag = FALSE;
				}
				App::uses('ClientSocial', 'Model');
				$ClientSocial = new ClientSocial();
				if (!$ClientSocial->save(array('ClientSocial'=>array('client_id'=>$this->getID())))) {
					$flag = FALSE;
				}
				App::uses('ClientSEO', 'Model');
				$ClientSEO = new ClientSEO();
				if (!$ClientSEO->save(array('ClientSEO'=>array('client_id'=>$this->getID())))) {
					$flag = FALSE;
				}
				App::uses('ClientSEM', 'Model');
				$ClientSEM = new ClientSEM();
				if (!$ClientSEM->save(array('ClientSEM'=>array('client_id'=>$this->getID())))) {
					$flag = FALSE;
				}
				App::uses('ClientOther', 'Model');
				$ClientOther = new ClientOther();
				if (!$ClientOther->save(array('ClientOther'=>array('client_id'=>$this->getID())))) {
					$flag = FALSE;
				}
				App::uses('ClientAccounting', 'Model');
				$ClientAccounting = new ClientAccounting();
				if (!$ClientAccounting->save(array('ClientAccounting'=>array('client_id'=>$this->getID())))) {
					$flag = FALSE;
				}
			}
			
		}else{
			$flag = FALSE;
		}
		if ($flag) {
			$ds->commit();
		}else{
			$ds->rollback();
		}
		return $flag;
	}
}