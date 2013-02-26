<?php
/**
 * This class just for the provinces, but will not provide the CRUD
 * @author justin
 *
 */
class Province extends AppModel{
	public $name = 'Province';
	public $hasMany = array('Customer');
	//暂时不添加belongsTo的属性
	public $validates = array(
			'name' => array(
					'rule' => 'notEmpty',
					'message' => 'A Province must have a name!'
			)
	);
}