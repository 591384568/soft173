<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Log extends Model
{
    // 软删除
    use SoftDelete;

    public function admin() {
        return $this->belongsTo('Admin', 'user_id', 'id');
    }

    // 插入登陆日志记录
    public function record($id) {
        $val = [
            'user_id' => $id,
            'ip'      => request()->ip(),
            'browser' => userBrowser()
        ];
        $result = $this->allowField(true)->save($val);
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }
}
