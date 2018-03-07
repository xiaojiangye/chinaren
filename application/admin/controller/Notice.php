<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Session;
use app\admin\model\Notice as NoticeModel;

class Notice extends Controller
{
    protected $notice ;
    public function initialize()
    {
        $this->notice = new NoticeModel();
    }

    //删除公告
    public function delNotice()
    {
        if(empty(Session::get('email')))
        {
            return $this->redirect('Index/login');
        }
        if(empty($_GET['id']))
        {
            return 401;
        }
        return $this->notice->delNotice($_GET['id']);
    }

    /*渲染宫傲列表的页面*/
    public function notice()
    {
        if(empty(Session::get('email')))
        {
            return $this->redirect('Index/login');
        }
        $res = $this->notice->getNotice();
        $this->assign('notice',$res);
        return $this->fetch();
    }

    /*渲染发表公告的页面*/
    public function pubNotice()
    {
        if(empty(Session::get('email')))
        {
            return $this->redirect('Index/login');
        }
        return $this->fetch();
    }

    /*发表公告*/
    public function doPubNotice()
    {
        if(empty(Session::get('email')))
        {
            return $this->redirect('Index/login');
        }
        if(empty($_POST['type']) || empty($_POST['content']))
        {
            return json_encode(['status' => 401]);
        }
        $res = $this->notice->doPubNotice($_POST);
        if($res == 200)
        {
            return $this->redirect('Notice/notice');
        }
    }
    
}