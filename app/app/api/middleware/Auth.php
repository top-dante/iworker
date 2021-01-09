<?php


namespace app\api\middleware;


class Auth
{
    /**
     * 校验token
     * @param $request
     * @param \Closure $next
     * @return \think\response\Json
     */
    public function handle($request, \Closure $next): \think\response\Json
    {
        $authorization = request()->header('Authorization');
        //是否传header token
        if(!$authorization){
            return json(restFul(40001,'无法获取您的登录凭据，请重新登陆！'));
        }
        $authorization = explode('.',$authorization);
        $tokenArray = decrypt($authorization[0]);
        $token = substr($tokenArray,0,18);
        if(verifyCrypt($authorization[1],$token)){
            return json(restFul(40003,'token校验失败，请重新登陆!'));
        };

        return $next($request);
    }
}