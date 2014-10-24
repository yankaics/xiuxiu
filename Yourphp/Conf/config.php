<?php
$database = require ('./config.php');
$sys_config =  include DATA_PATH.  'sys.config.php';
if(empty($sys_config)){$sys_config=array();$sys_config['LAYOUT_ON']=1;}
if($sys_config['URL_MODEL']) $RULES = include DATA_PATH.  'Routes.php';
$config	= array(
		'DEFAULT_THEME'		=> 'Default',
		'DEFAULT_CHARSET' => 'utf-8',
		'APP_GROUP_LIST' => 'Home,Admin,User,Person,Company',
		'DEFAULT_GROUP' =>'Home',
		'TMPL_FILE_DEPR' => '_',
		'DB_FIELDS_CACHE' => false,
		'DB_FIELDTYPE_CHECK' => true,
		'URL_ROUTER_ON' => true,
		'DEFAULT_LANG'   => 'cn',
		'LANG_SWITCH_ON'		=> true,
		'LANG_LIST'=>'cn,zh-cn,en',
		'TAGLIB_LOAD' => true,
		'TAGLIB_PRE_LOAD' => 'Yp',
		'TMPL_ACTION_ERROR' => APP_PATH.'/Tpl/Home/Cici/Public/success.html',
		'TMPL_ACTION_SUCCESS' =>  APP_PATH.'/Tpl/Home/Cici/Public/success.html',
		'COOKIE_PREFIX'=>'YP_',
		'COOKIE_EXPIRE'=>'',
		'VAR_PAGE' => 'p',
		'LAYOUT_HOME_ON'=>$sys_config['LAYOUT_ON'],
		'URL_ROUTE_RULES' => $RULES,
		'TMPL_EXCEPTION_FILE' => APP_PATH.'/Tpl/Home/Cici/Public/exception.html',
		'TOKEN_ON'=>false
);

$system = array(
	//活动类型
	'HuodongType' => array('赛事选秀','招募代言人','展会招ShowGirl','剧组招人','其他'),
	'SEX_TYPE'=>array('男','女','不限'),
	'XUELI_TYPE'=>array('中专','大专','本科','本科以上'),
	'MONEY_TYPE'=>array('元/小时','元/天','元/次'),
	'MONEY_GET_TYPE'=>array('日结','周结','月结','完工结算'),
	'STATUS'=>array('审核中','未通过','进行中','过期'),
	'JIFEN_TYPE'=>array('默认','充值','获取','消费','冻结'),
	'USER_MONEY_TYPE'=>array('默认','充值','提现','退款','消费'),
	
	/*sun*/
	'S_SEX'=>array('1'=>'男','2'=>'女'),
    'S_STAR'=>array('1'=>'白羊座','2'=>'金牛座','3'=>'双子座','4'=>'巨蟹座','5'=>'狮子座','6'=>'处女座','7'=>'天秤座','8'=>'天蝎座','9'=>'射手座','10'=>'摩羯座','11'=>'水瓶座','12'=>'双鱼座'),
	'S_XUEXING'=>array('1'=>'A型','2'=>'B型','3'=>'AB型','4'=>'O型'),
 
	'S_ZHIYE'=>array('1'=>'平面模特','2'=>'展会模特','3'=>'广告模特','4'=>'商务模特','5'=>'礼仪模特','6'=>'活动模特','7'=>'美术模特','8'=>'视频模特','9'=>'T台模特','10'=>'外籍模特','11'=>'人体模特','12'=>'彩妆模特','13'=>'公关模特','14'=>'夜场模特','15'=>'Cosplay','16'=>'体育宝贝','17'=>'发模','18'=>'脸模','19'=>'胸模','20'=>'手摸','21'=>'腿模','22'=>'脚模','23'=>'童模','24'=>'中老年模特','25'=>'其他模特','26'=>'演员','27'=>'歌手','28'=>'主持人','29'=>'舞蹈者','30'=>'曲艺','31'=>'魔术师','32'=>'造型师','33'=>'摄影师','34'=>'化妆师','35'=>'其他'),
	'S_FENGGE'=>array('1'=>'英伦','2'=>'韩版','3'=>'日系','4'=>'民族','5'=>'复古','6'=>'OL风','7'=>'街头','8'=>'学院','9'=>'性感','10'=>'休闲','11'=>'运动','12'=>'淑女','13'=>'甜美','14'=>'可爱'),
	'S_BAR'=>array('1'=>'32A=70A','2'=>'32B=70B','3'=>'32C=70C','4'=>'34A=75A','5'=>'34B=75B','6'=>'34C=75C','7'=>'36A=80A','8'=>'36B=80B','9'=>'36C=80C','10'=>'38A=85A','11'=>'38B=85B','12'=>'38C=85C'),
	'S_FOOT'=>array('1'=>'34码','2'=>'35码','3'=>'36码','4'=>'37码','5'=>'38码','6'=>'39码','7'=>'40码','8'=>'41码','9'=>'42码','10'=>'43码','11'=>'44码'),
	'S_PRICE_TYPE'=>array('元/小时','元/天','元/次')
	
);

$xiuxiu=array(
 'S_OPENSET'=>array('元/小时','元/天','元/次')
);
return array_merge($database, $config ,$sys_config,$system,$xiuxiu);
?>
