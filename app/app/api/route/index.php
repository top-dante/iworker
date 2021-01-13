<?php
use think\facade\Route;

Route::allowCrossDomain([
    'Access-Control-Allow-Methods'=>'GET, POST, PATCH, PUT, DELETE,OPTIONS'
]);