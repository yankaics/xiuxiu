<?php
/**
 * Created by IntelliJ IDEA.
 * User: appie
 * Date: 14-3-15
 * Time: 上午11:29
 */

if(!defined("YOURPHP")) exit("Access Denied");
class NewsAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $this->assign('title','机构动态');
        $this->assign('url',U('Index/index'));
        $this->assign('news_on',' class="on"');
        $this->display();
    }
    public function show()
    {
        $this->assign('title','机构动态');
        $this->assign('url',U('Index/index'));
        $this->assign('news_on',' class="on"');
        $this->display();
    }
}