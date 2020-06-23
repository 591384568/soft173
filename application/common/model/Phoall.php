<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Phoall extends Model
{
    use SoftDelete;

    // 关联admin表
    public function admin() {
        return $this->belongsTo('Admin', 'user_id', 'id');
    }

    // 相册上传
    public function add($data) {

        if (!isset($_FILES['photos'])) {
            return '照片不可为空';
        }
        $name = $_FILES['photos']['name'];
        $last = substr($name,strrpos($name,'.'));
        // 列举所有图片后缀名
        $type = array('.jpeg', '.jpg', '.tiff', '.png', '.gif', '.pdf');
        // 判断上传文件是否为图片
        if (!in_array($last, $type)){
            return '只可以上传' . implode(' ', $type) . '格式图片';
        }
        $name = $data['user_id'] . date('Ymdhis') . $last;
        $address = 'static/photo_album/' . $name;
        $result = move_uploaded_file($_FILES['photos']['tmp_name'], $address);
        if (isset($result) && $result == false) {
            return '文件上传失败';
        }
        $data['photos'] = '/' . $address;
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '上传失败';
        }
    }
}
