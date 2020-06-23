<?php
/**
 * Created by PhpStorm.
 * User: X_Xhcy
 * Date: 2020/5/14
 * Time: 11:41
 */

namespace app\common\validate;


use think\Validate;

class Reply extends Validate
{
    protected $rule = [
        'content|内容' => 'require',
    ];

    // 添加, 修改场景
    public function sceneAdd() {
        return $this->only(['content']);
    }
}