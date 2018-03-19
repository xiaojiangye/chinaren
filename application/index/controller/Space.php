<?php
namespace app\index\controller;
use think\Controller;

class Space extends Controller
{
    public function space()
    {
        return $this->fetch();
    }
}