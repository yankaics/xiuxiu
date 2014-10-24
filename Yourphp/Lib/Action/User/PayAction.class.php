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
class PayAction extends BaseAction
{

	function _initialize()
    {	
		parent::_initialize();
		if(!$this->_userid){
			//$this->assign('jumpUrl',U('User/Login/index'));
			//$this->error(L('nologin'));
		}
		$this->dao = M('User');
		$this->assign('bcid',0);
		$user = $this->dao->find($this->_userid);
		$this->assign('vo',$user);
    }

    public function index()
    {
    	
        $this->display();
    }


	public function Recharge()
    {
        $this->display();
    }
	

	public function pay()
    {
    	
    	$paymentid= intval($_POST['bc']);
    	$orderMoney = floatval($_POST['orderMoney']);
    	if($paymentid<=0 || $orderMoney<=0)
    	{
    		$this->error('参数错误');
    	}
		$Payment = M('Payment')->find($paymentid);
		if(!$Payment)
		{
			$this->error('支付方式不存在');
		}
		$aliapy_config = unserialize($Payment['pay_config']);
		$pay_code = $Payment['pay_code'];
		$aliapy_config['order_sn']= $this->_userid;
		$aliapy_config['order_amount']= $orderMoney;
		$aliapy_config['body'] = '在线充值';
		// var_dump($pay_code);
		// exit;
		import("@.Pay.".$pay_code);
		$pay=new $pay_code($aliapy_config);
		$payurl = $pay->get_code();
		$this->assign('orderMoney',$orderMoney);
		$this->assign('payurl',$payurl);
        $this->display();
    }
	public function respond()
	{
		$pay_code = !empty($_REQUEST['code']) ? trim($_REQUEST['code']) : '';	
		$pay_code = ucfirst($pay_code);
		$Payment = M('Payment')->getByPayCode($pay_code);
		if(empty($Payment))$this->error(L('PAY CODE EROOR!'));
		$aliapy_config = unserialize($Payment['pay_config']);		 
		import("@.Pay.".$pay_code);
		$pay=new $pay_code($aliapy_config);
		$r = $pay->respond();	
		$this->assign('jumpUrl',URL('User-Order/index'));
		if($r){
			$this->error(L('PAY_OK'));
		}else{
			$this->error(L('PAY_FAIL'));
		}
	}
 
}
?>