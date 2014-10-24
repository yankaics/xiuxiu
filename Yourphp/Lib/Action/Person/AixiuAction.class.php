<?php
/**
 * Created by IntelliJ IDEA.
 * User: appie
 * Date: 14-3-15
 * Time: 上午11:29
 */

if(!defined("YOURPHP")) exit("Access Denied");
class AixiuAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
	    $uid=$_GET['userid'];
	    $mod=M('user');	
		$map['id']=$uid;
		$u=$mod->where($map)->find();
		
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
		
		
		$this->assign('u',$u);
	    $this->assign('zhiye',C('S_ZHIYE'));
		$this->assign('fengge',C('S_FENGGE'));
		$this->assign('uid',$uid);
        $this->assign('title','我的爱秀 - 个人主页');
        $this->assign('url',U('Index/index'));
        $this->assign('aixiu_on',' class="on"');
        $this->display();
    }
    public function show()
    {
        $this->assign('title','我的爱秀 - 个人主页');
        $this->assign('url',U('Index/index'));
        $this->assign('aixiu_on',' class="on"');
        $this->display();
    }

}