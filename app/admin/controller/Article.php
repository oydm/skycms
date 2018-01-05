<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Tree;
use think\Page;
use think\Session;
use app\admin\controller\Common;

class Article extends Common {

    public function main(){
        $result = db("category")->where(array("parentid"=>0))->order(array("listorder" => "DESC"))->select();
        foreach($result as $key=>$rs){
            if($rs['modelid']==1){
                $result[$key]['url']=url("admin/pages/edit",array('catid'=>$rs['id']));
            }elseif($rs['modelid']==2){
                $result[$key]['url']=url("admin/article/index",array('catid'=>$rs['id']));
            }
            $childs=db("category")->where(array("parentid"=>$rs['id']))->order(array("listorder" => "DESC"))->select();
            foreach($childs as $key2=>$rs2){
                if($rs['modelid']==1){
                    $childs[$key2]['url']=url("admin/page/edit",array('catid'=>$rs2['id']));
                }elseif($rs['modelid']==2){
                    $childs[$key2]['url']=url("admin/article/index",array('catid'=>$rs2['id']));
                }
            }
            $result[$key]['childs']=$childs;
        }
        $this->assign("result", $result);
        return $this->fetch();
    }

    public function home(){
        return $this->fetch();
    }

    public function index() {
        $status = input("status");
        //搜索字段
        $searchtype =input('searchtype');
        $where = array();
            //添加开始时间
            $start_time = input('start_time');
            if (!empty($start_time)) {
                $start_time = strtotime($start_time);
                $where["inputtime"] = array("EGT", $start_time);
            }
            //添加结束时间
            $end_time = input('end_time');
            if (!empty($end_time)) {
                $end_time = strtotime($end_time);
                $where["inputtime"] = array("ELT", $end_time);
            }
            if ($end_time > 0 && $start_time > 0) {
                $where['inputtime'] = array(array('EGT', $start_time), array('ELT', $end_time));
            }
            //栏目
            $catid = input('catid');
            if (!empty($catid)) {
                $where["catid"] = array("EQ", $catid);
            }
            //搜索关键字
            $keyword = urldecode(input('keyword'));
            if (!empty($keyword)) {
                $type_array = array('title', 'description', 'username');
                if ($searchtype < 3) {
                    $searchtype = $type_array[$searchtype];
                    $where[$searchtype] = array("LIKE", "%{$keyword}%");
                } elseif ($searchtype == 3) {
                    $where["id"] = array("EQ", (int) $keyword);
                }
            }
            //状态
            if ($status != "" && $status != null) {
                $where["status"] = array("EQ", $status);
            }
        $count = db("Article")->where($where)->count();
        $page = new Page($count, 10);
        $data = db("Article")->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array("id" => "desc"))->select();
        foreach ($data as $k => $r) {
            $data[$k]["sortitle"] = $this->str_cut($r["title"], 30);
            $data[$k]["catname"] = db("category")->where("id=" . $r["catid"])->value("catname");
        }
        $show = $page->show();
        $this->assign("data", $data);
        $this->assign("Page", $show);
        $this->assign("status", $status);
        $this->assign("catid", $catid);
        $this->assign("searchtype", $searchtype);
        return $this->fetch();
    }

    /**
     * 编辑内容
     */
    public function edit() {
        if (Request::instance()->isPost()) {
            $description = trim(input("description"));
            //$imglist=  implode("|", input("imglist"));
            if (empty($description)) {
                $description = $this->str_cut(trim(strip_tags(input('content'))), 250);
            }
            $data=input();
            if(!isset($data['catid'])||$data['catid']==''||$data['catid']==0){
                $this->error("请选择栏目！");
            }
            if(!isset($data['title'])||$data['title']==''){
                $this->error("标题不能为空！");
            }
            if ($data) {
                //$data["imglist"] = $imglist;
                $data["inputtime"] = time();
                $data["username"] =Session::get('user');
                $data["description"] = $description;
                $id = db("Article")->update($data);
                if (!empty($id)) {
                    $this->success("修改内容成功！", Url("Admin/Article/index",array("catid"=>$data['catid'])));
                } else {
                    $this->error("修改内容失败！");
                }
            } else {
                $this->error("数据错误！");
            }
        } else {
            $id= input('id');
            if (empty($id)) {
                $this->error("文章ID参数错误");
            }
            $data=db("Article")->where("id",$id)->find();
            $catname = db("category")->where("id",$data['catid'])->value("catname");
            $this->assign("catname", $catname);
            $this->assign("data", $data);
            $this->assign("imglist", '');
            return $this->fetch();
        }
    }

    /*
     * 添加内容
     */

    public function add() {
        if (Request::instance()->isPost()) {
            $description = trim(input("description"));
            //$imglist=  implode("|", input("imglist"));
            if (empty($description)) {
                $description = $this->str_cut(trim(strip_tags(input('content'))), 250);
            }
            $data=input();
            if(!isset($data['catid'])||$data['catid']==''||$data['catid']==0){
                $this->error("请选择栏目！",Url("Admin/Article/add",array("catid"=>input('catid'))));
            }
            if(!isset($data['title'])||$data['title']==''){
                $this->error("标题不能为空！",Url("Admin/Article/add",array("catid"=>input('catid'))));
            }
            if ($data) {
                //$data["imglist"] = $imglist;
                $data["inputtime"] = time();
                $data["username"] =Session::get('user');
                $data["description"] = $description;

                $id = db("Article")->insert($data);
                if (!empty($id)) {
                    $this->success("新增内容成功！", Url("Admin/Article/index",array("catid"=>input('catid'))));
                } else {
                    $this->error("新增内容失败！",Url("Admin/Article/add",array("catid"=>input('catid'))));
                }
            } else {
                $this->error("数据错误！",Url("Admin/Article/add",array("catid"=>input('catid'))));
            }
        } else {
            $catid = input('catid');
            $catname = db("category")->where("id",$catid)->value("catname");
            $this->assign("catname", $catname);
            $this->assign("catid", $catid);
            return $this->fetch();
        }
    }



    /**
     *  删除
     */
    public function delete() {
        $id = input('id');
        if (db("Article")->delete($id)) {
            $this->success("删除内容成功！");
        } else {
            $this->error("删除内容失败！");
        }
    }

    /*
     * 删除内容
     */

    public function del() {
        if (Request::instance()->isPost()) {
            if (empty($_POST['ids'])) {
                $this->error("没有信息被选中！");
            }
            foreach ($_POST['ids'] as $id) {
                db("Article")->delete($id);
            }
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }

    /*
     * 内容审核
     */

    public function review() {
        $data['status'] = 1;
        if (Request::instance()->isPost()) {
            if (empty($_POST['ids'])) {
                $this->error("没有信息被选中！");
            }
            foreach ($_POST['ids'] as $id) {
                db("article")->where(array("id" => $id))->update($data);
            }
            $this->success("审核成功！");
        } else {
            $this->error("审核失败！");
        }
    }

    /*
     * 内容取消审核
     */

    public function unreview() {
        $data['status'] = 0;
        if (Request::instance()->isPost()) {
            if (empty($_POST['ids'])) {
                $this->error("没有信息被选中！");
            }
            foreach ($_POST['ids'] as $id) {
                db("article")->where(array("id" => $id))->update($data);
            }
            $this->success("审核成功！");
        } else {
            $this->error("审核失败！");
        }
    }

    /*
     * 内容推荐
     */

    public function pushs() {
        $data['type'] = 1;
        if (Request::instance()->isPost()) {
            if (empty($_POST['ids'])) {
                $this->error("没有信息被选中！");
            }
            foreach ($_POST['ids'] as $id) {
                db("article")->where(array("id" => $id))->update($data);
            }
            $this->success("推荐成功！");
        } else {
            $this->error("推荐成功！");
        }
    }

    /*
     * 内容推荐
     */

    public function unpushs() {
        $data['type'] = 0;
        if (Request::instance()->isPost()) {
            if (empty($_POST['ids'])) {
                $this->error("没有信息被选中！");
            }
            foreach ($_POST['ids'] as $id) {
                db("article")->where(array("id" => $id))->update($data);
            }
            $this->success("取消推荐成功！");
        } else {
            $this->error("取消推荐失败！");
        }
    }

    /*
     * 内容排序
     */

    public function listorder() {
        $ids = $_POST['listorders'];
        foreach ($ids as $key => $r) {
            $data['listorder'] = $r;
            $status = db("Article")->where(array('id' => $key))->update($data);
        }
        if ($status !== false) {
            $this->success("排序更新成功！");
        } else {
            $this->error("排序更新失败！");
        }
    }

}