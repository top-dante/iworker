<?php


namespace app\api\model;


use think\Exception;
use think\facade\Request;
use think\Model;
use utils\Uuid;

class Group extends Model
{
    protected $pk = 'group_id';

    /**
     * 添加团队
     * @return array
     */
    public function createGroup(): array
    {
        $request = Request::post();
        if(!$request['group_name']){
            return restful(403,'团队名称不能为空');
        }
        //名称查重
        $checking = $this->where('group_name',$request['group_name'])->find();
        if($checking){
            return restful(403,'团队名称已经存在，请换一个名称或是尝试加入团队');
        }
        $data = [
            'group_id'=> Uuid::getUuid(),
            'uid'=>$request['uid'],
            'group_name'=>$request['group_name'],
            'create_time'=>time()
        ];
        try {
            $this->save($data);
            return  restful(200,'团队添加成功！');
        }catch (Exception $exception){
            return restful(500, $exception->getMessage());
        }
    }
}