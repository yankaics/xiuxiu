<?php
/**
 * PayAction.class.php (支付模块)
 *
 * @package      	YOURPHP
 * @author          liuxun QQ:147613338 <admin@yourphp.cn>
 * @copyright     	Copyright (c) 2008-2011  (http://www.yourphp.cn)
 * @license         http://www.yourphp.cn/license.txt
 * @version        	YourPHP企业网站管理系统 v2.1 2011-03-01 yourphp.cn $
 */
if(!defined("YOURPHP")) exit("Access Denied");
class MoneyAction extends BaseAction
{

	function _initialize()
    {	
		parent::_initialize();
		
		$this->dao = M('Money');
		
    }

    public function index()
    {
    	$where = array('userid'=>$this->_userid);
    	$type = intval($_GET['type']);
    	if($type)
    	{
    		$where['type']=$type;
    	}
    	
    	$typename = C('USER_MONEY_TYPE');
		$list = $this->dao->where($where)->select();
		$this->assign('list',$list);
		$this->assign('type',$type);
		$this->assign('typename',$typename);
        $this->display();
    }
 
}
?>