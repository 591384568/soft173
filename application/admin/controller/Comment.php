<?php

namespace app\admin\controller;

use think\Controller;

class Comment extends Base
{
    // 评论列表
    public function all() {
        $comments = model('Comment')->with('article')->with('admin')->order('create_time','desc')->paginate(10);
        $viewData = [
            'comments' => $comments,
        ];
        $this->assign($viewData);
        return view();
    }

    // 评论删除
    public function del() {
        $commentInfo = model('Comment')->with('reply')->find(input('post.id'));
        $result = $commentInfo->together('reply')->delete();
        if ($result) {
            return $this->success('删除成功', 'admin/comment/all');
        } else {
            $this->error('删除失败');
        }
    }
}
