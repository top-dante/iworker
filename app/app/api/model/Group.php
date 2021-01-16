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
     * 新建团队
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
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

    /**
     * 查询全部团队列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getGroupList(): array
    {
        $data = $this->where('uid',request()->get('uid',''))
            ->order('create_time','asc')
            ->select();
        return restful(200,'ok',$data);
    }


    /**
     * 关联预载入 部门
     * @return \think\model\relation\HasMany
     */
    public function department(): \think\model\relation\HasMany
    {
        return $this->hasMany('GroupDepartment','group_id','group_id');
    }

}