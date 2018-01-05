<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Page;
use app\admin\controller\Common;

class Expand extends Common {
    /*
     * 地区管理
     */
    public function area() {
        $parentid =input('parentid');
        if($parentid){
            $where["parentid"] = $parentid;
        }else{
            $where=array();
        }
        $count = db("area")->where($where)->count();
        $page = new Page($count, 15);
        $data = db("area")->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array("id" => "asc"))->select();
        $show = $page->show();
        $this->assign("data", $data);
        $this->assign("Page", $show);
        return $this->fetch();
    }

    /*
     * 地区添加
     */

    public function areaadd() {
        if (Request::instance()->isPost()) {
            $arrparentid = input("arrparentid");
            if(strstr($arrparentid, ',')){
                $tmp=explode(",", $arrparentid);
                $parentid = end($tmp);
            }else{
                $parentid = 0;
            }
            $data=input();
            $data["arrparentid"] = "," . $arrparentid . ",";
            $data["parentid"] = $parentid;
            $catid = db("area")->insert($data);
            if ($catid) {
                $this->success("新增地区成功！", Url("Admin/Expand/area", array("parentid" => $parentid)));
            } else {
                $this->error("新增地区失败！");
            }
        } else {
            $parentid =input("parentid");
            if($parentid){
                $where['id']=$parentid;
            }else{
                $where=array();
            }
            $arrparentid = db("area")->where($where)->value("arrparentid");
            $this->assign("arrparentid", $arrparentid);
            return $this->fetch();
        }
    }

    /*
     * 地区修改
     */

    public function areaedit() {
        if (Request::instance()->isPost()) {
            $arrparentid = input("arrparentid");
            if(strstr($arrparentid, ',')){
                $tmp=explode(",", $arrparentid);
                $parentid = end($tmp);
            }else{
                $parentid = 0;
            }
            $data=input();
            $data["arrparentid"] = "," . $arrparentid . ",";
            $data["parentid"] = $parentid;
            $catid = db("area")->update($data);
            if ($catid) {
                $this->success("修改地区成功！", Url("Admin/Expand/area", array("parentid" => $parentid)));
            } else {
                $this->error("修改地区失败！");
            }
        } else {
            $data = db("area")->where("id=" . input("id"))->find();
            $this->assign("data", $data);
            return $this->fetch();
        }
    }

    /**
     *  地区删除
     */
    public function areadel() {
        $id = input('id');
        if (db("area")->delete($id)) {
            $this->success("删除地区成功！");
        } else {
            $this->error("删除地区失败！");
        }
    }

    /**
     *  地区排序
     */
    public function arealistorder() {
        $ids = $_POST['listorders'];
        foreach ($ids as $key => $r) {
            $data['listorder'] = $r;
            $status = db("area")->where(array('id' => $key))->update($data);
        }
        if ($status !== false) {
            $this->success("排序更新成功！");
        } else {
            $this->error("排序更新失败！");
        }
    }

    /*
     * ajax获取子地区列表
     */

    function getchildren() {
        $parentid = input('id');
        $result = db("area")->where("parentid=" . $parentid)->select();
        $result = json_encode($result);
        echo $result;
    }

    /*
     * 联动菜单
     */

    public function index() {
        $catid = input('catid');
        if (empty($catid)) {
            $count = db("linkagetype")->count();
            $page = new Page($count, 15);
            $data = db("linkagetype")->limit($page->firstRow . ',' . $page->listRows)->order(array("id" => "desc"))->select();
            $show = $page->show();
            $this->assign("data", $data);
            $this->assign("Page", $show);
            return $this->fetch();
        } else {
            $count = db("linkage")->where("catid=".$catid)->count();
            $page = new Page($count, 15);
            $data = db("linkage")->where("catid=".$catid)->limit($page->firstRow . ',' . $page->listRows)->order(array("id" => "desc"))->select();
            $show = $page->show();
            $this->assign("data", $data);
            $this->assign("Page", $show);
            return $this->fetch('linkage');
        }
    }

    /*
     * 添加菜单
     */

    public function add() {
        if (Request::instance()->isPost()) {
            if(input("catid")==""){
                $this->error("请选择类型！");
            }
            if(input("name")==""){
                $this->error("请输入名称！");
            }
            if(input("value")==""){
                $this->error("请输入值！");
            }
            $data=input();
            $catid = db("linkage")->insert($data);
            if ($catid) {
                $this->success("新增菜单成功！", Url("Admin/Expand/add", array("catid" => input("catid"))));
            } else {
                $this->error("新增菜单失败！");
            }
        } else {
            $catid= input("catid");
            $cat = db("linkagetype")->select();
            $this->assign("cat", $cat);
            $this->assign("catid", $catid);
            return $this->fetch();
        }
    }

    /*
     * 修改菜单
     */

    public function edit() {
        if (Request::instance()->isPost()) {
            if(input("catid")==""){
                $this->error("请选择类型！");
            }
            if(input("name")==""){
                $this->error("请输入名称！");
            }
            if(input("value")==""){
                $this->error("请输入值！");
            }
            $data=input();
            $catid = db("linkage")->update($data);
            if ($catid) {
                $this->success("修改菜单成功！", Url("Admin/Expand/index", array("catid" => input("catid"))));
            } else {
                $this->error("修改菜单失败！");
            }
        } else {
            $id= input('id');
            $cat = db("linkagetype")->select();
            $data=db("linkage")->where("id=".$id)->find();
            $this->assign("cat", $cat);
            $this->assign("catid", $data["catid"]);
            $this->assign("data", $data);
            return $this->fetch();
        }
    }

    /*
     * 删除菜单
     */

    public function del() {
        $id = input('id');
        if (db("linkage")->delete($id)) {
            $this->success("删除菜单成功！");
        } else {
            $this->error("删除菜单失败！");
        }
    }


    /*
     * 菜单排序
     */

    public function listorder() {
        $ids = $_POST['listorders'];
        foreach ($ids as $key => $r) {
            $data['listorder'] = $r;
            $status = db("linkage")->where(array('id' => $key))->update($data);
        }
        if ($status !== false) {
            $this->success("排序更新成功！");
        } else {
            $this->error("排序更新失败！");
        }
    }

    /*
     * 联动菜单类型
     */

    public function type() {
        $where=array();
        $count = db("linkagetype")->where($where)->count();
        $page = new Page($count, 15);
        $data = db("linkagetype")->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array("id" => "desc"))->select();
        $show = $page->show();
        $this->assign("data", $data);
        $this->assign("Page", $show);
        return $this->fetch();
    }

    /*
     * 添加菜单类型
     */

    public function typeadd() {
        if (Request::instance()->isPost()) {
            if(input("catname")==""){
                $this->error("请输入名称！");
            }
            $catid = db("linkagetype")->insert(input());
            if ($catid) {
                $this->success("增加菜单类型成功！", Url("Admin/Expand/type"));
            } else {
                $this->error("增加菜单类型失败！");
            }
        } else {
            return $this->fetch();
        }
    }

    /*
     * 修改菜单类型
     */

    public function typeedit() {
        if (Request::instance()->isPost()) {
            if(input("catname")==""){
                $this->error("请输入名称！");
            }
            $catid = db("linkagetype")->update(input());
            if ($catid) {
                $this->success("修改菜单类型成功！", Url("Admin/Expand/type"));
            } else {
                $this->error("修改菜单类型失败！");
            }
        } else {
            $id= input('id');
            $data=db("linkagetype")->where("id=".$id)->find();
            $this->assign("data", $data);
            return $this->fetch();
        }
    }

    /*
     * 删除菜单类型
     */

    public function typedel() {
        $id = input('id');
        $count = db("linkage")->where(array("catid" => $id))->count();
        if ($count > 0) {
            $this->error("该类型下还有子菜单，无法删除！");
        }
        if (db("linkagetype")->delete($id)) {
            $this->success("删除菜单类型成功！");
        } else {
            $this->error("删除菜单类型失败！");
        }
    }

}