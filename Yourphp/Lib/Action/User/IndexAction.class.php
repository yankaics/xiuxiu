<?php
/**
 * Created by IntelliJ IDEA.
 * User: appie
 * Date: 14-3-15
 * Time: 上午11:29
 */

if(!defined("YOURPHP")) exit("Access Denied");
class IndexAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $this->assign('title','会员中心');
        $this->assign('url',U('Index/index'));
        $this->display();
    }

}