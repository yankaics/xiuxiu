<?php
/**
 * Created by IntelliJ IDEA.
 * User: appie
 * Date: 14-3-15
 * Time: 上午11:29
 */

if(!defined("YOURPHP")) exit("Access Denied");
class JobAction extends BaseAction
{
    function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $this->assign('title','招聘信息');
        $this->assign('url',U('Index/index'));
        $this->assign('job_on',' class="on"');
        $this->display();
    }

    public function show()
    {
        $this->assign('title','招聘信息');
        $this->assign('url',U('Index/index'));
        $this->assign('job_on',' class="on"');
        $this->display();
    }

}