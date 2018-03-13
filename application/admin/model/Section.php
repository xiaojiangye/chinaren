<?php
namespace app\admin\model;
use think\Model;

class Section extends Model
{

    /*得到所有版块*/
    public function getSection($type=null)
    {
        if($type == 'parent')
        {
            return $this->where('parent',0)->where('status',1)->order('create_time asc')->select();
        } else {
            //return $this->order('status desc')->order('create_time desc')->select();
            return $this->order('status desc')->order('create_time desc')->column('id,parent,name,info->description,sector,status,create_time');
        }
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
            $info['info'] = json_encode(['description' => $info['description'],'url' => $info['url']]);
            $res = $this->save($info);
        } else if($info['type'] == 'update') {
        }
        if(empty($res)){
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
        } else if($info['type'] == 'remove') {
            $res = $this->save(['status' => 1],['id' => $info['id']]);
        }
        if(!$res)
        {
            return 602;
        }
        return 200;
    }
}