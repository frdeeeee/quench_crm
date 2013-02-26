<?php
/**
 * This class just for the provinces, but will not provide the CRUD
 * @author justin
 *
 */
class Customer extends AppModel{
	public $name = 'Customer';
	public $belongsTo = array('Province','Group','User','CustomerType'=>array('foreignKey'=>'customerType_id'));
	public $hasMany = array('Contact'=>array('conditions'=>array('Contact.available=1')));
	//暂时不添加belongsTo的属性
	public $validate = array(
			'name' => array(
					'rule' => 'notEmpty',
					'message' => '学校或代理的名称不能为空!'
			)
	);
	
	public function find_my_schools($group_id = NULL){
		return $this->find('list',array(
			'conditions'=>array(
				'AND'=>array(
					'Customer.group_id'=>$group_id,
					'Customer.available' => 1,
					//'Customer.customerType_id' => 1 //表示学校
				)
			)
		));
	}
	
	public function get_id_and_name_by_group($group_id = NULL){
		$this->unbindModel(
			array(
				'belongsTo'=>array('Province','Group','User','CustomerType'),
				'hasMany' => array('Contact')
			)
		);
		
		return $this->find('all',array(
			'conditions'=>array(
			    'AND'=>array(
					'Customer.group_id'=>$group_id,
					'Customer.available=1'
				)	),
			'fields' => array('Customer.id','Customer.name')
		));
	}
	
	/**
	 * 根据提交的id给出customer的省份和联系人姓名的方法，主要是相应客户端的ajax请求
	 * @param Integer $cid
	 */
	public function get_contacts_and_location($cid = null,$group_id = NULL){
		$options['joins'] = array(
				array(
						'table'=>'provinces',
						'alias'=>'Province',
						'type'=>'RIGHT',
						'conditions'=>array(
								'Customer.province_id = Province.id'
								),
						'fields'=>array('Province.name')
						),
				array(
						'table'=>'customer_types',
						'alias'=>'CustomerType',
						'type'=>'RIGHT',
						'conditions'=>array(
								'Customer.customerType_id = CustomerType.id'
						),
						'fields'=>array('CustomerType.name')
				),
				array(
						'table'=>'contacts',
						'alias'=>'Contact',
						'type'=>'LEFT',
						'conditions'=>array(
							'and'=>array('Customer.id = Contact.customer_id','Contact.available=1')
						)
				)
				);
		$options['conditions'] = array('Customer.id'=>$cid);
		$options['recursive'] = -1;
		$options['fields'] = array(
				'Province.name','CustomerType.name','Contact.name','Contact.id','Customer.city'
				);
		return $this->find('all',$options);
	}
}