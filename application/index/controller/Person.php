<?php

namespace app\index\controller;


class Person extends Base
{
    // 个人资料主页
    public function index() {
        $memberInfo = model('admin')->with('bio')->find(session('index.id'));
        $viewData = [
            'memberInfo' => $memberInfo
        ];
        $this->assign($viewData);
        return $this->fetch();
    }

    // 查看个人发布公告
    public function notice() {
        $noticeInfo = model('Notice')->with('Admin')->where(['user_name' => input('id')])->order(['create_time' => 'desc'])->paginate(4);
        $viewData = [
            'noticeInfo' => $noticeInfo
        ];
        $this->assign($viewData);
        return $this->fetch('notice/index');
    }

    // 查看个人发布留言
    public function article() {
        $articleInfo = model('article')->alias('a')->join('admin b', 'a.nickname = b.id')->join('role c', 'b.role_id = c.id')
            ->where(['a.nickname' => input('id')])
            ->field('a.id, b.propic, a.status, b.nickname, a.content, a.num, a.like, c.rolename, a.create_time')
            ->order(['create_time' => 'desc'])->paginate(10);
        $viewData = [
            'articleInfo' => $articleInfo
        ];
        $this->assign($viewData);
        return $this->fetch('article/index');
    }

    // 查看个人发布相册
    public function photos() {
        $phoInfo = model('Phoall')->with('admin')->where(['user_id' => input('id')])->order(['create_time' => 'desc'])->paginate(9);
        $viewData = [
            'phoInfo' => $phoInfo
        ];
        $this->assign($viewData);
        return $this->fetch('Photos/index');
    }

    // 修改个人资料
    public function updata() {
        if (request()->isAjax()) {
            $mainInfo = [
                'id'       => input('post.id'),
                'nickname' => input('post.nickname'),
                'email'    => input('post.email')
            ];
            $bioInfo = [
                'id'       => input('post.id'),
                'qq'       => input('post.qq'),
                'wechat'   => input('post.wechat'),
                'phone'    => input('post.phone'),
                'address'  => input('post.address'),
                'birthday' => input('post.birthday') != '' ? input('post.birthday') : null,
                'height'   => input('post.height'),
                'weight'   => input('post.weight'),
                'hobby'    => input('post.hobby'),
                'nation'   => input('post.nation'),
                'pol_sta'  => input('post.pol_sta'),
                'dorm'    => input('post.dorm') != '' ? input('post.dorm') : null,
                'career'   => input('post.career'),
                'sex'      => input('post.sex') != '' ? input('post.sex') : null
            ];

            $resInfo_member = model('Admin')->updateInfo($mainInfo);
            $resInfo_bio    = model('Bio')->updateInfo($bioInfo);
            if ($resInfo_member == 1 && $resInfo_bio == 1) {
                $this->success('信息修改成功', 'index/person/index');
            } else {
                $this->error($resInfo_member);
            }
        }

        $memberInfo = model('admin')->with('bio')->find(session('index.id'));
        $pol_sta = array(array('id' => '1', 'name' => '群众'), array('id' => '2', 'name' => '团员'), array('id' => '3', 'name' => '党员'));
        $dorm_num = array('216', '306', '310', '314', '315');
        $viewData = [
            'memberInfo' => $memberInfo,
            'pol_sta'    => $pol_sta,
            'dorm_num'   => $dorm_num
        ];
        $this->assign($viewData);
        return $this->fetch();
    }

    // 修改密码
    public function pwdmod() {
        if (request()->isAjax()) {
            $data = [
                'id'          => input('post.id'),
                'oldpassword' => input('post.oldpassword'),
                'password' => input('post.password'),
                'conpass' => input('post.conpass')
            ];
            $result = model('Admin')->pwdMod($data);
            if ($result == 1) {
                return $this->success('信息修改成功', 'index/person/index');
            } else {
                return $this->error($result);
            }
        }
        return $this->fetch();
    }

}
