<?php
/**
 * Created by IntelliJ IDEA.
 * User: appie
 * Date: 14-3-15
 * Time: 上午11:29
 */

if(!defined("YOURPHP")) exit("Access Denied");
class HuidongAction extends BaseAction
{
    
    public function pinglun()
    {
        $this->assign("url",U('Basic/index'));
        $this->assign("title",'我的评论');
        $this->display();
    }
    public function liwu()
    {
        $this->assign("url",U('Basic/index'));
        $this->assign("title",'我的礼物');
        $this->display();
    }
    public function xiuyou()
    {
        $this->assign("url",U('Basic/index'));
        $this->assign("title",'我的秀友');
        $this->display();
    }
    public function fav()
    {
        $this->assign("url",U('Basic/index'));
        $this->assign("title",'我的收藏');
        $this->display();
    }
}