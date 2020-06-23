<?php

namespace app\index\controller;


class Phone extends Base
{
    //
    public function index() {
        $memberInfo = model('Admin')->with('bio')->select();
        $viewData = [
            'memberInfo' => $memberInfo
        ];
        $this->assign($viewData);
        return $this->fetch();
    }
}
