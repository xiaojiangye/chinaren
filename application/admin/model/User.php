<?php
namespace app\admin\model;

use think\Model;
use think\facade\Session;

class User extends Model
{

    // 修改用户状态
    public function updateUserStatus($info)
    {
        if($info['status'] == "禁用"){
            $info['status'] = 0;
        } else if($info['status'] == "启用"){
            $info['status'] = 1;
        }
        $res = $this->save(['status' => $info['status']],['id' => $info['id']]);
        if(!$res){
            return 602;
        }
        return 200;
    }

    // 得到所有的用户
    public function user()
    {
        return $this->order('status desc')->order('create_time desc')->column('id,info->name,avatar,info->description,status');
    }

    /*验证登录*/
    public function dologin($info)
    {
        $res = $this->where(['email' => $info['email'],'pwd' => $info['pwd']])->find();
        if(empty($res)){
            return  201;
        }
        $info  = json_decode($res['info'],true);
        if($info['status'] == 0)
        {
            return 202;
        }
        Session::set('email' , $res['email']);
        Session::set('pwd' , $res['pwd']);
        Session::set('id',$res['id']);
        Session::set('last_login',$res['last_login']);
        Session::set('name',$info['name']);
        Session::set('avatar',$info['avatar']);
        return 200;
    }
}
