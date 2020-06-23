<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Notice extends Model
{
    use SoftDelete;

    // 关联用户表
    public function admin() {
        return $this->belongsTo('Admin', 'user_name', 'nickname');
    }

    // 公告发布
    public function add($data) {
        $validate = new \app\common\validate\Notice();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }

        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

    // 公告修改
    public function edit($data) {
        $validate = new \app\common\validate\Notice();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }

        $noticeInfo = $this->find($data['id']);
        $noticeInfo->content = $data['content'];
        $noticeInfo->file = $data['file'] ?? null;
        $result = $noticeInfo->save();
        if ($result) {
            return 1;
        } else {
            return 0;
        }

    }
}
