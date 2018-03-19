<?php
namespace app\index\controller;
use think\Controller;
use app\admin\model\User;
use app\admin\model\Section as SectionModel;

class Index extends Controller
{
    protected $user;
    protected $section;

    public function initialize()
    {
        $this->user = new User();
        $this->section = new SectionModel();
    }

    //渲染个人中心的页面
    public function personal()
    {
        return $this->fetch();
    }

    // 渲染首页
    public function index()
    {
        $section = $this->section->getSection('parent');

        $this->assign('section',$section);
        return $this->fetch();
    }

    //渲染登录和注册的页面 
    public function login()
    {
        return $this->fetch();
    }

    //验证登录
    public function doLogin()
    {
        if(empty($_POST['email']) && empty($_POST['pwd']))
        {
            return $this->redirect('Index/login');
        }
        $res = $this->user->doLogin($_POST);
        if($res == 200){
            return $this->redirect('Index/index');
        } else if($res == 201 || $res == 202){
            return $this->redirect('Index/login');
        }
    }

    //进行注册
    public function doRegist()
    {
        if(empty($_POST['name'])||empty($_POST['email'])||empty($_POST['pwd'])|| empty($_POST['rpwd']))
        {
            return $this->redirect('Index/login');
        } else if($_POST['pwd'] != $_POST['rpwd']){
            return $this->redirect('Index/login');
        }
        $res = $this->user->doRegist($_POST);
        return $this->redirect('Index/login');
        // 还要根据注册的结果 进行相应的提示
    }

}
