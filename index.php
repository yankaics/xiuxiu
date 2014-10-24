<?php
/**
 *
 * index(����ļ�)
 *
 * @package      	YOURPHP
 * @author          liuxun QQ:147613338 <web@yourphp.cn>
 * @copyright     	Copyright (c) 2008-2011  (http://www.yourphp.cn)
 * @license         http://www.yourphp.cn/license.txt
 * @version        	yourphp��ҵ��վϵͳ v2.0 2011-03-01 yourphp.cn $
 */
if (!is_file('./config.php')) header("location: ./Install");
header("Content-type: text/html; charset=utf-8");
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
define('YOURPHP', 'YourPHP');
define('UPLOAD_PATH', './Uploads/');
define('VERSION', 'v1.0');
define('UPDATETIME', '20140228');
define('APP_NAME', 'Yourphp');
define('APP_PATH', './Yourphp/');
define('APP_LANG', false);
define('APP_DEBUG',true);
define('THINK_PATH','./Core/');
define('DEBUG',true);
require(THINK_PATH.'/Core.php');
?>