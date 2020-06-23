<?php

namespace app\admin\controller;

class Article extends Base
{
    // 文章列表
    public function all() {
        $articleInfo = model('Article')->with('admin,name')->order(['id' => 'desc'])->paginate(10);
        $viewData = [
            'articleInfo' => $articleInfo
        ];
        $this->assign($viewData);
        return view();
    }

    // 文章添加
    public function add() {
        if (request()->isAjax()) {
            $data = [
                'nickname' => input('post.id'),
                'status' => input('post.status'),
                'point'  => input('post.point'),
                'content' => input('post.content')
            ];
            $result = model('Article')->add($data);
            if ($result == 1) {
                return $this->success('文章添加成功', 'admin/article/all');
            } else {
                return $this->error('留言添加失败');
            }
        }
        $memberInfo = model('Admin')->select();
        $viewData = [
            'memberInfo' => $memberInfo
        ];
        $this->assign($viewData);
        return view();
    }

    // 文章删除
    public function del() {
        $articleInfo = model('Article')->with('comments')->find(input('post.id'));
        $result = $articleInfo->together('comments')->delete();
        if ($result) {
            $this->success('留言删除成功', 'admin/article/all');
        } else {
            $this->error('留言删除失败');
        }
    }

    // 文章编辑
    public function edit() {

        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'point' => input('post.point'),
                'status' => input('post.status'),
                'content' => input('post.content')
            ];
            $result = model('Article')->edit($data);
            if ($result == 1) {
                $this->success('文章修改成功', 'admin/article/all');
            } else {
                $this->error('文章修改失败');
            }
        }

        $articleInfo = model('Article')->with('admin')->find(input('id'));
        $memberInfo = model('Admin')->select();
        $viewData = [
            'articleInfo' => $articleInfo,
            'memberInfo'  => $memberInfo
        ];
        $this->assign($viewData);
        return view();
    }
}
