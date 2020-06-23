<?php
/**
 * Created by PhpStorm.
 * User: X_Xhcy
 * Date: 2020/4/29
 * Time: 10:14
 */

namespace app\common\validate;

use think\Validate;

class Comment extends Validate
{
    protected $rule = [
        'article_id|文章ID' => 'require',
        'member_id|用户ID'  => 'require',
        'content|留言信息'    => 'require'
    ];

    public function sceneAdd() {
        return $this->only(['article_id', 'member_id', 'content']);
    }

}