<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Tree;
use think\Page;
use think\Session;
use app\admin\controller\Common;

class Pages extends Common {

    public function index() {
        $data = db("page")->order(array("id" => "asc"))->select();
        foreach ($data as $key => $value) {
            $data[$key]["catname"]= db("category")->where("id=" . $value['catid'])->value("catname");
        }
        $this->assign("data", $data);
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function edit() {
        if (Request::instance()->isPost()) {
            $data = db("page")->where("id",input('id'))->find();
            $description=trim(input("description"));
            if(empty($description)){
                $description=$this->str_cut(trim(strip_tags(input('content'))),250);
            }
            $insetdata=input();
            if ($insetdata) {
                $insetdata['updatetime'] = time();
                $insetdata["username"]= Session::get('user');
                $insetdata["description"] =$description;
                if ($data) {
                    $id = db("page")->update($insetdata);
                } else {
                    $id = db("page")->insert($insetdata);
                }
                if ($id) {
                    $this->success("修改成功！");
                } else {
                    $this->error("修改失败！");
                }
            } else {
                $this->error("数据错误！");
            }
        } else {
            $data = db("page")->where("catid",input('catid'))->find();
            $catname = db("category")->where("id",input('catid'))->value("catname");
            if (!$data) {
                $data["catid"] = input('catid');
                $data["title"] = $catname;
                $data["id"] = '';
                $data["thumb"] = '';
                $data["description"] = '';
                $data["content"] = '';
            }
            $this->assign("data", $data);
            $this->assign("catname", $catname);
            return $this->fetch();
        }
    }
}