<?php

namespace app\admin\controller;

class Member extends Base
{
    // 人员列表
    public function all() {
        $adminInfo = model('Admin')->with('role')->order('id', 'asc')->paginate(10);
        $viewData = [
            'roleInfo' => $adminInfo
        ];
        $this->assign($viewData);
        return view();
    }
    // 人员添加
    public function add() {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => md5(input('post.password')),
                'conpass' => md5(input('post.conpass')),
                'nickname' => input('post.nickname'),
                'propic' => input('post.propic', null),
                'email' => input('post.email'),
                'role_id' => input('post.role')
            ];
            $name = $_FILES['fileArray']['name'];
            $last = substr($name,strrpos($name,'.'));
            $name = $data['username'] . $last;
            $address = 'static/photos/' . $name;
            move_uploaded_file($_FILES['fileArray']['tmp_name'], $address);
            $data['propic'] = '/' . $address;
            $result = model('Admin')->register($data);
            if ($result == 1) {
                $this->success('添加用户成功', 'admin/member/all');
            } else {
                $this->error($result);
            }
        }
        $roleInfo = model('Role')->select();
        $viewData = [
            'roleInfo' => $roleInfo
        ];
        $this->assign($viewData);
        return $this->fetch();
    }
    // 人员删除
    public function del() {
        $adminInfo = model('Admin')->with('comments')->find(input('post.id'));
        $result = $adminInfo->together('comments')->delete();
        if ($result) {
            if ($adminInfo['id'] == session('admin.id')) {
                session(null);
            }
            $this->success('用户删除成功', 'admin/member/all');
        } else {
            $this->error('用户删除失败');
        }
    }
    // 人员编辑
    public function edit() {
        if (request()->isAjax()) {
            $data = [
                'id'          => input('post.id'),
                'oldpassword' => input('post.oldpassword'),
                'password' => input('post.password'),
                'conpass' => input('post.conpass'),
                'nickname'    => input('post.nickname'),
                'email'       => input('post.email')
            ];
            $result = model('Admin')->edit($data);
            if ($result == 1) {
                return $this->success('信息修改成功', 'admin/member/all');
            } else {
                return $this->error($result);
            }
        }
        $memberInfo = model('Admin')->with('role')->find(input('id'));
        $viewData = [
            'memberInfo' => $memberInfo
        ];
        $this->assign($viewData);
        return view();
    }
    // 人员信息
    public function info() {
        $memberInfo = model('Admin')->with('Bio')->find(input('id'));
        $viewData = [
            'memberInfo' => $memberInfo
        ];
        $this->assign($viewData);
        return $this->fetch();
    }

}
