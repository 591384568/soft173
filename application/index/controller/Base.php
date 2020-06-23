<?php

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    //
    public function initialize() {
        if (!session('?index.id')) {
            $this->redirect('index/login/login');
        }
    }
}
