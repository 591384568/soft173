<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Comment extends Model
{
    // 软删除
    use SoftDelete;

    // 关联文章
    public function article() {
        return $this->belongsTo('Article', 'article_id', 'id');
    }

    // 关联用户
    public function admin() {
        return $this->belongsTo('admin', 'member_id', 'id');
    }

    // 关联评论
    public function reply() {
        return $this->belongsTo('Reply', 'id', 'comment_id');
    }

    // 用户评论
    public function add($data) {
        $validate = new \app\common\validate\Comment();
        if (!$validate->scene('Add')->check($data)) {
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
