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
// 模块配置文件

return [

	// +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------
	 'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'think_admin_',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],

    'captcha'  => [
        'seKey'    => 'wemepi.com',
        // 验证码加密密钥
        'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',
        // 验证码字符集合
        'expire'   => 1800,
        // 验证码过期时间（s）
        'useZh'    => false,
        // 使用中文验证码
         'useImgBg' => false,
        // 使用背景图片
        'fontSize' => 50,
        // 验证码字体大小(px)
        'useCurve' => true,
        // 是否画混淆曲线
        'useNoise' => false,
        // 是否添加杂点
        'imageH'   => 100,
        // 验证码图片高度
        'imageW'   => 400,
        // 验证码图片宽度
        'length'   => 4,
        // 验证码位数
        'fontttf'  => '',
        // 验证码字体，不设置随机获取
        'bg'       => [243, 251, 254],
        // 背景颜色
        'reset'    => true,
        // 验证成功后是否重置
    ],

    //过滤规则,请书写小写
    'AUTH_Filter'=>array(
        'admin/index/index',
        'admin/index/main',
        'admin/article/home',
        'admin/index/message',
        'admin/menu/public_changyong',
        'admin/index/deletecache',
    ),

    /*Auth权限配置*/
    'AUTH_CONFIG'=>array(
        'AUTH_ON' => true, //认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP' => 'weme_auth_group', //用户组数据表名
        'AUTH_GROUP_ACCESS' => 'weme_auth_group_access', //用户组明细表
        'AUTH_RULE' => 'weme_menu', //权限规则表
        'AUTH_USER' => 'weme_user'//用户信息表
    ),

    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl'  => APP_PATH . 'admin'. DS .'view'. DS .'Common'. DS . 'success.php',
    'dispatch_error_tmpl'    => APP_PATH . 'admin'. DS .'view'. DS .'Common'. DS . 'error.php',
];
