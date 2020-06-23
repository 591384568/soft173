<?php
/**
 * Created by PhpStorm.
 * User: X_Xhcy
 * Date: 2020/4/28
 * Time: 15:54
 */

namespace app\common\validate;


use think\Validate;

class Notice extends Validate
{
    protected $rule = [
        'user_name|发布人' => 'require',
        'content|公告信息' => 'require'
    ];

    // 公告发布场景
    public function sceneAdd() {
        return $this->only(['user_name', 'content']);
    }
}