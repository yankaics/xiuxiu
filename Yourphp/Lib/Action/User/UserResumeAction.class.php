<?php
 

if(!defined("YOURPHP")) exit("Access Denied");

class UserResumeAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('userresume');
		$this->allcount=6;
		
    }

    public function index()
    {

        $this->assign("url",U('UserResume/index'));
        $this->assign("title",'我的简历');
		
		
        import ('@.ORG.Page');
        $mod = $this->dao;
        $where = 'ruserid='.$this->_userid;
        $order = 'id desc';
		
        if(isset($_GET['sort']))
        {
            $order = str_replace('\'','',trim($_GET['sort']));
            $order = $order .' desc';
        }
		
        $count = $mod->where($where)->count();
		
        $listRows =  C('PAGE_LISTROWS');      
        $page = new Page ( $count, $listRows );
        $pages = $page->show();
        $list = $mod->where($where)->order(array('rdatetime'=>'desc'))->limit($page->firstRow . ',' . $page->listRows)->select();
       // print_r($list);
	   
	   // echo $list['rname'];
		/*
		for ($i= 0;$i< count($list); $i++){
           $str= $list[$i];
          echo $str['rname'];
        }
		*/
	   
        $jsoncontent = is_array($list)?$list:array();
		
        $this->assign('jsoncontent',json_encode($jsoncontent));
		
		//echo $list.rname;
		
		 
       
        $this->assign('pages',$pages);
        $this->assign('list',$list);
		$this->assign('count',$count);
		$rearr=$this->resumeset();
		//echo C('S_OPENSET')[0];
		$this->assign('openset',$rearr['S_OPENSET']); 
		
		
		$this->assign('allcount',$this->allcount);
        $this->display();
		
		
		
    }

   

    public function save()
    {
	  $Model = M('userresume'); // 实例化User对象
	  
	  
	  $p=0;
	  $t=4.5;
	  $data['ruserid'] = $this->_userid;
      $data['rname'] = $_POST["name"];
	  
	  if($data['rname'])
	  {
	   $p=$p+$t;
	  }
	 
	  
	  $data['rjlname'] = $_POST["jlname"];
	  
	  if($data['rjlname'])
	  {
	   $p=$p+$t;
	  }
	  
      $data['rsex'] = $_POST["sex"];
	  
	  if($data['rsex'])
	  {
	   $p=$p+$t;
	  }
	  
	  $data['rprovince']=$_POST["province"];
	  
	  if($data['rprovince'])
	  {
	   $p=$p+$t;
	  }
	  
	  
	  
	  $data['rcity']=$_POST["city"];
	  $data['rarea']=$_POST["area"];
	  $data['rbirthday']=$_POST["year"].",".$_POST["month"].",".$_POST["day"];
	  
	  if($data['rbirthday'])
	  {
	    $p=$p+$t;
	  }
	  
	  
	  $data['rxingzuo']=$_POST["star"];
	  
	  if($data['rxingzuo'])
	  {
	   $p=$p+$t;
	  }
	  
	  $data['rxuexing']=$_POST["xuexing"];
	  
	  
	  if($data['rxuexing'])
	  {
	   $p=$p+$t;
	  }
	  
	  
	  $data['rzhiye']=$_POST["zhiye"];
	  
	  if($data['rzhiye'])
	  {
	   $p=$p+$t;
	  }
	  
	  
	  $data['rfengge']=$_POST["fengge"];
	  
	  if($data['rfengge'])
	  {
	   $p=$p+$t;
	  }
	  
	  
	  $data['rxuexiao']=$_POST["school"];
	  
	  
	  
	  if($data['rxuexiao'])
	  {
	   $p=$p+$t;
	  }
	  
	  
	  $data['rzhuanye']=$_POST["zhuanye"];
	  
	  
	  if($data['rzhuanye'])
	  {
	   $p=$p+$t;
	  }
	  
	  $data['rshengao']=$_POST["sg"];
	  
	   if($data['rshengao'])
	  {
	   $p=$p+$t;
	  }
	  
	   
	  $data['rtizhong']=$_POST["tz"];
	  
	  if($data['rtizhong'])
	  {
	   $p=$p+$t;
	  }
	  
	  
	  $data['rsanwei']=$_POST["sw1"].",".$_POST["sw2"].",".$_POST["sw3"];
	  
	  
	  if($data['rsanwei'])
	  {
	   $p=$p+$t;
	  }
	  
	  $data['rxiongzhao']=$_POST["_bar"];
	   
	 // echo $_POST["bar"];
	  
	  if($data['rxiongzhao'])
	  {
	   $p=$p+$t;
	  }
	  
	  
	  $data['rxiema']=$_POST["_foot"];
	  
	  if($data['rxiema'])
	  {
	   $p=$p+$t;
	  }
	  
	     
	  $data['rprice']=$_POST["price"];
	  
	  if($data['rprice'])
	  {
	   $p=$p+$t;
	  }
	  
	  
	  
	  
	  $data['rpricetype']=$_POST["price_type"];
	  
	  $data['ryuexing']=$_POST["wangtprice"];
	  
	  
	    if($data['ryuexing'])
	  {
	  $p=$p+$t;
	  }
	  
	  
	  $data['rjiangxiang']=$_POST["jiangxiang"];
	  
	    if($data['rjiangxiang'])
	  {
	   $p=$p+$t;
	  }
	  
	  
	  
	  $data['rjingli']=$_POST["jingli"];
	  
	    if($data['rjingli'])
	  {
	   $p=$p+$t;
	  }
	  
	  
	  $data['rjieshao']=$_POST["ads"];
	  
	    if($data['rjieshao'])
	  {
	   $p=$p+$t;
	  }
	  
	  
	  
	  $data['ropenset']=$_POST["_openset"];
	  
	   if($data['ropenset'])
	  {
	  $p=$p+$t;
	  }
	  
	  
	  if($p==99)
	  {
	    $p=100;
	  }
	  
	   $t=time(); 
	   
	  $data['rdatetime']=date("Y-m-d H:i:s",$t);
	  
	
	  $data['rwanzhengdu']=$p;
	  
	  
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
		 // $this->redirect('Home/Admin/newslist');
		   $this->assign("jumpUrl",U("UserResume/index"));
           $this->success(L('do_success'));
	  }else{
	     //echo 2;
		  //$this->redirect('Home/Admin/addnews');
		  
		  $this->error(L('do_error'));
	  }
	
	  /*
        $_POST['userid']=$this->_userid;
                
        if(!isset($_POST['id']) || intval($_POST['id'])==0)
        {
 
            unset($_POST['id']);
            $_POST['dateline']=time();
			
        }
      
         $_POST['updateline']=time();
        

        if(!$this->dao->create($_POST))
        {
            $this->error($this->dao->getError());
        }
        if(intval($_POST['id'])>0)
        {
            $result =   $this->dao->save();
        }
        else
        {
            $result =   $this->dao->add();
        }

        if(false !== $result) {
            $this->assign("jumpUrl",U("UserResume/index"));
            $this->success(L('do_success'));
        }else{
            
            $this->error(L('do_error'));
        }
		
		*/

    }
	
	
	public function  refresh()
	{
	   $Model = M('userresume'); // 实例化User对象
	   
	   $t=time(); 
	   
	   $data['rdatetime']=date("Y-m-d H:i:s",$t);
	   $id=isset($_GET["id"])?$_GET["id"]:0;
	  if($id>0)
	  {
	    $map["id"]=$id;
	    $result= $Model->where($map)->save($data); // 根据条件更新记录
       
	  } 
	  if($result)
	  {
	     //echo 1;
		 // $this->redirect('Home/Admin/newslist');
		   $this->assign("jumpUrl",U("UserResume/index"));
           $this->success(L('do_success'));
	  }else{
	     //echo 2;
		  //$this->redirect('Home/Admin/addnews');
		  
		   $this->error(L('do_error'));
	  }
	}

    public function del()
    {
        $id = intval($_GET['id']);
        $result = $this->dao->delete($id);
		
		
       // $where = array('userid'=>$this->_userid,'cateid'=>$id);
      //  $mod = M('Photo');
      //  $mod->where($where)->delete();
		
        $this->assign('jumpUrl',U('UserResume/index'));
        if(false !== $result) {
            $this->success("操作成功");
        }else{
            $this->error(L('do_error'));
        }
    }
	
	
	
    public function edit()
    {
	
	    
		
        $id = intval($_GET['id']);
		$resume=$this->dao;
		$vo = array('sex'=>1,'star'=>1,'xuexing'=>1,'zhiye'=>1,'fengge'=>1,'price_type'=>1);
			
	    
		if($id>0){
		    $map['id']=$id;
        	$vo = $resume->where($map)->find();
			
			$birthday=$vo['rbirthday'];
			
		   $arr=split(",",$birthday);
		   $sanwei=$vo['rsanwei'];
		   
		 //  echo $vo['rsex'];
		   
		 $arr1=split(",",$sanwei);
		   
		   
		$this->assign('year',$arr[0]);
		
		$this->assign('month',$arr[1]);
		
		$this->assign('day',$arr[2]);
		
		
	    $this->assign('sw1',$arr1[0]);
		
		$this->assign('sw2',$arr1[1]);
		
		$this->assign('sw3',$arr1[2]);
		
		
		} 
		
		
      // $p=$this->resumeset();
	   //echo $p['HuodongTypee'][0]."1";
		
		
        $jsoncontent = array();
        $jsoncontent[] = $vo;
        $this->assign('jsoncontent',json_encode($jsoncontent));
        $this->assign('id',$id);
        $this->assign('vo',$vo);
		
	
		
		$this->assign('sex',C('S_SEX'));
		$this->assign('star',C('S_STAR'));
		$this->assign('xuexing',C('S_XUEXING'));
		$this->assign('zhiye',C('S_ZHIYE'));
		$this->assign('fengge',C('S_FENGGE'));
		$this->assign('bar',C('S_BAR'));
		$this->assign('foot',C('S_FOOT'));
		$this->assign('price_type',C('S_PRICE_TYPE'));  //S_OPENSET
	    $rearr=$this->resumeset();
		//echo C('S_OPENSET')[0];
		$this->assign('openset',$rearr['S_OPENSET']); 
		
        $this->display();
		
		
    }
	
	public  function  resumeset()
	{
	  $resume	  = array(
	//活动类型
	  'S_OPENSET' => array('1'=>'对所有企业公开','2'=>'对所有企业关闭')
	
     ); 
	 return $resume;
	}
	
	
 
	
	
	
	public function ck(){
			$mod = $this->dao;
			$where = 'userid='.$this->_userid;
			$order = 'id desc';
       
        	$count = $mod->where($where)->count();
			
			if($count>=$this->allcount){
				$this->error('您能创建的简历是'.$this->allcount.'份，目前不能创建了');
			}
	}
    public function show()
    {
        $id = intval($_GET['id']);
        $vo = $this->dao->getById($id);

        $jsoncontent = array();
        $jsoncontent[] = $vo;
        $this->assign('jsoncontent',json_encode($jsoncontent));
        
        $this->assign('vo',$vo);
        $this->display();
    }
	
	
	
    public function toudi()
    {
        $this->assign("url",U('UserResume/toudi'));
        $this->assign("title",'简历投递');
        

        import ('@.ORG.Page');
        $mod =M('S_userresume_toudi');
        $where = 'userid='.$this->_userid;
        $order = 'id desc';
        if(isset($_GET['sort']))
        {
            $order = str_replace('\'','',trim($_GET['sort']));
            $order = $order .' desc';
        }
        $count = $mod->where($where)->count();
        $listRows = 10 ;//C('PAGE_LISTROWS');      
        $page = new Page ( $count, $listRows );
        $pages = $page->show();
        $list = $mod->field($field)->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();
       // print_r($list);
        $jsoncontent = is_array($list)?$list:array();
        $this->assign('jsoncontent',json_encode($jsoncontent));
        $this->assign('jlcount',$count);
        $this->assign('pages',$pages);
        $this->assign('list',$list);

        $this->display();
		
    }
	
	public function  deletejianli(){
	  $Form = M('S_userresume_toudi');
	  $ids=$_POST["ID_Dele"];
	  
	  
	  $ID_Dele= implode(",",$_POST['ID_Dele']);
	 
	   if(isset($ids) && is_array($ids))
	   {
		    $Form->where(array('id' => array('in',$ids)))->delete();
			
	 
	   }else{
		 
	   }
	   $this->redirect('UserResume/toudi');
	   
	 
	}
	
	
	
	
	public function deltoudi()
    	{
        $id = intval($_GET['id']);
		$mod =M('S_userresume_toudi');
        $result = $mod->delete($id);
       
        $this->assign('jumpUrl',U('UserResume/toudi'));
        if(false !== $result) {
            $this->success("操作成功");
        }else{
            $this->error(L('do_error'));
        }
    }
	 public function mianshi()
    {

        $this->assign("url",U('UserResume/mianshi'));
        $this->assign("title",'面试邀约');
        

        import ('@.ORG.Page');
        $mod =M('S_userresume_mianshi');
        $where = 'userid='.$this->_userid;
        $order = 'id desc';
        if(isset($_GET['sort']))
        {
            $order = str_replace('\'','',trim($_GET['sort']));
            $order = $order .' desc';
        }
        $count = $mod->where($where)->count();
        $listRows =  C('PAGE_LISTROWS');      
        $page = new Page ( $count, $listRows );
        $pages = $page->show();
        $list = $mod->field($field)->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();
       // print_r($list);
        $jsoncontent = is_array($list)?$list:array();
        $this->assign('jsoncontent',json_encode($jsoncontent));
        $this->assign('mscount',$count);
        $this->assign('pages',$pages);
        $this->assign('list',$list);

        $this->display();
    }
	
	
	public function delmianshi()
   {
        $id = intval($_GET['id']);
		$mod =M('S_userresume_mianshi');
        $result = $mod->delete($id);
       
        $this->assign('jumpUrl',U('UserResume/mianshi'));
        if(false !== $result) {
            $this->success("操作成功");
        }else{
            $this->error(L('do_error'));
        }
    }
	
	
     public function  deletemianshi(){
	  $Form = M('S_userresume_mianshi');
	  $ids=$_POST["ID_Dele"];
	  
	  
	  $ID_Dele= implode(",",$_POST['ID_Dele']);
	 
	   if(isset($ids) && is_array($ids))
	   {
		    $Form->where(array('id' => array('in',$ids)))->delete();
			
	 
	   }else{
		 
	   }
	   $this->redirect('UserResume/mianshi');
	   
	 
	}
	
	
	
	public function  showjl()
	{
	     $userid=$this->_userid;
		 
		 $mod=M('user');
		 $where["id"]=$userid;
		 $u=$mod->where($where)->find();
		// $uid=$userid;
		 $id=$_GET["id"];
		 $map["id"]=$id;
		 $list=$this->dao->where($map)->find();  //{$sex[$vo['rsex']]}
		 
		$b=$list['rbirthday'];
		$barr=split(",",$b);
		$s=$list['rsanwei'];
		$sarr=split(",",$s);
		 
		$this->assign('y',$barr[0]);
	    $this->assign('m',$barr[1]);
		$this->assign('d',$barr[2]);
		
		
		$this->assign('s1',$sarr[0]);
		$this->assign('s2',$sarr[1]);
		$this->assign('s3',$sarr[2]);
		
		
		$diqu = M('Area');
        $data = $diqu->where('id='.$list['rprovince'])->find();
        $province = $data['name'];
        $data = $diqu->where('id='.$list['rcity'])->find();
        $city = $data['name'];
        $data = $diqu->where('id='.$list['rarea'])->find();
        $area = $data['name'];

        $this->assign('province',$province);
        $this->assign('city',$city);
        $this->assign('area',$area);
		
		
		
		$this->assign('u',$u);
		$this->assign('uid',$userid);
		$this->assign('sex',C('S_SEX'));
		$this->assign('star',C('S_STAR'));
		$this->assign('xuexing',C('S_XUEXING'));
		$this->assign('zhiye',C('S_ZHIYE'));
		$this->assign('fengge',C('S_FENGGE'));
		$this->assign('bar',C('S_BAR'));
		$this->assign('foot',C('S_FOOT'));
		$this->assign('price_type',C('S_PRICE_TYPE'));  //S_OPENSET
		
	    $rearr=$this->resumeset();
		//echo C('S_OPENSET')[0];
		$this->assign('openset',$rearr['S_OPENSET']); 
		
	     $this->assign('list',$list);
	     $this->display();
	}
	
	
}