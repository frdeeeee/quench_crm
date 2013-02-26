<?php
define('LANG',0); //0表示中文，1表示英文
define('ADMIN',1); //表示Administrator
define('ROLE_MANAGER',2); //表示是经理Role
define('ROLE_USER',3); //表示是Normal User

define('IS_CLIENT', 2);  //对应contact表中的status字段的值
/*Task状态的可能值*/
define('TASK_NOT_START', 0);
define('TASK_IN_PROGRESS', 1);
define('TASK_FINISHED', 2);

define('SUCCESS', 1);
define('FAILED', 0);
define('WRONG_FILE_TYPE', 2);
define('SAVE_UPLOAD_FILE_FAILED', 3);

define('NOT_ASSIGNED', -1);  //表示报名的学生还没有被指定由哪个老师负责
define('PHASE_REGISTRATION', 1);  //报名阶段
define('PHASE_APPLY', 2);  //申请阶段
define('PHASE_SETTLE', 3);	//安置阶段
define('PHASE_VISA', 4);  //签证阶段
define('PHASE_BEFORE_LEAVING', 5);  //行前阶段
define('PHASE_OVERSEA', 6);		//赴美阶段
define('PHASE_RETURN', 7);    //回国阶段
define('PHASE_QUIT', 8);    //退出阶段
define('WAS_OTHERS', 9);    //其它

define('DELETED', 10); // deleted status in Enquiry, Applicant
define('NORMAL', 0); // normal status
define('WAS_CANCELED', 10); // applicant被取消之后，将status改成这个值

define('JOB_OFFER_UPLOADED', 1); // “joboffer状态”是 “已上传外方机构”的学生（鉴定标准）。
define('ALREADY_GOT_VISA', 2); //条件是“签证结果”是“通过”
define('USA_INFORMED', 1); //系统条件是“行程提交外方

define('PROJECT_SWT', 1); //SWT PROJECT
define('PROJECT_STEP', 2); //STEP PROJECT

define('OPERATION_OWNED_STUDENT', 0); //代表是途径为自主报名的学生
//CakePlugin::load('Facebook');
Cache::config('default', array('engine' => 'File'));
/*
 Cache::config('short', array(
 		'engine' => 'File', //[required]
 		'duration'=> 3600, //[optional]
 		'path'=>CACHE,
  		'prefix' => 'cake_short_', //[optional]  prefix every cache file with this string
 		'mask' => 0666,
 	));
 Cache::config('long',array(
 	'engine'=>'File',
 	'duration'=>'+1 week',
 	'probability'=>100,
 	'path'=>CACHE.'long'.DS,
 	'mask' => 0666,
 ));
*/

/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as 
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Cache Engine Configuration
 * Default settings provided below
 *
 * File storage engine.
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'File', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 * 		'path' => CACHE, //[optional] use system tmp directory - remember to use absolute path
 * 		'prefix' => 'cake_', //[optional]  prefix every cache file with this string
 * 		'lock' => false, //[optional]  use file locking
 * 		'serialize' => true, // [optional]
 * 		'mask' => 0666, // [optional] permission mask to use when creating cache files
 *	));
 *
 * APC (http://pecl.php.net/package/APC)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Apc', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 *	));
 *
 * Xcache (http://xcache.lighttpd.net/)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Xcache', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 *		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional] prefix every cache file with this string
 *		'user' => 'user', //user from xcache.admin.user settings
 *		'password' => 'password', //plaintext password (xcache.admin.pass)
 *	));
 *
 * Memcache (http://memcached.org/)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Memcache', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 * 		'servers' => array(
 * 			'127.0.0.1:11211' // localhost, default port 11211
 * 		), //[optional]
 * 		'persistent' => true, // [optional] set this to false for non-persistent connections
 * 		'compress' => false, // [optional] compress data in Memcache (slower, but uses less memory)
 *	));
 *
 *  Wincache (http://php.net/wincache)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Wincache', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 *		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 *	));
 */
//Cache::config('default', array('engine' => 'Xcache'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Plugin' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'Model' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'View' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'Controller' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'Model/Datasource' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'Model/Behavior' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'Controller/Component' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'View/Helper' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'Vendor' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'Console/Command' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'Locale' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

/**
 * Custom Inflector rules, can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */