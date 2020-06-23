<?php

namespace app\admin\controller;

class Reply extends Base
{
    // 回复列表
    public function all() {
        $replyInfo = model('Reply')->with('admin')->order(['id' => 'asc'])->paginate(10);
        $viewData = [
            'replyInfo' => $replyInfo
        ];
        $this->assign($viewData);
        return view();
    }

    // 删除回复信息
    public function del() {
        $replyInfo = model('Reply')->find(input('post.id'));
        $result = $replyInfo->delete();
        if ($result) {
            return $this->success('删除回复成功', 'admin/Reply/all');
        } else {
            $this->error('删除回复失败');
        }
    }
}