<?php

namespace app\index\controller;


class Photos extends Base
{
    // 相册页面
    public function index() {
        $phoInfo = model('Phoall')->with('admin')->order(['create_time' => 'desc'])->paginate(9);
        $viewData = [
            'phoInfo' => $phoInfo
        ];
        $this->assign($viewData);
        return $this->fetch();
    }

    // 相册添加
    public function add() {
        if (request()->isAjax()) {
            $data = [
                'user_id' => input('post.user_id'),
                'dorm'    => input('post.dorm') != '' ? input('post.dorm') : null,
                'photos'  => ''
            ];
            $result = model('phoall')->add($data);
            if ($result == 1) {
                $this->success('图片上传成功', 'index/photos/index');
            } else {
                $this->error($result);
            }
        }
        $memberInfo = model('Admin')->select();
        $viewData = [
            'memberInfo' => $memberInfo
        ];
        $this->assign($viewData);
        return $this->fetch();
    }
}
