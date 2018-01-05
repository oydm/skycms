<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

/*return [
    '[user]'     => [
        ':name' => ['index/User/hello', ['method' => 'get']],
    ],

];
*/

use think\Route;
Route::get('news/:id','News/read'); // 定义GET请求路由规则

//Route::rule('blog/:id','index/User/blog');
//Route::rule(['user_hello','user/:name'],'index/User/hello');
/*

Route::post('new/:id','News/update'); // 定义POST请求路由规则
Route::put('new/:id','News/update'); // 定义PUT请求路由规则
Route::delete('new/:id','News/delete'); // 定义DELETE请求路由规则
Route::any('new/:id','News/read'); // 所有请求都支持的路由规则
Route::rule('new/:id','News/update','POST');	//定义get请求支持的路由规则
Route::rule('new/:id','News/read','GET|POST');	//定义get和post请求支持的路由规则

//批量注册路由
Route::rule(['new/:id'=>'News/read','blog/:name'=>'Blog/detail']);
Route::get(['new/:id'=>'News/read','blog/:name'=>'Blog/detail']);
Route::post(['new/:id'=>'News/update','blog/:name'=>'Blog/detail']);

//可选定义
Route::rule('blog/:year/[:month]','index/User/blog');

*/