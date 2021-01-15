<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\api\model\GroupDepartment;

class Index
{
    public function index(): string
    {
        return '您好！这是一个[appi]示例应用';
    }
    public function tree(){
        $list = (new GroupDepartment())->select()->toArray();
        $tree = getTree($list,'depart_id');
        print_r($tree);
    }
}
