<?php
namespace app\index\controller;
use think\Controller;
use think\Config;
use think\Page;

class News extends Controller{

    public function read($id){
        $data=db("article")->where('id='.$id)->find();
        $this->assign("data",$data);
        return $this->fetch();
    }



}
