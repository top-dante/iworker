<?php


namespace app\api\model;


use think\Exception;
use think\Model;

class GroupMember extends Model
{
    /**
     * 添加成员
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function createMember(): array
    {
        $request = request()->post();
        $request['create_time'] = time();
        $request['mobile']  = encrypt($request['mobile']);
        $check = $this->where('username',$request['username'])
            ->where('mobile',$request['mobile'])
            ->find();
        if($check){
            return restful(403,'成员已经存在，请勿重复添加');
        }
        try {
            $this->save($request);
            return restful(200,'成员添加成功！');
        }catch (Exception $exception){
            return restful(500,$exception->getMessage());
        }
    }

    /**
     * 获取列表
     * @return array
     * @throws \think\db\exception\DbException
     */
    public function getPage(): array
    {
        $request = request()->get();
        $map[] = ['group_id','=',$request['group_id']];
        if($request['depart_id']){
            $child = (new GroupDepartment())->where('pid',$request['depart_id'])->column('depart_id');
            if(!$child){
                $map[] =['depart_id','=',$request['depart_id']];
            }
        }
        //关键字搜索
        if(isset($request['key']) && $request['key']){
            $map[] = ['username','like',"%$request[key]%"];
        }
        //接收分页大小 不设置默认15条
        $request['page_size'] ? $size = $request['page_size'] : $size = 15;

        $result = $this->where($map)->with(['department'=>function($query){
            $query->field('depart_id,name');
        }])->paginate($size);

        return restful(200,'',$result);
    }

    /**
     * 关联预载入
     * @return \think\model\relation\HasOne
     */
    public function department(): \think\model\relation\HasOne
    {
        return $this->hasOne('GroupDepartment','depart_id','depart_id');
    }

    //手机号码解密
    public function getMobileAttr($value){
        return decrypt($value);
    }
}