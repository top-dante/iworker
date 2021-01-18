<?php


namespace app\api\controller;


use app\api\model\Group;
use app\api\model\GroupDepartment;
use app\api\model\GroupMember;

class Member extends Base
{

    public function index(): array
    {
        return (new GroupMember())->getPage();
    }
    /**
     * 添加成员
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function create_member(): array
    {
        return (new GroupMember())->createMember();
    }

    /**
     * 添加团队
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function create_group(): array
    {
        return (new Group())->createGroup();
    }

    /**
     * 获取团队列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_group_list(): array
    {
        return (new Group())->getGroupList();
    }

    public function create_department(): array
    {
        return (new GroupDepartment())->createDepartment();
    }
    public function get_department_list(): array
    {
        return (new GroupDepartment())->getDepartmentList();
    }
}