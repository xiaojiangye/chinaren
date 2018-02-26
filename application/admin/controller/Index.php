<?php
namespace app\admin\controller;
use think\Controller;
class Index extends controller
{
    public function login()
    {
        return $this->fetch();
    }

    public function index()
    {
        echo 123;
    }        

    public function regist()
    {
        echo "后台的注册页面，应该用不着";
    }
}

