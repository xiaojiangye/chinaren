<?php
namespace app\admin\model;

use think\Model;
use think\facade\Session;

class User extends Model
{
    /*验证登录*/
    public function dologin($info)
    {
        $res = $this->where(['email' => $info['email'] , 'pwd' => $info['pwd']])->find();
        if(empty($res)){
            return  201;
        }
        $name = $this->where('email',$info['email'])->value('name');
        Session::set('email' , $info['email']);
        Session::set('pwd' , $info['pwd']);
        Session::set('name',$name);
        return 200;
    }
}
