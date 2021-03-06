<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;

class Index extends controller
{
    protected $user ;

    public function initialize()
    {
        $this->user = new User();
    }

    /*渲染登陆页面*/
    public function login()
    {
        return $this->fetch();
    }

    /*渲染验证登录页面*/
    public function dologin()
    {
        if(empty($_POST['email']) && empty($_POST['pwd']))
        {
            return $this->redirect('Index/login');
        }
        $res = $this->user->dologin($_POST);
        if($res == 200){
            return $this->redirect('Index/index');
        } else if($res == 201){
            return $this->redirect('Index/login');
        }
    }

    public function index()
    {
        return $this->fetch();
    }        

    public function regist()
    {
        echo "后台的注册页面，应该用不着";
    }
}

