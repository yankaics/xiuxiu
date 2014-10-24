<?php
/**
 * Created by IntelliJ IDEA.
 * User: appie
 * Date: 14-3-15
 * Time: 上午11:29
 */

if(!defined("YOURPHP")) exit("Access Denied");
class BasicAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('User');
    }

    public function index()
    {

        $this->assign("url",U('Basic/index'));
        $this->assign("title",'基本信息');
		
        if($this->user['avatar'])
        {
            $this->assign('basic_avatar',$this->user['avatar']);
        }
        else
        {
            $this->assign('basic_avatar','../Public/images/default_b.jpg');
        }

        if($this->isCompanyMember())
        {
            $this->assign('info_name','机构资料');
        }else
        {
            $this->assign('info_name','个人资料');
        }
		
        $mod = M('Area');
        $data = $mod->where('id='.$this->user['province'])->find();
        $province = $data['name'];
        $data = $mod->where('id='.$this->user['city'])->find();
        $city = $data['name'];
        $data = $mod->where('id='.$this->user['area'])->find();
        $area = $data['name'];

		$this->assign('sex',C('S_SEX'));
		$this->assign('star',C('S_STAR'));
		$this->assign('xuexing',C('S_XUEXING'));
		$this->assign('zhiye',C('S_ZHIYE'));
		$this->assign('fengge',C('S_FENGGE'));
		$this->assign('bar',C('S_BAR'));
		$this->assign('foot',C('S_FOOT'));
		$this->assign('price_type',C('S_PRICE_TYPE'));  //S_OPENSET
		
		
		
        $this->assign('province',$province);
        $this->assign('city',$city);
        $this->assign('area',$area);
        $this->display();
		
		
    }

    public function save()
    {
        $_POST['id']=$this->_userid;
        if(!$this->dao->create($_POST))
        {
            $this->error($this->dao->getError());
        }
        $this->dao->update_time = time();
        $this->dao->last_ip = get_client_ip();
        $result	=	$this->dao->save();
        if(false !== $result) {
            $this->success(L('do_success'));
        }else{
            $this->error(L('do_error'));
        }

    }

}