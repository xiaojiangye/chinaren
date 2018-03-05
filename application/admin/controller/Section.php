<?php
namespace  app\admin\controller;
use app\admin\model\Section as SectionModel;
use think\Controller;
use think\facade\Session;


class Section extends Controller 
{
    protected $section;

    public function initialize()
    {
        $this->section = new SectionModel();
    }

    /*渲染增加版块的页面*/
    public function section()
    {
        $section = $this->section->getSection();
        $this->assign('section',$section);
        return $this->fetch();
    }

    /*修改版块*/
    public function updateSection()
    {
        if(empty(Session::get('email')) || empty($_POST['name']) || empty($_POST['parent']) || empty($_POST['description']) || empty($_POST['type']))
        {
            return 401;
        }
        $res = $this->section->updateSection($_POST);  
        return $res;
    }

    /*删除版块 隐藏版块*/ 
    public function dealSection()
    {
        if( empty(Session::get('email')) || empty($_GET['id']) || empty($_GET['type']))
        {
            return 401;
        }
        return $this->section->dealSection($_GET);
    }
}
