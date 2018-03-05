<?php
namespace app\admin\controller;
use think\Controller;

class Notice extends Controller
{
    public function notice()
    {
        return $this->fetch();
    }

    public function test()
    {
        return 1;
    }
    
}