<?php


namespace app\api\model;


use think\Exception;
use think\Model;

class GroupDepartment extends Model
{
    protected $pk ='depart_id';

    /**
     * 添加部门
     * @return array
     */
    public function createDepartment(): array
    {
        $request = request()->post();
        $data=[
            'name'=>$request['name'],
            'group_id'=>$request['group_id']
        ];
        try {
            $this->save($data);
            return restful(200,'添加成功');
        }catch (Exception $exception){
            return restful(500,$exception->getMessage());
        }
    }
}