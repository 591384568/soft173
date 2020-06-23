<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Article extends Model
{
    use SoftDelete;

    // 关联评论
    public function comments() {
        return $this->hasMany('Comment', 'article_id', 'id');
    }
    // 关联@人员
    public function admin() {
//        return $this->belongsTo('Admin', 'point', 'id');
        return $this->belongsTo('Admin', 'point', 'id');
    }
    // 关联用户昵称
    public function name() {
//        return $this->belongsTo('Admin', 'point', 'id');
        return $this->belongsTo('Admin', 'nickname', 'id');
    }

    public function many() {
        return $this->belongsToMany('role', 'admin', 'role_id', 'id');
    }

    // 文章添加
    public function add($data) {
        $validate = new \app\common\validate\Article();
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

    public function edit($data) {
        $validate = new \app\common\validate\Article();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }

        $articleInfo = $this->find($data['id']);
        $articleInfo->content = $data['content'];
        $articleInfo->point = $data['point'];
        $articleInfo->status = $data['status'];
        $result = $articleInfo->save();
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

}
