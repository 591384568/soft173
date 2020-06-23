<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 前台路由
Route::rule('/', 'index/index/index', 'get|post');
Route::rule('login', 'index/login/login', 'get|post');
Route::rule('propic', 'index/login/propic', 'post');
Route::rule('forget', 'index/login/forget', 'get|post');
Route::rule('loginout', 'index/index/logout', 'post');
Route::rule('homeslide', 'index/index/slide', 'post');
Route::rule('homenotice', 'index/index/notice', 'post');
Route::rule('notice', 'index/notice/index', 'get|post');
Route::rule('articlelist', 'index/article/index', 'get|post');
Route::rule('articleadd', 'index/article/add', 'get|post');
Route::rule('article/[:id]', 'index/article/detail', 'get|post');
Route::rule(' ', 'index/article/getInfo', 'post');
Route::rule('articleComment', 'index/article/comment', 'post');
Route::rule('articleReplyAdd', 'index/article/reply', 'post');
Route::rule('photoAlbum', 'index/photos/index', 'get|post');
Route::rule('photoAdd', 'index/photos/add', 'get|post');
Route::rule('communication', 'index/phone/index', 'get|post');
Route::rule('personalData', 'index/person/index', 'get|post');
Route::rule('personGet', 'index/person/get', 'get|post');
Route::rule('personNotice', 'index/person/notice', 'get|post');
Route::rule('personArticle', 'index/person/article', 'get|post');
Route::rule('personPhotos', 'index/person/photos', 'get|post');
Route::rule('personpwdmod', 'index/person/pwdmod', 'get|post');
Route::rule('personUpdata', 'index/person/updata', 'get|post');


// 后台路由
Route::group('admin', function () {
    Route::rule('/', 'admin/index/login', 'get|post');
    Route::rule('register', 'admin/index/register', 'get|post');
    Route::rule('forget', 'admin/index/forget', 'get|post');
    Route::rule('vercode', 'admin/index/vercode', 'post');
    Route::rule('reset', 'admin/index/reset', 'post');
    Route::rule('index', 'admin/home/index', 'get');
    Route::rule('picmod', 'admin/home/picmod', 'post');
    Route::rule('loginout', 'admin/home/loginout', 'post');
    Route::rule('memberlist', 'admin/member/all', 'get|post');
    Route::rule('memberadd', 'admin/member/add', 'get|post');
    Route::rule('memberdel', 'admin/member/del', 'post');
    Route::rule('memberedit/[:id]', 'admin/member/edit', 'get|post');
    Route::rule('memberInfo/[:id]', 'admin/member/info', 'get|post');
    Route::rule('phoall', 'admin/phoall/index', 'get|post');
    Route::rule('phoadd', 'admin/phoall/add', 'get|post');
    Route::rule('phodel', 'admin/phoall/del', 'post');
    Route::rule('articlelist', 'admin/article/all', 'get|post');
    Route::rule('articleadd', 'admin/article/add', 'get|post');
    Route::rule('articledel', 'admin/article/del', 'post');
    Route::rule('articleedit/[:id]', 'admin/article/edit', 'get|post');
    Route::rule('commemtlist', 'admin/comment/all', 'get');
    Route::rule('commentdel', 'admin/comment/del', 'post');
    Route::rule('replylist', 'admin/reply/all', 'get|post');
    Route::rule('replydel', 'admin/reply/del', 'post');
    Route::rule('adminlist', 'admin/admin/all', 'get|post');
    Route::rule('adminstatus', 'admin/admin/status', 'post');
    Route::rule('noticelist', 'admin/notice/all', 'get|post');
    Route::rule('noticeadd', 'admin/notice/add', 'get|post');
    Route::rule('noticedel', 'admin/notice/del', 'post');
    Route::rule('noticeedit/[:id]', 'admin/notice/edit', 'get|post');
    Route::rule('logall', 'admin/log/all', 'get|post');
    Route::rule('logdel', 'admin/log/del', 'post');
});