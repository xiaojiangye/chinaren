<?php

namespace app\index\controller;
use think\Controller;

class Article extends Controller
{
    public function pubArticle()
    {
        return $this->fetch();
    }
}