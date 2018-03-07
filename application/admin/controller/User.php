<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User as UserModel;

class User extends Controller
{
    protected $user;

    public function initialize()
    {
        $this->user = new UserModel();
    }

    public function user()
    {
        $user = $this->user->user();
        $this->assign('user',$user);
        return $this->fetch();
    } 

    public function updateUserStatus()
    {
        if(empty($_GET['id']) || empty($_GET['status']))
        {
            return 401;
        }
        return $this->user->updateUserStatus($_GET);
    }
}