<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Tree;
use think\Page;
use app\admin\controller\Common;

class Link extends Common {

    public function index() {
        $search =input("search");
        $where = array();
        $status=input("status");
        $catid =input("catid");
        if (!empty($search)) {
            //栏目
            if (!empty($catid)) {
                $where["catid"] = array("EQ", $catid);
            }
            //状态
            if ($status != "" && $status != null) {
                $where["status"] = array("EQ", $status);
            }
        }
        $count = db("Link")->where($where)->count();
        $page=new Page($count,10);
        $data = db("Link")->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array("id" => "desc"))->select();
        foreach ($data as $k => $r) {
            $data[$k]["sortitle"] = $r["title"];
            $data[$k]["catname"] = db("linktype")->where("id=" . $r["catid"])->value("catname");
        }
        $show = $page->show();
        $this->assign("data", $data);
        $this->assign("Page", $show);
        $tree = new Tree();
        $result = db("linktype")->select();
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $catid ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$catname</option>";
        $tree->init($array);
        $select_categorys = $tree->get_tree(0, $str);
        $this->assign("category", $select_categorys);
        $this->assign("status", $status);
        return $this->fetch();
    }

    /**
     * 编辑内容
     */
    public function edit() {
        if (Request::instance()->isPost()) {
            $data=input();
            if(!isset($data['catid'])||$data['catid']==''||$data['catid']==0){
                $this->error("类型不能为空！");
            }
            if(!isset($data['title'])||$data['title']==''||$data['title']==0){
                $this->error("标题不能为空！");
            }
            if ($data) {
                $data['updatetime'] = time();
                if (db("Link")->update($data)) {
                    $this->success('修改成功！',Url("Admin/Link/index"));
                } else {
                    $this->error("修改失败！");
                }
            } else {
                $this->error("修改失败！");
            }
        } else {
            $id= input('id');
            if (empty($id)) {
                $this->error("链接ID参数错误！");
            }
            $data=db("Link")->where("id=".$id)->find();
            $tree = new Tree();
            $result = db("linktype")->select();
            foreach ($result as $r) {
                $r['selected'] = $r['id'] == $data['catid'] ? 'selected' : '';
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected>\$spacer \$catname</option>";
            $tree->init($array);
            $select_categorys = $tree->get_tree(0, $str);
            $this->assign("category", $select_categorys);
            $this->assign("data", $data);
            return $this->fetch();
        }
    }

    /*
     * 添加内容
     */

    public function add() {
        if (Request::instance()->isPost()) {
            $data=input();
            if(!isset($data['catid'])||$data['catid']==''||$data['catid']==0){
                $this->error("类型不能为空！");
            }
            if(!isset($data['title'])||$data['title']==''||$data['title']==0){
                $this->error("标题不能为空！");
            }
            if ($data) {
                $data['inputtime'] = time();
                if (db("Link")->insert($data)) {
                    $this->success('添加成功！',Url("Admin/Link/index"));
                } else {
                    $this->error('添加失败！');
                }
            } else {
                $this->error('添加失败！');
            }
        } else {
            $tree = new Tree();
            $result = db("linktype")->select();
            foreach ($result as $r) {
                $r['selected'] = $r['id'] == '';
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected>\$spacer \$catname</option>";
            $tree->init($array);
            $select_categorys = $tree->get_tree(0, $str);
            $this->assign("category", $select_categorys);
            return $this->fetch();
        }
    }

    /**
     *  删除
     */
    public function delete() {
        $id = input('id');
        if (db("Link")->delete($id)) {
            $this->success('删除链接成功！');
        } else {
            $this->error('删除失败！');
        }
    }

    /*
     * 删除内容
     */

    public function del() {
        if (Request::instance()->isPost()) {
            if (empty($_POST['ids'])) {
                $this->error('没有信息被选中！');
            }
            foreach ($_POST['ids'] as $id) {
                db("Link")->delete($id);
            }
            $this->success('删除链接成功！');
        } else {
            $this->error('删除失败！');
        }
    }

    /*
     * 内容审核
     */

    public function review() {
        $data['status'] = 1;
        if (Request::instance()->isPost()) {
            if (empty($_POST['ids'])) {
                $this->error('没有信息被选中！');
            }
            foreach ($_POST['ids'] as $id) {
                db("Link")->where(array("id" => $id))->update($data);
            }
            $this->success('审核成功！');
        } else {
            $this->error('审核失败！');
        }
    }

    /*
     * 内容取消审核
     */

    public function unreview() {
        $data['status'] = 0;
        if (Request::instance()->isPost()) {
            if (empty($_POST['ids'])) {
                $this->error('没有信息被选中！');
            }
            foreach ($_POST['ids'] as $id) {
                db("Link")->where(array("id" => $id))->update($data);
            }
            $this->success('取消审核成功！');
        } else {
            $this->error('取消审核失败！');
        }
    }


    /*
     * 内容排序
     */

    public function listorder() {
        $ids = $_POST['listorders'];

        foreach ($ids as $key => $r) {
            $data['listorder'] = $r;
            $status = db("Link")->where(array('id' => $key))->update($data);
        }
        if ($status !== false) {
            $this->success('排序更新成功！');
        } else {
            $this->error('排序更新失败！');
        }
    }

    public function type() {
        $result = db("linktype")->order(array("listorder" => "DESC"))->select();
        $tree = new Tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        foreach ($result as $r) {
            $r['str_manage'] = '<a href="' . Url("Admin/link/typeadd", array("parentid" => $r['id'])) . '">添加子类</a> | ';
            $r['str_manage'] .= '<a href="' . Url("Admin/link/typeedit", array("catid" => $r['id'], "menuid" => input('menuid'))) . '">修改</a>  | <a class="J_ajax_del"  href="' . Url("Admin/link/typedel", array("catid" => $r['id'], "menuid" => input('menuid'))) . '">删除</a>';
            $array[] = $r;
        }
        $tree->init($array);
        $str = "<tr>
	<td align='center'><input name='listorders[\$id]' type='text' size='3' value='\$listorder' class='input'></td>
	<td align='center'>\$id</td>
	<td>\$spacer\$catname</td>
	<td align='center'>\$str_manage</td>
	</tr>";
        $categorys = $tree->get_tree(0, $str);
        $this->assign("categorys", $categorys);
        return $this->fetch();
    }

    /**
     *  删除
     */
    public function typedel() {
        $id = input('catid');
        $count = db("linktype")->where(array("parentid" => $id))->count();
        if ($count > 0) {
            $this->error('该栏目下还有子类型，无法删除！');
        }
        if (db("linktype")->delete($id)) {
            $this->success("删除类型成功!");
        } else {
            $this->error('删除类型失败！');
        }
    }

    /**
     *  添加类型
     */
    public function typeadd() {
        if (Request::instance()->isPost()) {
            $data=input();
            if ($data) {
                $catid=db("linktype")->insert($data);
                if ($catid) {
                    $this->success("增加类型成功!",Url("Admin/link/type"));
                } else {
                    $this->error('增加类型失败！');
                }
            } else {
                $this->error('增加类型失败！');
            }
        } else {
            $tree = new Tree();
            $parentid = input('parentid');
            $result = db("linktype")->select();
            foreach ($result as $r) {
                $r['selected'] = $r['id'] == $parentid ? 'selected' : '';
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected >\$spacer \$catname</option>";
            $tree->init($array);
            $select_categorys = $tree->get_tree(0, $str);
            $this->assign("category", $select_categorys);
            return $this->fetch();
        }
    }

    /**
     *  编辑类型
     */
    public function typeedit() {
        $id = input('catid');
        if (Request::instance()->isPost()) {
            $data=input();
            if ($data) {
                $catid=db("linktype")->update($data);
                if ($catid) {
                    $this->success("修改类型成功!",Url("Admin/link/type"));
                } else {
                    $this->error('修改类型失败！');
                }
            } else {
                $this->error('修改类型失败！');
            }
        } else {
            $data = db("linktype")->where(array("id" => $id))->find();
            if (!$data) {
                $this->error("该栏目不存在！");
            }
            $tree = new Tree();
            $parentid =input('parentid');
            $result = db("linktype")->select();
            foreach ($result as $r) {
                $r['selected'] = $r['id'] == $data["parentid"] ? 'selected' : '';
                $r['disabled'] = $r['id'] == $data["id"] ? 'disabled' : '';
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected \$disabled>\$spacer \$catname</option>";
            $tree->init($array);
            $select_categorys = $tree->get_tree(0, $str);
            $this->assign("category", $select_categorys);
            $this->assign("data", $data);
            return $this->fetch();
        }
    }

    //类型排序
    public function typelistorder() {
        if (Request::instance()->isPost()) {
            $Category = db("linktype");
            foreach ($_POST['listorders'] as $id => $listorder) {
                $Category->where(array('id' => $id))->update(array('listorder' => $listorder));
            }
            $this->success("排序更新成功!");
        } else {
            $this->error("排序更新失败！");
            return json(['state'=>0,'referer'=>'','info'=>'排序更新失败！']);
        }
    }
}