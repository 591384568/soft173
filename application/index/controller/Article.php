<?php

namespace app\index\controller;


use think\Controller;
use think\Db;

class Article extends Controller
{
    // 留言列表
    public function index() {

        $articleInfo = Db::name('article')->alias('a')->join('admin b', 'a.nickname = b.id')->join('role c', 'b.role_id = c.id')->field('a.id, b.propic, a.status, b.nickname, a.content, a.num, a.like, c.rolename, a.create_time')->order(['create_time' => 'desc'])->paginate(10);
        $viewData = [
            'articleInfo' => $articleInfo
        ];
        $this->assign($viewData);
        return $this->fetch();
    }

    // 留言详细信息
    public function detail() {
        $articleInfo = model('Article')->with('admin,name')->find(input('id'));
        $articleInfo->num = $articleInfo->num + 1;
        $articleInfo->save();
        $viewData = [
            'articleInfo' => $articleInfo
        ];
        $this->assign($viewData);
        return $this->fetch();
    }

    // 获取留言详细信息
    public function getInfo() {
        $articleInfo = model('Article')->with('admin,name')->find(input('id'));
        $commentInfo = model('Comment')->alias('a')->join('admin b', 'a.member_id = b.id')->where('article_id', '=', "{$articleInfo['id']}")->order(['a.id' => 'asc'])->field('a.id, a.content, b.propic, b.nickname, a.create_time')->select();
        $replyInfo = model('Article')->alias('a')->join('comment b', 'a.id = b.article_id')->join('Reply c', 'b.id = c.comment_id')->join('Admin d', 'c.member_id = d.id')
            ->where('article_id', '=', "{$articleInfo['id']}")->order(['c.id' => 'asc'])->field('b.id comment_id, c.id reply_id, c.content, d.nickname, d.propic, c.create_time')->select();
        $viewData = [
            'commentInfo' => $commentInfo,
            'replyInfo'   => $replyInfo
        ];
//        dump($viewData['replyInfo']);exit();
        return json_encode($viewData);
    }

    // 用户留言
    public function add() {
        if (!session('?index.id')) {
            $this->redirect('index/login/login');
        }
        if (request()->isAjax()) {
            $data = [
                'nickname' => input('post.id'),
                'status' => input('post.status'),
                'point'  => input('post.point'),
                'content' => input('post.content')
            ];
            $result = model('Article')->add($data);
            if ($result == 1) {
                return $this->success('文章添加成功', 'index/article/index');
            } else {
                return $this->error('留言添加失败');
            }
        }
        $memberInfo = model('Admin')->select();
        $viewData = [
            'memberInfo' => $memberInfo
        ];
        $this->assign($viewData);
        return $this->fetch();
    }

    // 用户评论
    public function comment() {
        if (!session('?index.id')) {
            return json_encode('您未登录账号');
        }
        $data = [
            'article_id' => input('post.article_id'),
            'member_id'  => input('post.member_id'),
            'content'    => input('post.content')
        ];
        $result = model('Comment')->add($data);
        if ($result == 1) {
            return json_encode('1');
        } else {
            return json_encode($result);
        }
    }

    // 用户回复
    public function reply() {

        $data = [
            'content' => input('post.content'),
            'comment_id' => input('post.comment_id'),
            'member_id' => input('post.member_id')
        ];
        $result = model('Reply')->add($data);
        if ($result == 1) {
            return json_encode('1');
        } else {
            return json_encode($result);
        }
    }
}
