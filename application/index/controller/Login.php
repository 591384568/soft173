<?php

namespace app\index\controller;

use think\Controller;

class Login extends Controller
{

    public function initialize()
    {
        if (session('?index.id')) {
            $this->redirect('index/index/index');
        }
    }

    // 登陆首页
    public function login() {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => md5(input('post.password'))
            ];
            $resAll = model('Admin')->where($data)->find();
            $result = model('Admin')->login($data, 1);
            if ($result == 1) {
                model('Log')->record($resAll['id']);
                $this->success('登陆成功!', 'index/index/index');
            } else {
                $this->error($result);
            }
        }
        return $this->fetch();
    }

    // 忘记密码
    public function forget() {
        if (request()->isAjax()) {
            $data = [
                'password' => input('post.password'),
                'conpass' => input('post.conpass')
            ];
            $result = model('Admin')->reset($data);
            if ($result == 1) {
                $this->success('密码重置成功, 请去登陆吧', 'index/login/login');
            } else {
                $this->error($result, 'index/login/forget');
            }
        }
        return $this->fetch();
    }

    // 动态修改头像
    public function propic() {
        $result = model('admin')->where(['username' => input('post.id')])->find();
        if ($result) {
            return json_encode(['code' => 1, 'data' => $result['propic']]);
        } else {
            return json_encode(['code' => 0]);
        }
    }
}
