<?php

namespace app\admin\controller;

use think\Controller;

class admin extends Controller
{
    // 管理员列表
    public function all() {

        $adminInfo = model('Admin')->order(['is_super' => 'desc', 'status' => 'desc', 'id' => 'asc'])->paginate(10);
        $viewData = [
            'adminInfo' => $adminInfo
        ];

        $this->assign($viewData);
        return view();
    }

    // 修改管理员状态
    public function status() {
        $adminInfo = model('Admin')->find(input('post.id'));
        if ($adminInfo->status == 1) {
            $adminInfo->status = 0;
        } else {
            $adminInfo->status = 1;
        }
        $result = $adminInfo->save();
        if ($result) {
            return $this->success('操作成功', 'admin/admin/all');
        } else {
            return $this->error('操作失败');
        }
        return $result;
    }
}
