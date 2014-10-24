<?php
/**
  * User: xiaojie5525
*/

if(!defined("YOURPHP")) exit("Access Denied");
class UserAixiuAction extends BaseAction
{
    function _initialize(){ 
        parent::_initialize();
        $this->dao = M('S_userphoto');
    }

    public function index(){
        $this->assign("title",'我的相册');
  		import ('@.ORG.Page');
        $mod = $this->dao;
        $where = 'userid='.$this->_userid;
        $order = 'id desc';
        if(isset($_REQUEST['sort']))
        {
            $order = trim($_REQUEST['sort']);
            $order = $order .' desc';
        }
        $count = $mod->where($where)->count();
        $listRows =  C('PAGE_LISTROWS');      
        $page = new Page ( $count, $listRows );
        $pages = $page->show();
        $list = $mod->field($field)->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();
         $mod = M('UserPhotoList');
        // $jsoncontent = is_array($list)?$list:array();
       // $this->assign('jsoncontent',json_encode($jsoncontent));
       //images/ojgimg_03.jpg
        for($i=0;$i<count($list);$i++)
        { 	 
            $list[$i]['list'] =$list2= $mod->where('fid='.$list[$i]['id'].' and userid='.$this->_userid)->select(); 
		 
            $list[$i]['master'] = $mod->where('fid='.$list[$i]['id'].' and userid='.$this->_userid.' and is_home=1')->find();  
                 
            
        }
        $this->assign('pages',$pages);
        $this->assign('list',$list);print_r($list[$i]);
 
        $this->display();
    }
	 
	 public function save()
    {
        $_POST['userid']=$this->_userid;
                
        if(!isset($_POST['id']) || intval($_POST['id'])==0)
        {
           
            $_POST['dateline'] =time();
            $_POST['updateline'] = time();
            unset($_POST['id']);
            
        }
        else
        {
            $_POST['updateline'] = time();
        }
      
        

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
            //$this->assign("jumpUrl",U("UserPhoto/index"));
            $this->success(L('do_success'));
        }else{
            
            $this->error(L('do_error'));
        }

    }
    public function del()
    {
        $id = intval($_GET['id']);
        $result = $this->dao->delete($id);
        $this->assign('jumpUrl',U('UserPhoto/index'));
        if(false !== $result) {
            $this->success(L('do_success'));
        }else{
            $this->error(L('do_error'));
        }
    }
	
	/*添加照片*/
	function addphoto(){
		$this->assign("title",'添加照片');
		$photo = $this->dao->select();
		
		$this->assign('photo',$photo);
		$this->display();
	} 

}