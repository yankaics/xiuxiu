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
class JifenAction extends BaseAction
{

	function _initialize()
    {	
		parent::_initialize();
		
		$this->dao = M('Jifen');
		
    }

    public function index()
    {
    	$where = array('userid'=>$this->_userid);
    	$type = intval($_GET['type']);
    	if($type)
    	{
    		$where['type']=$type;
    	}
    	else
    	{
    		$where = 'userid='.$this->_userid.' AND ([type]=1 OR [type]=2)';
    	}
    	$typename = C('JIFEN_TYPE');
    	$typename[0] = '秀币存量';
		$list = $this->dao->where($where)->select();
		$this->assign('list',$list);
		$this->assign('type',$type);
		$this->assign('typename',C('JIFEN_TYPE'));
        $this->display();
    }
 
}
?>