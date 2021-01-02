<?php
@ini_set('display_errors','1');
ob_start();
session_start();


function __autoload($className){
	if (!class_exists($className, false)){
		$classPath = explode('_', $className);
		$classPath = array_slice($classPath, 1, 2);
			require_once(dirname(__FILE__).'/model/'.$className.'.class.php');
	}
}
define('DB_SERVER','localhost');
define('DB_NAME','user');
define('DB_USER','root');
define('DB_PASS','');
define('DB_PREFIX','');
define('DB_TYPE', 'MySQL');
define('DB_PORT', 3306);
define('EXTN', '/');


$CONFIG_SERVER_ROOT = "http://localhost/frontend-test/";

$commonObj  = new Common();

define('BASE_PATH', dirname(__FILE__));


?>