<?php
/**
 * This class just for the provinces, but will not provide the CRUD
* @author justin
*
*/
class CustomerType extends AppModel{
	public $name = 'CustomerType';
	public $useTable = 'customer_types';
	public $hasMany = array('Customer');
	//暂时不添加belongsTo的属性
}