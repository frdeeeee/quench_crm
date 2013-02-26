<?php
/**
 * This class just for the provinces, but will not provide the CRUD
 * @author justin
 *
 */
class Contact extends AppModel{
	public $name = 'Contact';
	public $useTable = 'crm_contacts';
	
	public $virtualFields = array(
	    'name' => 'CONCAT(Contact.first_name, " ", Contact.last_name, "; ", Contact.company)'
	);
	
	public $belongsTo = array('Type',
		'Lead'=>array(
			'foreignKey'=>'lead_id',
			'className'=>'CustomerType'));
	/*
	//暂时不添加belongsTo的属性
	public $validate = array(
			'name' => array(
					'rule' => 'notEmpty',
					'message' => '联系人的名字不能为空!'
			)
	);
	*/
	
	public function get_contact_ajax($contact_id = null){
		$this->unbindModel(array('belongsTo'=>array('Customer')));
		return $this->find('first',array(
				'conditions'=>array('Contact.id'=>$contact_id),
				'fields'=>array(
						'Contact.department',
						'Contact.manager',
						'Contact.mobile',
						'Contact.office',
						'Contact.email',
						'Contact.fax',
						)
				));
	}
}