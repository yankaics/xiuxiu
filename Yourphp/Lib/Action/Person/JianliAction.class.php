<?php
/**
 * Created by IntelliJ IDEA.
 * User: appie
 * Date: 14-3-15
 * Time: 上午11:29
 */

if(!defined("YOURPHP")) exit("Access Denied");
class JianliAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
	    $uid=$_GET['userid'];
		
		$mod=M('userresume');
	    /*
		$list=M()->table('tbl_user m,tbl_userresume n') ->where($sql)
              ->field('m.realname,,n.producttype pname')
              ->order('m.id desc')->page($nowPage.',10')
              ->select();
			  */
		$sql["ruserid"]=$uid;
		
		$mod_u=M('user');	
		$map['id']=$uid;
		$u=$mod_u->where($map)->find();
		$this->assign('u',$u);
	    
		$diqu = M('Area');
        $data = $diqu->where('id='.$u['province'])->find();
        $province = $data['name'];
        $data = $diqu->where('id='.$u['city'])->find();
        $city = $data['name'];
        $data = $diqu->where('id='.$u['area'])->find();
        $area = $data['name'];

        $this->assign('province',$province);
        $this->assign('city',$city);
        $this->assign('area',$area);
		
		
		
		$list=$mod->where($sql)->select();
		$this->assign('list',$list);
		$this->assign('zhiye',C('S_ZHIYE'));
		$this->assign('fengge',C('S_FENGGE'));
		$this->assign('uid',$uid);
        $this->assign('title','我的简历 - 个人主页');
        $this->assign('url',U('Index/index'));
        $this->assign('jianli_on',' class="on"');
        $this->display();
		
		
		 /*
		  $list=M()->table('hbr_productinfo m,hbr_producttype n') ->where($sql)
              ->field('m.*,n.producttype pname')
              ->order('m.id desc')->page($nowPage.',10')
              ->select();
			  
			  */
			  
	  // $count= M()->table('hbr_productinfo m,hbr_producttype n') ->where($sql)->count();// 查询满足要求的总记录数
	  
	  
	  
			 
    }

    public function show()
    {
        $this->assign('title','我的简历 - 个人主页');
        $this->assign('url',U('Index/index'));
        $this->assign('jianli_on',' class="on"');
        $this->display();
    }
    
}