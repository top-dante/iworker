<?php
namespace app\controller;

use app\BaseController;

class Project extends BaseController{

    public function create_project(){
        $result = ['code'=>200,'msg'=>'request test is success'];

        return json($result);
    }

}