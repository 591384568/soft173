<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{

    public function index() {
        return $this->fetch();
    }

    // 获取首页幻灯片图片
    public function slide() {
        $photos = model('phoall')->with('admin')->order(['create_time' => 'desc'])->limit(4)->select();
        return json_encode($photos);
    }

    // 获取首页公告
    public function notice() {
        $noticeInfo = model('Notice')->with('admin')->order(['create_time' => 'desc'])->limit(4)->select();
        return json_encode($noticeInfo);
    }

    // 前台登陆退出
    public function logout() {
        session('index', null);
        if (!session('index')) {
            $this->success('退出成功', 'index/index/index');
        } else {
            $this->error('退出失败', 'index/index/index');
        }
    }

}
