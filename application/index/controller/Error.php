<?php
namespace app\index\controller;

use think\Request;

class Error
{
    public function index()
    {
        $this->error('页面错误！');
    }
}