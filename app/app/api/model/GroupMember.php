<?php


namespace app\api\model;


use think\Exception;
use think\Model;

class GroupMember extends Model
{
    protected $pk = 'id';
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

    public function updateMember(): array
    {
        $request = request()->post();
        $request['mobile'] = encrypt($request['mobile']);
        try {
            $this->update($request,['id'=>$request['id']]);
            return  restful(200,'成员信息更新成功!');
        }catch (Exception $exception){
            return restful(500,$exception->getMessage());
        }
    }

    /**
     * 删除用户
     * @return array
     */
    public function deleteMember(): array
    {
        $request = request()->get('id','','intval');
        if(!$request){
            return restful(403,'无法获取成员ID');
        }
        try {
            $this->where('id',$request)->delete();
            return restful(200,'成员删除成功');
        }catch (Exception $exception){
            return  restful(500,$exception->getMessage());
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
        //检测部门ID
        if(isset($request['depart_id']) && $request['depart_id']){
            $child = (new GroupDepartment())
                ->where('pid',$request['depart_id'])
                ->column('depart_id');

            if(!$child || count($child) === 1){
                $map[] =['depart_id','=',$request['depart_id']];
            }else{
                $id = implode(',',$child);
                $map[] = ['depart_id','in',$id];
            }
        }
        if(isset($request['order']) && isset($request['order_by'])){
            $order = [$request['order_by']=>$request['order']];
        }else{
            $order  = ['id'=>'asc'];
        }
        if(isset($request['status'])){
            $map[] = ['status','=',$request['status']];
        }

        //关键字搜索
        if(isset($request['key']) && $request['key']){
            $map[] = ['username','like',"%$request[key]%"];
        }

        $result = $this->where($map)->with(['department'=>function($query){
            $query->field('depart_id,name,color');
        }])->order($order)->select();

        return restful(200,'',$result);
    }

    /**
     * 更新成员状态
     * @return array
     */
    public function stopMember(): array
    {
        $request = request()->get();
        if(!$request['id']){
            return restful(403,'无法获取成员ID，请刷新重试！');
        }
        try {
            $this->update($request);
            $request['status'] ? $msg = "成员启用成功！" : $msg="成员禁用成功！";
            return  restful(200,$msg);
        }catch (Exception $exception){
            return  restful(500,$exception->getMessage());
        }
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