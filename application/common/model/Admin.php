<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    use SoftDelete;

    // 建立与role外键
    public function role() {
        return $this->belongsTo('Role', 'role_id', 'id');
    }
    // 关联comments
    public function comments() {
        return $this->hasMany('Comment','member_id', 'id');
    }
    // 关联学生信息表
    public function bio() {
        return $this->belongsTo('Bio', 'id', 'user_id');
    }
    // 后台登陆
    public function login($data, $sel) {
        $validata = new \app\common\validate\Admin();
        if (!$validata->scene('login')->check($data)) {
            return $validata->getError();
        }
        $result = $this->where($data)->find();
        if ($result) {
            if ($result['status'] != 1) {
                return '此账户被禁用';
            }
            $sessionData = [
                'id'       => $result['id'],
                'username' => $result['username'],
                'nickname' => $result['nickname'],
                'propic'   => $result['propic'],
                'is_super' => $result['is_super'],
                'email'    => $result['email']
            ];
            if ($sel == 1) {
                session('index', $sessionData);
            }
            if ($sel == 2) {
                session('admin', $sessionData);
            }
            return 1;
        } else {
            return '登陆失败!';
        }
    }

    // 注册验证
    public function register($data) {
        $validata = new \app\common\validate\Admin();
        if (!$validata->scene('register')->check($data)) {
            return $validata->getError();
        }
        $result = $this->allowField(true)->save($data);
        $id = $this->id;
        if ($result) {
            mailto($data['email'], '账户注册', '您的账户注册成功');
            model('Bio')->data(['user_id' => $id])->save();
            return 1;
        } else {
            return '添加失败';
        }
    }

    // 重置密码
    public function reset($data) {
        $validata = new \app\common\validate\Admin();
        if (!$validata->scene('reset')->check($data)) {
            return $validata->getError();
        }
        $adminInfo = $this->where('id', session('info'))->find();
        $adminInfo->password = md5($data['password']);
        $result = $adminInfo->save();
        if ($result) {
            $content = '恭喜你, 密码重置成功!<br />用户名: '. $adminInfo['username'] . '<br />新密码: ' . $data['password'];
            mailto($adminInfo['email'], '密码重置成功', $content);
            return 1;
        } else {
            return '密码重置失败';
        }
    }

    // 用户修改
    public function edit($data) {
        $validata = new \app\common\validate\Admin();
        if (!$validata->scene('Edit')->check($data)) {
            return $validata->getError();
        }
        $memberInfo = $this->find($data['id']);
        if ($memberInfo->password != md5($data['oldpassword'])) {
            return '原密码错误';
        } else {
            $memberInfo->password = md5($data['password']);
            $memberInfo->nickname = $data['nickname'];
            $result = $memberInfo->save();
            if ($result) {
                if ($memberInfo->id == session('admin.id')) {
                    session('admin', $memberInfo);
                }
                return 1;
            } else {
                return '密码重置失败';
            }
        }

    }

    // 个人信息修改
    public function updateInfo($data) {
        $validata = new \app\common\validate\Admin();
        if (!$validata->scene('Updata')->check($data)) {
            return $validata->getError();
        }
        $memberInfo = $this->find($data['id']);
        $memberInfo->nickname = $data['nickname'];
        $memberInfo->email = $data['email'];
        session('index.email', $data['email']);
        $result = $memberInfo->save();
        if ($result) {
            mailto($data['email'], '个人信息修改', '您的个人信息修改成功');
            return 1;
        } else {
            return '信息修改失败';
        }

    }

    // 前台密码修改
    public function pwdMod($data) {
        $validata = new \app\common\validate\Admin();
        if (!$validata->scene('pwd')->check($data)) {
            return $validata->getError();
        }
        $memberInfo = $this->find($data['id']);
        if ($memberInfo->password != md5($data['oldpassword'])) {
            return '原密码错误';
        } else {
            $memberInfo->password = md5($data['password']);
            $result = $memberInfo->save();
            if ($result) {
                if ($memberInfo->id == session('admin.id')) {
                    session('admin', $memberInfo);
                }
                return 1;
            } else {
                return '密码重置失败';
            }
        }
    }

}
