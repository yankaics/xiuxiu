<?php
 

if(!defined("YOURPHP")) exit("Access Denied");
class UserPhotoAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('S_userphoto');
    }

    public function index()
    {
		
        $this->assign("url",U('UserPhoto/index'));
        $this->assign("title",'我的相册');
        

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
        $mod = M('S_photo');
        $jsoncontent = is_array($list)?$list:array();
        $this->assign('jsoncontent',json_encode($jsoncontent));
       //images/ojgimg_03.jpg
	   
        for($i=0;$i<count($list);$i++)
        {
            $list[$i]['list'] = $mod->where('cateid='.$list[$i]['id'].' and userid='.$this->_userid)->select();
            $row = $mod->where('cateid='.$list['id'].' and userid='.$this->_userid.' and is_home=1')->find();
            $master = '';
            if(is_array($row))
            {
                $master = $row['url'];
            }
            else
            {
                if(is_array($list[$i]['list']))
                {
                    $master = $list[$i]['list'][0]['url'];
                }
                
            }
            //var_dump($list[$i]['list']);
            //die($master);
            $list[$i]['master'] =  $master;
                 
            
        }
        $this->assign('pages',$pages);
        $this->assign('list',$list);

        $this->display();
    }

    public function add()
    {
        $id = isset($_GET['id'])?intval($_GET['id']):0;
        $total = 20;
        $free = 20;
        $count = 0;
        $list = array();
        if($id>0)
        {
            $mod = M('S_photo');

            $list = $mod->where('userid='.$this->_userid.' AND cateid='.$id)->select();
            $count = count($list);
            $free = $total-$count;            

            for($i=0;$i<count($list);$i++)
            {
                $row = $this->dao->where('id='.$list[$i]['cateid'])->field('name')->find();
                $name = $row['name'];
                $list[$i]['catename'] = $name;
            }

        }
        $catelist = $this->dao->where('userid='.$this->_userid)->select();
        $this->assign('catelist',$catelist);
        $this->assign('list',$list);
        $this->assign('id',$id);
        $this->assign('total',$total);
        $this->assign('count',$count);
        $this->assign('free',$free);
        
        $this->display();
    }


    public function save()
    {
        $_POST['userid']=$this->_userid;
                
        if(!isset($_POST['id']) || intval($_POST['id'])==0)
        {
           
            $_POST['createtime'] =time();
            $_POST['updatetime'] = time();
            unset($_POST['id']);
            
        }
        else
        {
            $_POST['updatetime'] = time();
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
            $this->assign("jumpUrl",U("UserPhoto/index"));
            $this->success(L('do_success'));
        }else{
            
            $this->error(L('do_error'));
        }

    }

    public function photosave()
    {
        $mod = M('S_photo');
        $cateid = intval($_POST['cateid']);
        if($cateid<=0)
        {
            $this->error('没有选择相集分类');
            return;
        }
        $where = array('userid'=>$this->_userid,'cateid'=>$cateid);
        $mod->where($where)->delete();
        
        $aid = $_POST['aid'];
        $images = $_POST['images'];
        $names = $_POST['names'];
        if(count($images)<1)
        {
            $this->error('没有选择需要上传的图片');
        }
        for($i=0;$i<count($images);$i++)
        {
            $data = array(
                'userid'=>$this->_userid,
                'cateid'=>$cateid,
                'aid'=>$aid[$i],
                'url'=>$images[$i],'filename'=>$names[$i],
                'filesize'=>0,
                'createtime'=>time(),
                'is_home'=>0);
            $mod->data($data)->add();

        }
        $data = array('total'=>count($images));
        $where = array('userid'=>$this->_userid,'id'=>$cateid);
        $this->dao->where($where)->data($data)->save();
        $this->assign('jumpUrl',U('UserPhoto/index'));
        $this->success('操作成功');
    }
    public function del()
    {
        $id = intval($_GET['id']);
        $result = $this->dao->delete($id);
        $where = array('userid'=>$this->_userid,'cateid'=>$id);
        $mod = M('S_photo');
        $mod->where($where)->delete();
        $this->assign('jumpUrl',U('UserPhoto/index'));
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
        $mod = M('S_photo');
        $where = array('userid'=>$this->_userid,'cateid'=>$id);
        $vo['list'] = $mod->where($where)->order('is_home desc,id desc')->select();
        $this->assign('vo',$vo);
        $this->display();
    }

    public function master()
    {
        $id = intval($_GET['id']);
        $cateid = intval($_GET['cateid']);

        $where = array('userid'=>$this->_userid,'cateid'=>$cateid);
        $data = array('is_home'=>0);
        $mod = M('S_photo');
        $mod->where($where)->data($data)->save();

        $where['id']=$id;
        $data['is_home'] = 1;
        $mod->where($where)->data($data)->save();
        $this->assign('jumpUrl',U('UserPhoto/show',array('id'=>$cateid)));
        $this->success("操作成功");
    }
    

}