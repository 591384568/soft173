<?php

namespace app\admin\controller;


class Phoall extends Base
{
    // 相册列表
    public function index() {
        $phoInfo = model('Phoall')->with('admin')->paginate(10);
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
                $this->success('图片上传成功', 'admin/phoall/index');
            } else {
                $this->error($result);
            }
        }
        return $this->fetch();
    }

    // 相册删除
    public function del() {
        $phoInfo = model('Phoall')->find(input('post.id'));
        $result = $phoInfo->delete();
        if ($result) {
            $this->success('图片删除成功', 'admin/phoall/index');
        } else {
            $this->error('图片删除失败');
        }
    }
}
