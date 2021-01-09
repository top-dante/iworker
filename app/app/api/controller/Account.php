<?php


namespace app\api\controller;


use app\api\model\Member;

class Account
{
    /**
     * 新用户注册
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function register(): \think\response\Json
    {
        return json((new Member())->createUser());
    }

    /**
     * 用户登录
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function login(): \think\response\Json
    {
        return json((new Member())->login());
    }
}