<?php

namespace app\admin\controller;


class Notice extends Base
{
    // 公告列表
    public function all() {
        $noticeInfo = model('Notice')->order(['id' => 'asc'])->paginate(10);
        $viewData = [
            'noticeInfo' => $noticeInfo
        ];
        $this->assign($viewData);
        return view();
    }

    // 公告添加
    public function add() {
        if (request()->isAjax()) {
            $data = [
                'user_name' => input('post.username'),
                'content'   => input('post.content')
            ];

            if (isset($_FILES['fileArray'])) {
                $name = $_FILES['fileArray']['name'];
                $last = substr($name,strrpos($name,'.'));
                $name = $data['user_name'] . date('Ymdhis') . $last;
                $address = 'static/notice/' . $name;
                $result = move_uploaded_file($_FILES['fileArray']['tmp_name'], $address);
            }

            if (isset($result) && $result == false) {
                return $this->error('文件上传失败');
            }
            if (isset($address)) {
                $data['file'] = '/' . $address;
            }

            $result = model('Notice')->add($data);
            if ($result == 1) {
                return $this->success('公告发布成功', 'admin/notice/all');
            } else {
                return $this->error('公告发布失败');
            }
        }
        return $this->fetch();
    }

    // 公告修改
    public function edit() {

        if (request()->isAjax()) {
            $data = [
                'id'        => input('post.id'),
                'user_name' => input('post.username'),
                'content'   => input('post.content')
            ];
            if (isset($_FILES['fileArray'])) {
                $name = $_FILES['fileArray']['name'];
                $last = substr($name,strrpos($name,'.'));
                $name = $data['user_name'] . date('Ymdhis') . $last;
                $address = 'static/notice/' . $name;
                $result = move_uploaded_file($_FILES['fileArray']['tmp_name'], $address);
            }
            if (isset($result) && $result == false) {
                return $this->error('文件上传失败');
            }
            if (isset($address)) {
                $data['file'] = '/' . $address;
            }

            $result = model('Notice')->edit($data);
            if ($result == 1) {
                return $this->success('公告修改成功', 'admin/notice/all');
            } else {
                return $this->error('公告修改失败');
            }

        }

        $noticeInfo = model('Notice')->find(input('id'));
        $viewData = [
            'noticeInfo' => $noticeInfo
        ];
        $this->assign($viewData);
        return view();
    }

    // 公告删除
    public function del() {
        $notice = model('Notice')->find(input('post.id'));
        $result = $notice->delete();
        if ($result) {
            return $this->success('公告删除成功', 'admin/notice/all');
        } else {
            return $this->error('公告删除失败');
        }
    }
}
