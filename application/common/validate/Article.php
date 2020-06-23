<?php
/**
 * Created by PhpStorm.
 * User: X_Xhcy
 * Date: 2020/4/12
 * Time: 14:25
 */

namespace app\common\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'content|内容' => 'require',
    ];

    // 添加, 修改场景
    public function sceneAdd() {
        return $this->only(['content']);
    }

    // 推荐场景
    public function sceneTop() {
        return $this->only(['is_top']);
    }

}