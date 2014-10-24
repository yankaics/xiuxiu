<?php
 

if(!defined("YOURPHP")) exit("Access Denied");
class UserVideoAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('S_uservideo');
    }

    public function index()
    {

        $this->assign("url",U('UserVideo/index'));
        $this->assign("title",'我的视频');
        

        import ('@.ORG.Page');
        $mod = $this->dao;
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
       
        $this->assign('pages',$pages);
        $this->assign('list',$list);

        $this->display();
    }

   

    public function save()
    {
        $_POST['userid']=$this->_userid;
                
        if(!isset($_POST['id']) || intval($_POST['id'])==0)
        {
 
            unset($_POST['id']);
            
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
            $this->assign("jumpUrl",U("UserVideo/index"));
            $this->success(L('do_success'));
        }else{
            
            $this->error(L('do_error'));
        }

    }

    public function del()
    {
        $id = intval($_GET['id']);
        $result = $this->dao->delete($id);
        $where = array('userid'=>$this->_userid,'cateid'=>$id);
        $mod = M('Photo');
        $mod->where($where)->delete();
        $this->assign('jumpUrl',U('UserVideo/index'));
        if(false !== $result) {
            $this->success("操作成功");
        }else{
            $this->error(L('do_error'));
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
    

}