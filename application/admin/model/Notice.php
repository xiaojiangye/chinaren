<?php
namespace app\admin\model;
use think\Model;
use think\facade\Session;

class Notice extends Model
{
    // 删除公告
    public function delNotice($id)
    {
        $res = $this->where('id',$id)->delete();
        if(empty($res))
        {
            return 603;
        }
        return 200;
    }

    /*得到公告*/
    public function getNotice()
    {
        return $this->column('id,puber,info->type,content,create_time');
    }

    /*发表公告*/
    public function doPubNotice($info)
    {
        if($info['type'] == 'person')
        {
            $puber = Session::get('id');
            $noticeInfo = json_encode(['type' => $info['type'] , 'operator' => $puber]);
            $content  = $info['content'];
            $res = $this->save([
                'puber' => $puber,
                'info'  => $noticeInfo,
                'content'  => $content
            ]);
            if(empty($res)){
                return 601;
            }
            return 200;
        } else if($info['type'] == 'class'){

        }
    }
}