<?php
/**
  * User: xiaojie5525
*/

if(!defined("YOURPHP")) exit("Access Denied");
class JobAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('S_job');
    }

    public function index(){
        $this->assign("title",'工作经历');
  		
		$this->checkJob();
		$info=$this->getJobinfo();
		if(empty($info['onepricetype'])){
			$info['onepricetype']='元/小时';
		} 
		$this->assign("info",$info);
        $this->display();
    }
	public function getJobinfo(){
		$userid=$this->_userid;
		$where="";
		$where.=" userid='$userid'";
		$mod = $this->dao;
		$list = $mod->where($where)->order('id desc')->select();
		return  $list[0];
	}
	public function checkJob(){
		$userid=$this->_userid;
		$where="";
		$where.=" userid='$userid'";
		$mod = $this->dao;
		$count = $mod->where($where)->count();
		if($count==0){
			$_POSTs=array();
			$_POSTs['userid']=$userid;
		 if(!$this->dao->create($_POSTs)){
            $this->error($this->dao->getError());
        }
          
            $result =   $this->dao->add();
        
			
		}
	}
    public function save()
    {
        //$_POST['id']=$this->_userid;
		 $_POST['userid']=$this->_userid;
		 
        if(!$this->dao->create($_POST))
        {
            $this->error($this->dao->getError());
        }
       // $this->dao->update_time = time();
       // $this->dao->last_ip = get_client_ip();
        $result	=	$this->dao->save();
        if(false !== $result) {
            $this->success(L('do_success'));
        }else{
            $this->error(L('do_error'));
        }

    }

}