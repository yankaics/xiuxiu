<?php
/**
 * 
 * IndexAction.class.php (前台首页)
 *
 * @package      	YOURPHP
 * @author          liuxun QQ:147613338 <admin@yourphp.cn>
 * @copyright     	Copyright (c) 2008-2011  (http://www.yourphp.cn)
 * @license         http://www.yourphp.cn/license.txt
 * @version        	YourPHP企业网站管理系统 v2.1 2011-03-01 yourphp.cn $
 */
if(!defined("YOURPHP")) exit("Access Denied"); 
class IndexAction extends BaseAction
{

    function _initialize()
    {
        parent::_initialize();
    }
 
    public function index()
    {
	   // $mod = M('user');

		$map["groupid"]=3;
		$map["modelType"]=9;
		//$list1 = $User->where($map)->order('create_time')->limit(10)->select();
		//$u = $mod->where($map)->limit(10)->select();
		
		$u=M()->table('tbl_user m,tbl_area n') ->where('m.city=n.id and m.groupid=3 and m.modelType=9')
              ->field('m.*,n.name pname')
              ->order('m.id desc')->limit(10)
              ->select();
			 
		
	   // $count= M()->table('hbr_productinfo m,hbr_producttype n') ->where($sql)->count();// 查询满足要求的总记录数
	 
		//for ($i= 0;$i< count($arr); $i++){
          //$str= $arr[$i];
        //  }
		
		$this->assign('bcid',0);//顶级栏目 
		//$this->assign('list1',$u);//顶级栏目 
		$this->assign('list1',$u);//顶级栏目 
		
        $this->display();
    }
	
	
  
 
}
?>