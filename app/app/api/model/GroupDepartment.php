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
            'group_id'=>$request['group_id'],
            'pid'=>$request['pid']
        ];
        $check = $this->where('name',$request['name'])
            ->where('group_id',$request['group_id'])
            ->find();
        if($check){
            return restful(403,'部门已经存在，请勿重复添加！');
        }
        try {
            $this->save($data);
            return restful(200,'添加成功');
        }catch (Exception $exception){
            return restful(500,$exception->getMessage());
        }
    }

    /**
     * 获取部门遍历树
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getDepartmentList(): array
    {
        $groupId = request()->get('group_id','');
        if(!$groupId){
            return  restful(403,'无法获取团队ID，请重新登录');
        }
        $result = $this->where('group_id',request()->get('group_id',''))
            ->select();
        $result = getTree($result->toArray(),'depart_id');
        return restful(200,'ok',$result);
    }

    /**
     * 更新
     * @return array
     */
    public function updateDepartment(): array
    {
        $request = request()->post();
        try {
            $this->update($request);
            return  restful(200,'更新成功');
        }catch (Exception $exception){
            return restful(500,$exception->getMessage());
        }
    }

    public function delDepartment(): array
    {
        $request = request()->get('depart_id','');
        if(!$request){
            return  restful(403,'无法获取部门ID，请刷新重试！');
        }
        try {
            $this->where('depart_id',$request)->delete();
            return  restful(200,'删除成功！');
        }catch (Exception $exception){
            return  restful(500,$exception->getMessage());
        }
    }
}