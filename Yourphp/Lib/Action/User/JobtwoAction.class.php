<?php
/**
 * Created by IntelliJ IDEA.
 * User: appie
 * Date: 14-3-15
 * Time: 上午11:29
 */

if(!defined("YOURPHP")) exit("Access Denied");
class JobtwoAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('Job');
    }

    public function index()
    {

        $this->assign("url",U('Jobtwo/index'));
        $this->assign("title",'机构招聘');
        

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
        $this->assign('sex',C('SEX_TYPE'));
        $this->assign('xueli',C('XUELI_TYPE'));
        $this->assign('money',C('MONEY_TYPE'));
        $vo = array(
            'sex'=>1,'shengao'=>160,'cateid'=>9,'xueli'=>0,'worktime'=>'[]','money_type'=>0,'money_get'=>0);
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
                
        if(!isset($_POST['id']))
        {
           
            $_POST['createtime'] =time();
                      
        }
        $_POST['updatetime'] =time();  
        if($_POST['isall'] == 1)
        {
            $_POST['is_top'] = 1;
            $_POST['is_hot'] = 1;
        }
        if(isset($_POST['starttime']))
        {
            $_POST['starttime'] = strtotime($_POST['starttime']);
        }
        if(isset($_POST['endtime']))
        {
            $_POST['endtime'] = strtotime($_POST['endtime']);
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
            $this->assign("jumpUrl",U("Jobtwo/index"));
            $this->success(L('do_success'));
        }else{
            
            $this->error(L('do_error'));
        }

    }
    public function del()
    {
        $id = intval($_GET['id']);
        $result = $this->dao->delete($id);
        $this->assign('jumpUrl',U('Jobtwo/index'));
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
        $this->assign('jumpUrl',U('Jobtwo/index'));
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
        $this->assign('jumpUrl',U('Jobtwo/index'));
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
        $this->assign('jumpUrl',U('Jobtwo/index'));
        if(false !== $result) {
            $this->success(L('do_success'));
        }else{
            $this->error(L('do_error'));
        }
    }
    public function refresh()
    {
        $id = intval($_GET['id']);
        $data = array('updatetime'=>time());
        $result = $this->dao->where('id='.$id)->save($data);
        $this->assign('jumpUrl',U('Jobtwo/index'));
        if(false !== $result) {
            $this->success(L('do_success'));
        }else{
            $this->error(L('do_error'));
        }
    }

    public function down()
    {
        $this->assign("url",U('Jobtwo/down'));
        $this->assign("title",'下载简历');
        $this->display();
    }
    public function mianshi()
    {
        $this->assign("url",U('Jobtwo/mianshi'));
        $this->assign("title",'面试邀请');
        $this->display();
    }

}