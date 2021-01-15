<?php
// 应用公共文件

/**
 * 统一接口返回格式
 * @param int $code
 * @param string $msg
 * @param array $data
 * @return array
 */
function restful($code = 200, $msg = 'success', $data = []): array
{
    return [
        'code' => $code,
        'msg' => $msg,
        'data' => $data,
        'timestamp' => time()
    ];
}

/**
 * 解密
 * @param $string
 * @return array|string
 */

function decrypt($string): string
{
    return \utils\SignatureHelper::decode($string);
}

/**
 * 加密
 * @param $string
 * @return string
 */
function encrypt($string): string
{
    return \utils\SignatureHelper::encode($string);
}

/**
 * 加密校验
 * @param $string
 * @param $token
 * @return bool
 */
function verifyCrypt($string, $token): bool
{
    return \utils\SignatureHelper::verify($string,$token);
}

/**
 * 获取遍历树
 * @param $list
 * @param string $pk
 * @param string $pid
 * @param string $child
 * @param int $root
 * @return array
 */
function getTree($list, $pk = 'id', $pid = 'pid',$child = 'children', $root = 0): array
{
    $items = [];
    foreach ($list as $value){
       $items[$value[$pk]] = $value;
    }
    $tree = [];
    foreach ($items as $key =>$val) {
       if(isset($items[$val[$pid]])){
           $items[$val[$pid]][$child][] = &$items[$key];
       }else{
           $tree[] = &$items[$key];
       }
    }
    return $tree;
}