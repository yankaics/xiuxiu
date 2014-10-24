<?php
include("top.php");
header("Content-Type:text/json; charset:utf-8");
$act = getparam('act');
$ime = getparam('ime');



if(!$act || !$ime)
{
	out(null,ERROR_PARAM,'参数不正确');
}

$devices = include('devices.php');
if($act != 'add' && !isset($devices[$ime]))
{
	out(null,ERROR_DEVICE_NOT_EXIST,'设备不存在');	
}
$downlist = include('downlist.php');
switch ($act) {
	//添加设备
	case 'add':
		$name = getparam('name');
		$os = getparam('os');
		$total = isset($_GET['total'])?intval($_GET['total']):0;
		$avai = isset($_GET['avai'])?intval($_GET['avai']):0;
		if(!$name || !$os)
		{
			out(null,ERROR_PARAM,'添加设备参数不正确');
		}
		$devices[$ime] = array('name'=>$name,'os'=>$os,'total'=>$total,'avai'=>$avai);
		$devices = updateDevice($devices);
		out($devices);
		break;
	//查询下载任务
	case 'query':
		if(!isset($downlist[$ime]))
		{
			out(null,ERROR_EMPTY,'列表为空');
		}
		$list = array();
		foreach ($downlist[$ime] as $key) 
		{
			//只查询等待下载任务和取消的任务
			if($key['status'] == STATUS_READY || $key['status'] == STATUS_CANCEL )
			{
				$list[]=$key;
			}
		}
		if(!$list)
		{
			out(null,ERROR_EMPTY,'无下载任务');
		}
		out($list);		
		break;
	//更新进度
	case 'update':
		if(!isset($downlist[$ime]))
		{
			out(null,ERROR_EMPTY,'列表为空');
		}
		$downid = isset($_GET['downid'])?intval($_GET['downid']):0;
		$progress = isset($_GET['progress'])?intval($_GET['progress']):-1;

		if(!$downid || $progress<0)
		{
			out(null,ERROR_PARAM,'更新任务参数不正确');
		}

		for($i=0;$i<count($downlist[$ime]);$i++)
		{
			if($downlist[$ime][$i]['downid'] == $downid)
			{
				if($downlist[$ime][$i]['status'] != STATUS_DOWNING)
				{
					out(null,ERROR_PARAM,'下载状态不正确');
				}
				if($downlist[$ime][$i]['progress'] == $progress)
				{
					out(null,ERROR_NOT_MODIFY,"值没有变更");
				}
				$downlist[$ime][$i]['progress'] = $progress;

				$downlist = updateTask($downlist);				
				out($downlist[$ime][$i]);
			}
		}
		out(null,ERROR_EMPTY,'列表为空,指定下载不存在');
		break;
	//更新状态
	case 'updatestatus':
		if(!isset($downlist[$ime]))
		{
			out(null,ERROR_EMPTY,'列表为空');
		}
		$downid = isset($_GET['downid'])?intval($_GET['downid']):0;
		$status = isset($_GET['status'])?intval($_GET['status']):-1;
		$msg = getparam('msg');
		if(!$downid || $status<0)
		{
			out(null,ERROR_PARAM,'更新状态参数不正确');
		}
		for($i=0;$i<count($downlist[$ime]);$i++)
		{
			if($downlist[$ime][$i]['downid'] == $downid)
			{
				if($downlist[$ime][$i]['status'] == $status)
				{
					out(null,ERROR_NOT_MODIFY,"值没有变更");
				}
				$downlist[$ime][$i]['status'] = $status;
				$downlist[$ime][$i]['progress'] = 0;
				
				if($msg)
				{
					$downlist[$ime][$i]['msg'] = $msg;
				}

				$downlist = updateTask($downlist);
				out($downlist[$ime][$i]);
			}
		}
		out(null,ERROR_EMPTY,'列表为空,指定下载不存在');
		break;
	default:
		out(null,ERROR_PARAM,'行为参数不正确');
		break;
}
?>