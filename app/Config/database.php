<?php
class DATABASE_CONFIG {
	
	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'port' => 3306,
		'login' => 'novat915_admin',
		'password' => 'nV-toOl55555?',
		'database' => 'novat915_quenchcrm',
		'prefix' => '',
		'encoding' => 'utf8',
	);
	/*
	MYSQLS_DATABASE          : dep3ykdpvw4
MYSQLS_PASSWORD          : W568eeF7Kr1z
MYSQLS_PORT              : 3306
MYSQLS_HOSTNAME          : mysqlsdb.co8hm2var4k9.eu-west-1.rds.amazonaws.com
MYSQLS_USERNAME          : dep3ykdpvw4    
	
	public $default = array(
	 		'datasource' => 'Database/Mysql',
	 		'persistent' => false,
	 		'host' => 'mysqlsdb.co8hm2var4k9.eu-west-1.rds.amazonaws.com',
	 		'port' => 3306,
	 		'login' => 'dep3ykdpvw4',
	 		'password' => 'W568eeF7Kr1z',
	 		'database' => 'dep3ykdpvw4',
	 		'prefix' => '',
	 		'encoding' => 'utf8',
	);
	*/ 

	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'user',
		'password' => 'password',
		'database' => 'test_database_name',
		'prefix' => '',
		//'encoding' => 'utf8',
	);
}
