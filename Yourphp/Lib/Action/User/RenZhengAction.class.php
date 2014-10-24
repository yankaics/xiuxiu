<?php
/**
 * Created by IntelliJ IDEA.
 * User: appie
 * Date: 14-3-15
 * Time: 上午11:29
 */

if(!defined("YOURPHP")) exit("Access Denied");
class RenZhengAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('User');
    }

    public function index()
    {

        $this->assign("url",U('RenZheng/index'));
        if($this->isCompanyMember())
        {
            $this->assign("title",'机构认证');
        }
        else
        {
            $this->assign("title",'个人认证');
        }

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