<?php

declare (strict_types = 1);

namespace app\api\controller;

class Project {
    public function create_project(){
        $result = ['code'=>200,'msg'=>'request test is success'];
        return json($result);
    }
}