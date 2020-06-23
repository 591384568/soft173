<?php

namespace app\index\controller;

use think\Controller;

class Notice extends Controller
{
    // 公告首页
    public function index() {

        $noticeInfo = model('Notice')->with('Admin')->order(['create_time' => 'desc'])->paginate(4);
        $viewData = [
            'noticeInfo' => $noticeInfo
        ];
        $this->assign($viewData);
        return $this->fetch();
    }
}
