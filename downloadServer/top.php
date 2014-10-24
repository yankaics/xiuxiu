<?php
/*
devices.php 设备列表
字段 array(
	'设备IME'=>array(
		'name'=>设备名称',
		'os'=>'设备操作系统'
	)
)

downlist.php 下载
字段说明
downid 下载ID唯一识别下载项 目前是添加下载的时间
url 下载的地址
name 存在到本地的文件名
status 下载状态 1等待下载  2正在下载 3下载出错 4取消下载 5下载完成
progress 下载进度  0-100的值
msg 下载出错的描述信息


错误码说明 1参数错误 2设备不存在 3列表为空或返回数据为空 4取消下载 5值没有变更
*/
define("STATUS_READY", 1);
define("STATUS_DOWNING", 2);
define("STATUS_ERROR", 3);
define("STATUS_CANCEL", 4);
define("STATUS_FINISH", 5);


define("ERROR_PARAM",1);
define("ERROR_DEVICE_NOT_EXIST", 2);
define("ERROR_EMPTY", 3);
define("ERROR_CANCEL",4);
define("ERROR_NOT_MODIFY", 5);




function getparam($key)
{
	
	$v = '';
	if(isset($_GET[$key]))
	{
		$v = str_replace('\'', '', trim($_GET[$key]));
	}

	return $v;
}
function updateDevice($data)
{
	$content = '<?php return '.var_export($data,true).';?>';
	$path = dirname(__FILE__).'/devices.php';
	file_put_contents($path, $content);
}
function updateTask($data)
{
	$content = '<?php return '.var_export($data,true).';?>';
	$path = dirname(__FILE__).'/downlist.php';
	file_put_contents($path, $content);
}
function outpage($msg='',$href='javascript:history.go(-1);')
{
	$head = <<<sql
	<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>出错了</title>
    <style>
   		* {font-size: 13px}
    </style>
	</head>
	<body>
sql;
	echo $head;
	$msg = '错误:'.$msg.' <a href="'.$href.'">返回</a>';
	echo($msg);
	echo '</body></html>';
	exit(0);
}
function out($list,$code=0,$msg='')
{
	$arr = array();
	if($code!=0)
	{
		$arr = array('code'=>$code,'msg'=>$msg);
	}
	else
	{
		$arr = array('code'=>0,'list'=>$list);
	}

	echo json_encode($arr);
	die();
}

function redirect($url = 'index.php')
{
	header('Location: '.$url);
	exit(0);
}
?>