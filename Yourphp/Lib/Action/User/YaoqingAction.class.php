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
class YaoqingAction extends BaseAction
{

	function _initialize()
    {	
		parent::_initialize();
		
		
		
    }

    public function index()
    {
    	
        $this->display();
    }
 
}
?>