<?php
namespace app\admin\model;
use think\Model;

class Section extends Model
{
    /*得到所有版块*/
    public function getSection()
    {
        return $this->where('status',1)->order('create_time desc')->select();
    }

    /*得到所有父级版块*/
    public function getParentSection()
    {
        return $this->order('create_time')->column('name');
    }

    /*处理版块*/
    public function updateSection($info)
    {
        $res = '';
        if($info['type'] == 'add'){
            if($info['parent'] == '无'){
                $info['parent'] = 0;
            } else {
                $info['parent'] = $this->where('name',$info['parent'])->value('id');
            }
            $res = $this->save($info);
        } else if($info['type'] == 'update') {

        }
        return  $res;
        if(!empty($res)){
            return 601;
        }
        return 200;
    }

    public function dealSection($info)
    {
        $res = '';
        if($info['type'] == 'hidden')
        {
            $res = $this->save(['status' => 0],['id' => $info['id']]);
        } else if($info['type'] == 'del'){
            $res = $this->destroy($info['id']);
        }
        if(!$res)
        {
            return 602;
        }
        return 200;
    }
}