<?php

namespace app\common\model;

use think\Model;

class Bio extends Model
{
    // 与admin表进行关联

    public function updateInfo($data) {
        $memberInfo = $this->where(['user_id' => $data['id']])->find();
        $memberInfo->qq = $data['qq'];
        $memberInfo->wechat = $data['wechat'];
        $memberInfo->phone = $data['phone'];
        $memberInfo->address = $data['address'];
        $memberInfo->birthday = $data['birthday'];
        $memberInfo->height = $data['height'];
        $memberInfo->weight = $data['weight'];
        $memberInfo->hobby = $data['hobby'];
        $memberInfo->nation = $data['nation'];
        $memberInfo->pol_sta = $data['pol_sta'];
        $memberInfo->dorm = $data['dorm'];
        $memberInfo->career = $data['career'];
        $memberInfo->sex = $data['sex'];
        $result = $memberInfo->save();
        if ($result) {
            mailto(session('index.email'), '个人信息修改', '您的个人信息修改成功');
            return 1;
        } else {
            return '信息修改失败';
        }
    }
}
