<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Reply extends Model
{
    // 软删除
    use SoftDelete;

    public function admin() {
        return $this->belongsTo('Admin', 'member_id', 'id');
    }

    public function add($data) {
        $validate = new \app\common\validate\Reply();
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
}
