<?php
 

if(!defined("YOURPHP")) exit("Access Denied");
class UserMoKaAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
       // $this->dao = M('userresume');
		//$this->allcount=6;
		
    }
	
	
	public function index()
	{
	
        $this->assign("url",U('UserMoKa/index'));
        $this->assign("title",'我的模卡');
		
	    $this->display();
	}
	
	
	
	public function show()
	{  
	
	   $this->assign("url",U('UserMoKa/show'));
        $this->assign("title",'我的模卡');
	   $this->display();
	}
	
	
	public function addone()
	{
	   $this->assign("url",U('UserMoKa/addone'));
        $this->assign("title",'我的模卡');
	   $this->display();
	}
	
	public function photosave()
    {
        $mod = M('moka');
        $cateid = intval($_POST['cateid']);
        $images = $_POST['avatar'];
		$sortid=$_POST['sortid'];
		//$names = $_POST['names'];
       
	    $data = array(
                'userid'=>$this->_userid,
                'mokaid'=>$cateid,
                'mokaurl'=>$images,
				'sortid'=>$sortid,
                'addtime'=>date("Y-m-d H:i:s",time()));
            $mod->data($data)->add();
			
      /*  for($i=0;$i<count($images);$i++)
        {
            $data = array(
                'userid'=>$this->_userid,
                'mokaid'=>$cateid,
                'mokaurl'=>$images[$i].$names[i],
                'addtime'=>date("Y-m-d H:i:s",time()));
            $mod->data($data)->add();

        }
		*/

		
       // $data = array('total'=>count($images));
        //$where = array('userid'=>$this->_userid,'id'=>$cateid);
        //$this->dao->where($where)->data($data)->save();
        $this->assign('jumpUrl',U('UserMoKa/addone'));
        $this->success('操作成功');
    }
	
	
	
}


