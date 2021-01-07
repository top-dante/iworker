<?php


namespace app\api\controller;


use app\api\model\AdminUser;

class Account
{
    public function register(): \think\response\Json
    {
        $adminUser = new AdminUser();
        return json($adminUser->createUser());
    }
}