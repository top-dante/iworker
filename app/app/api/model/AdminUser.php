<?php


namespace app\api\model;

use think\facade\Request;
use think\Model;
use utils\Uuid;

class AdminUser extends Model
{
    protected $pk = 'openid';

    /**
     * 添加管理员
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function createUser(): array
    {
        $data = Request::post();
        unset($data['check_pass'],$data['verify_code']);
        if(!$data['mobile']){
            return  restful(403,'手机号码不能为空');
        }
        //用户名称查重
        $check = $this->whereOr('mobile', $data['mobile'])
            ->whereOr('username',$data['username'])
            ->find();

        if ($check['mobile'] === $data['mobile']) {
            return restful(403, '机号码已经注册，请登录');
        }
        if($check['username'] === $data['username']){
            return  restful(403,'用户名重复，换一个试试！');
        }
        $data['openid'] = Uuid::getUuid();
        $data['mobile'] = encrypt($data['mobile']);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['reg_ip'] = Request::ip();
        $data['last_time'] = time();
        $data['last_ip'] = Request::ip();
        $data['create_time'] = time();
        try {
            $this->insert($data);
            return restful(200, '注册成功，正在为您跳转到登录页面');
        } catch (\Exception $exception) {
            return restful(500, $exception->getMessage());
        }
    }

    /**
     * 管理登录
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function login(): array
    {
        $request = Request::post();

        $user = $this->where('mobile', decrypt($request['mobile']))->find();
        if (!$user) {
            return restful(404, '用户不存在或是已经被删除');
        }
        //校验密码
        if (!$this->verifyPassword(decrypt($request['password']), $user['password'])) {
            return restful(403, '密码错误，请检查重试');
        }

        //更新登录信息
        $stat = [
            'user_id' => $user['user_id'],
            'last_time' => time(),
            'last_ip' => \request()->ip()
        ];
        $this->update($stat);
        //组合返回信息
        $data = [
            'user_id' => $user['user_id'],
            'username' => $user['username'],
            'avatar' => $user['avatar'],
            'mobile' => $user['mobile'],
            'create_time' => time(),
            'token' => encrypt($user['user_id'] . '.' . time())
        ];
        return restful(200, '登录成功，欢迎回来！', $data);

    }

    public function updateMember()
    {
    }

    public function readMember()
    {
    }

    public function deleteMember()
    {
    }

    private function verifyPassword($password, $hash): bool
    {
        $str = password_verify($password, $hash);
        if ($str) {
            return true;
        } else {
            return false;
        }
    }

    private function createSecret()
    {

    }

}