<?php
/**
 * Created by IntelliJ IDEA.
 * User: appie
 * Date: 14-3-15
 * Time: 上午11:29
 */

if(!defined("YOURPHP")) exit("Access Denied");
class HuodongAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('Huodong');
    }

    public function index()
    {

        $this->assign("url",U('RenZheng/index'));
        $this->assign("title",'机构活动');
        $this->assign("HuodongType",C("HuodongType"));

        import ('@.ORG.Page');
        $mod = $this->dao;
        $where = 'userid='.$this->_userid;
        if(isset($_GET['status']))
        {
            $where = $where.' AND status='.intval($_GET['status']);
        }
        $count = $mod->where($where)->count();
        $listRows =  C('PAGE_LISTROWS');      
        $page = new Page ( $count, $listRows );
        $pages = $page->show();
        $list = $mod->field($field)->where($where)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        $mod = M('Area');
        for($i=0;$i<count($list);$i++)
        {
            if($list[$i]['province'])
            {
                $list[$i]['provincename'] = $mod->where('id='.$list[$i]['province'])->getField('name');
            }
            else
            {
                $list[$i]['provincename']='全国';
            }
        }
        $this->assign('pages',$pages);
        $this->assign('list',$list);

        $this->display();
    }

    public function edit()
    {
        $id = intval($_GET['id']);
        $vo = array('type'=>1,'sex'=>1,'logo'=>'../Public/images/default_b.jpg','banner'=>'../Public/images/default_b.jpg');
        if($id>0)
        {
            $vo = $this->dao->find($id);            
        }
        $this->assign('vo',$vo);
        $this->display();
    }


    public function save()
    {
        $_POST['userid']=$this->_userid;
        if(isset($_POST['start1_time']))
        {
            $_POST['start1_time'] = strtotime($_POST['start1_time']);
        }
        if(isset($_POST['end1_time']))
        {
            $_POST['end1_time'] = strtotime($_POST['end1_time']);
        }
        
        if(isset($_POST['start2_time']))
        {
            $_POST['start2_time'] = strtotime($_POST['start2_time']);
        }
        
        if(isset($_POST['end2_time']))
        {
            $_POST['end2_time'] = strtotime($_POST['end2_time']);
        }
        
        if(!isset($_POST['id']))
        {
            $_POST['status'] = 0;
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
            $this->assign("jumpUrl",U("Huodong/index"));
            $this->success(L('do_success'));
        }else{
            
            $this->error(L('do_error'));
        }

    }
    public function del()
    {
        $id = intval($_GET['id']);
        $result = $this->dao->delete($id);
        $this->assign('jumpUrl',U('Huodong/index'));
        if(false !== $result) {
            $this->success(L('do_success'));
        }else{
            $this->error(L('do_error'));
        }
    }
    public function status() 
    {
        //0正在审核 1审核通过 2未通过 3过期
        $id = intval($_GET['id']);
        $status = intval($_GET['status']);
        $data = array('status'=>$status);
        $result = $this->dao->where('id='.$id)->save($data);
        $this->assign('jumpUrl',U('Huodong/index'));
        if(false !== $result) {
            $this->success(L('do_success'));
        }else{
            $this->error(L('do_error'));
        }

    }
    public function setTop()
    {
        $value = intval($_GET['value']);
        if($value == 0)
        {
            $value = 1;
        }
        else
        {
            $value = 0;
        }
        $id = intval($_GET['id']);
        $data = array('is_top'=>$value);
        $result = $this->dao->where('id='.$id)->save($data);
        $this->assign('jumpUrl',U('Huodong/index'));
        if(false !== $result) {
            $this->success(L('do_success'));
        }else{
            $this->error(L('do_error'));
        }
    }

    public function setHot()
    {
        $value = intval($_GET['value']);
        if($value == 0)
        {
            $value = 1;
        }
        else
        {
            $value = 0;
        }
        $id = intval($_GET['id']);
        $data = array('is_hot'=>$value);
        $result = $this->dao->where('id='.$id)->save($data);
        $this->assign('jumpUrl',U('Huodong/index'));
        if(false !== $result) {
            $this->success(L('do_success'));
        }else{
            $this->error(L('do_error'));
        }
    }

}