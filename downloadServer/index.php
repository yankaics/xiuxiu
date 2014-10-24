<?php 
require("top.php");
header("Content-Type:text/html; charset:utf-8");
$devices = include("devices.php");
$downlist = include("downlist.php");


$act = getparam('act');
$ime = '';
if($act)
{
	$ime = getparam('ime');
	if(!$devices[$ime])
	{
		outpage('设备不存在');
	}
}

switch ($act)
{
	case 'addtasksave':
		$url = getparam('url');
		$name = getparam('name');
		if(!$url || !$name)
		{
			outpage('网址参数不正确');
		}

		$time = time();
		$downlist[$ime][] = array('downid'=>$time,'url'=>$url,'name'=>$name,'progress'=>0,'status'=>STATUS_READY);
		updateTask($downlist);
		redirect('index.php?act=list&ime='.$ime);
		break;
	case 'del':
		unset($devices[$ime]);
		updateDevice($devices);	
		if(isset($downlist[$ime]))
		{
			unset($downlist[$ime]);
			updateTask($downlist);
		}
		redirect('index.php');
		break;
	case 'deltask':
		if(!isset($downlist[$ime]))
		{
			outpage('下载列表为空');
		}
		$downid = isset($_GET['downid'])?intval($_GET['downid']):0;
		if(!$downid)
		{
			outpage('删除任务参数不正确');
		}
		for($i=0;$i<count($downlist[$ime]);$i++)
		{
			if($downlist[$ime][$i]['downid'] == $downid)
			{
				unset($downlist[$ime][$i]);				
				updateTask($downlist);
				redirect('index.php?act=list&ime='.$ime);
			}
		}
		outpage('指定下载任务不存在');
		break;
	case 'again':
		if(!isset($downlist[$ime]))
		{
			outpage('下载列表为空');
		}
		$downid = isset($_GET['downid'])?intval($_GET['downid']):0;
		if(!$downid)
		{
			outpage('任务参数不正确');
		}
		for($i=0;$i<count($downlist[$ime]);$i++)
		{
			if($downlist[$ime][$i]['downid'] == $downid)
			{
				$downlist[$ime][$i]['status']=STATUS_READY;				
				updateTask($downlist);
				redirect('index.php?act=list&ime='.$ime);
			}
		}

		outpage('指定下载任务不存在');
		break;
	case 'cancel':
		if(!isset($downlist[$ime]))
		{
			outpage('下载列表为空');
		}
		$downid = isset($_GET['downid'])?intval($_GET['downid']):0;
		if(!$downid)
		{
			outpage('任务参数不正确');
		}
		for($i=0;$i<count($downlist[$ime]);$i++)
		{
			if($downlist[$ime][$i]['downid'] == $downid)
			{
				$downlist[$ime][$i]['status']=STATUS_CANCEL;				
				updateTask($downlist);
				redirect('index.php?act=list&ime='.$ime);
			}
		}

		outpage('指定下载任务不存在');
		break;
	
	default:
		# code...
		break;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>
        download
    </title>
   <style>
   		* {font-size: 13px}
        td {text-align: center;vertical-align: center; padding: 2px; border: 1px solid #ccc; word-break:break-all; }
        img {border: 0px; width: 220px; height: 220px}
    </style>
    <script type="text/javascript">
    function delconfirm()
    {
    	return confirm('确认要进行此操作吗？');
    }
    </script>
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border: 1px solid #ccc">
    <tr>
        <th>设备名称</th>
        <th width="20%">系统版本/ime</th>
        <th width="20%">任务数</th>
        <th width="20%">操作</th>
    </tr>
    <?php
    
    foreach ($devices as $key => $value) 
    {
    	$downcount = 0;
    	if(isset($downlist[$key]))
    	{
    		$downcount = count($downlist[$key]);
    	}
    	echo '<tr><td>'.$value['name'].'/'.$key.'('.$value['avai'].'KB/'.$value['total'].'KB)</td><td>'.$value['os'].'</td>'.'<td><a href="index.php?act=list&ime='.$key.'">'.$downcount.'</a></td>';
    	echo '<td><a href="index.php?act=addtask&ime='.$key.'">添加任务</a> | <a href="index.php?act=del&ime='.$key.'" onclick="return delconfirm();">删除设备</a></td></tr>';
    }
    ?>
</table>

<?php
if($act == 'list')
{
?>
<br />
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border: 1px solid #ccc">
    <tr>
        <th width="60%">任务地址</th>
        <th width="20%">文件名</th>
        <th width="20%">当前状态</th>
    </tr>
    <?php
    if(isset($downlist[$ime]))
    {
	    foreach ($downlist[$ime] as $value) 
	    {
	    	echo '<tr><td>'.$value['url'].'</td><td>'.$value['name'].'</td><td>';
	    	switch ($value['status']) {
	    		case STATUS_READY:
	    			echo '等待下载启动';
	    			break;
	    		case STATUS_DOWNING:    		
	    			echo '正在下载 已完成 '.$value['progress'].'% ';
	    			echo '<a href="index.php?act=cancel&ime='.$ime.'&downid='.$value['downid'].'">取消下载</a>';	
	    			break;
	    		case STATUS_ERROR:
	    			echo '下载失败 <a href="index.php?act=again&ime='.$ime.'&downid='.$value['downid'].'">重新下载</a>';
	    			if($value['msg'])
	    			{
	    				echo '<br />错误信息：'.$value['msg'];
	    			}
	    			break;
	    		case STATUS_CANCEL:
	    			echo '取消下载 <a href="index.php?act=again&ime='.$ime.'&downid='.$value['downid'].'">重新下载</a>';
	    			break;
	    		case STATUS_FINISH:
	    			echo '下载已经完成！ <a href="index.php?act=again&ime='.$ime.'&downid='.$value['downid'].'">重新下载</a>';
	    			break;
	    		default:
	    			echo "未知状态";
	    			break;
	    			
	    	}
	    	if($value['status'] == STATUS_ERROR || $value['status'] == STATUS_FINISH || $value['status'] == STATUS_CANCEL)
	    	{
	    		echo ' <a href="index.php?act=deltask&ime='.$ime.'&downid='.$value['downid'].'" onclick="return delconfirm();">删除下载</a>';
	    	}	    	
	    	echo '</td></tr>';
	    }
	}
    ?>
</table>
<?php
}
if($act == 'addtask')
{
?>
<br />
<form action="index.php" method="get">
	<input type="hidden" name="act" value="addtasksave" />
	<input type="hidden" name="ime" value="<?php echo $ime;?>" />
	<p>下载地址：<input type="text" size="80" name="url" /> &nbsp;保存文件名：<input type="text" name="name" />&nbsp;<input type="submit" name="s" value="提交" /> </p>
</form>
<?php
}
?>
</body>
</html>