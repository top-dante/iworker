<?php


namespace app\api\controller;


use app\api\model\GroupDepartment;

/**
 * 部门管理
 * Class Department
 * @package app\api\controller
 */
class Department extends Base
{
    /**
     * 获取列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index(): array
    {
        return (new GroupDepartment())->getDepartmentList();
    }
    public function read(){

    }

    /**
     * 新建
     * @return array
     */
    public function create(): array
    {
        return (new GroupDepartment())->createDepartment();
    }

    /**
     * 更新
     * @return array
     */
    public function update(): array
    {
        return (new GroupDepartment())->updateDepartment();
    }

    /**
     * 删除
     * @return array
     */
    public function delete(): array
    {
        return (new GroupDepartment())->delDepartment();
    }
}