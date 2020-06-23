<?php

namespace app\admin\controller;

use think\Controller;

class Log extends Controller
{
    // 主页
    public function all() {
        $logInfo = model('Log')->with('admin')->order(['id' => 'desc'])->paginate(10);
//        $logInfo = model('Log')->with('admin')->order(['id' => 'asc'])->select();
//        dump($logInfo);exit();
        $viewData = [
            'LogInfo' => $logInfo
        ];
        $this->assign($viewData);
        return view();
    }

    // 删除登录日志
    public function del() {
        $LogInfo = model('Log')->find(input('post.id'));
        $result = $LogInfo->delete();
        if ($result) {
            $this->success('登陆日志删除成功', 'admin/log/all');
        } else {
            $this->error('日志删除失败');
        }
    }
}
