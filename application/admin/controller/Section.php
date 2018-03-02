<?php
namespace  app\admin\controller;
use think\Controller;

class Section extends Controller 
{
    /*渲染增加版块的页面*/
    public function addSection()
    {
        return $this->fetch();
    }
}
