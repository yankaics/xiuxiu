<?php

if(!defined("YOURPHP")) exit("Access Denied");
class UserTestAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('usertest');
    }
	
	
	public function index()
	{
	   $this->assign("title",'我的相册1');
	   $this->display();
	
	}
	
	
	
	public  function  save()
	{
	  $Model=$this->dao;
      $data['username'] = $_POST["uname"];
      $data['password'] = $_POST["pwd"];
	  $id=isset($_POST["id"])?$_POST["id"]:0;
	  if($id>0)
	  {
	    $map["id"]=$id;
	    $result= $Model->where($map)->save($data); // 根据条件更新记录
       
	  }else{
	   // $User->where('id=5')->save($data); // 根据条件更新记录
	    $result= $Model->data($data)->add();
	  }
	  
	  if($result)
	  {
	     //echo 1;
		    $this->redirect('Home/Index/index');
		  
		  // $this->redirect('User/Login/index');
		  
		  
	  }else{
	     //echo 2;
		  $this->redirect('User/Login/index');
	  }
	}
	
}


?>