<?php

declare (strict_types = 1);

namespace app\api\controller;

use utils\Uuid;

class Project extends Base{

    public function test_id(){
        $uuid = Uuid::getUuid();
        print_r($uuid);
        print_r('<hr/>');
        print_r(strlen($uuid));
    }

    /**
     * 创建新项目
     * @return \think\response\Json
     */
    public function create_project(): \think\response\Json
    {
        $result = ['code'=>200,'msg'=>'request test is success'];
        return json($result);
    }
}