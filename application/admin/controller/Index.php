<?php

namespace app\admin\controller;

use think\Controller;

class index extends Controller
{
    // 重复登陆过滤
    public function initialize()
    {
        if (session('?admin.id')) {
            $this->redirect('admin/home/index');
        }
    }

    // 登陆
    public function login() {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => md5(input('post.password')),
            ];
            $resAll = model('Admin')->where($data)->find();
            $result = model('Admin')->login($data, 2);
            if ($result == 1) {
                model('Log')->record($resAll['id']);
                $this->success('登陆成功!', 'admin/home/index');
            } else {
                $this->error($result);
            }

        }
        return view();
    }

    // 注册
    public function register() {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => md5(input('post.password')),
                'conpass'  => md5(input('post.conpass')),
                'nickname' => input('post.nickname'),
                'propic'     => input('post.propic', '/static/photos/0.jpg'),
                'email'    => input('post.email'),
                'role_id'     => input('post.role_id')
            ];
            $result = model('Admin')->register($data);
            if ($result == 1) {
                $this->success('注册成功', 'admin/index/login');
            } else {
                $this->error($result);
            }
        }
        $roleInfo = model('Role')->select();
        $viewData = [
            'roleInfo' => $roleInfo
        ];
        $this->assign($viewData);
        return view();
    }

    // 忘记密码
    public function forget() {
        if (request()->isAjax()) {
            $data = [
                'email' => input('post.email')
            ];
            $findEmail = model('Admin')->where('email', $data['email'])->find();
            if ($findEmail) {
                $code = mt_rand(1000, 9999);
                session('code', $code);
                session('info', $findEmail['id']);
                $result = mailto(input('post.email'), '重置验证码', '你的验证码密码是: ' . $code);
            } else {
                $result = null;
            }
            if ($result) {
                $this->success();
            } else {
                $this->error('该用户没有注册');
            }
        }
        return view();
    }

    // 确认验证码
    public function vercode() {
        $data = [
            'code' => input('post.code')
        ];
        if ($data['code'] == session('code')) {
            $this->success('验证码正确, 请重置密码');
        } else {
            $this->error('验证码不正确');
        }
    }

    // 重置密码
    public function reset() {
        $data = [
            'password' => input('post.password'),
            'conpass' => input('post.conpass')
        ];
        $result = model('Admin')->reset($data);
        if ($result == 1) {
            $this->success('密码重置成功, 请去登陆吧', 'admin/index/login');
        } else {
            $this->error($result, 'admin/index/forget');
        }
    }

}
