<?php

namespace app\admin\controller;

class home extends Base
{
    // 后台首页
    public function index() {
        return view();
    }

    // 个人头像修改
    public function picmod() {
        $personInfo = model('Admin')->find(session('admin.id'));
        $name = $_FILES['fileArray']['name'];
        $last = substr($name,strrpos($name,'.'));
        $name = $personInfo->username . $last;
        $address = 'static/photos/' . $name;
        $result = move_uploaded_file($_FILES['fileArray']['tmp_name'], $address);
        if (!$result) {
            return $this->error('修改失败');
        } else {
            session('admin.propic', '/' . $address);
            $personInfo->propic = '/' . $address;
            $personInfo->save();
            $this->success('修改成功', $personInfo->propic);
        }
    }

    // 退出登陆
    public function loginout() {
        if (request()->isAjax()) {
            session('admin', null);
            if (session('?admin.id')) {
                $this->error('退出失败!');
            } else {
                $this->success('退出成功', 'admin/index/login');
            }
        }
    }
}
