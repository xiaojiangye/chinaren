<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        echo "这里展示chinaren的登录页面";
    }

    public function login()
    {
        return $this->fetch();
    }

    public function regist()
    {
        return $this->fetch();
    }
}
