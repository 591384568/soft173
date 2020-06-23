<?php
/**
 * Created by PhpStorm.
 * User: X_Xhcy
 * Date: 2020/4/21
 * Time: 15:59
 */

namespace app\common\validate;


use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'username|用户名'  => 'require',
        'password|密码'    => 'require',
        'conpass|确认密码' => 'require|confirm:password',
        'nickname|昵称'   => 'require',
        'email|邮箱'      => 'require|email|unique:admin',
    ];

    // 登陆验证场景
    public function sceneLogin() {
        return $this->only(['username', 'password']);
    }

    // 注册场景验证
    public function sceneRegister() {
        return $this->only(['username', 'password', 'conpass', 'nickname', 'email'])->append('username', 'unique:admin');
    }

    // 密码重置场景
    public function sceneReset() {
        return $this->only(['password', 'conpass']);
    }

    // 用户修改场景
    public function sceneEdit() {
        return $this->only(['nickname', 'password', 'conpass', 'email']);
    }

    // 用户信息修改场景
    public function sceneUpdata() {
        return $this->only(['email', 'nickname']);
    }

    // 用户前台密码修改场景
    public function scenePwd() {
        return $this->only(['password', 'conpass']);
    }
}