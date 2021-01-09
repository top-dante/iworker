<?php


namespace app\api\controller;


use app\api\model\Group;

class Member extends Base
{

    public function create_member()
    {

    }

    /**
     * 添加团队
     * @return array
     */
    public function create_group(): array
    {
        return (new Group())->createGroup();
    }

    public function create_department()
    {

    }
}