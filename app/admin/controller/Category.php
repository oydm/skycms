<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Tree;
use think\Page;
use app\admin\controller\Common;

class Category extends Common {
    public function index() {
        $result = db("category")->order(array("listorder" => "DESC"))->select();
        $tree = new Tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';

        foreach ($result as $r) {
            $r['str_manage'] = '';
            if ($r['child']==0) {
                $r['str_manage'] .= '<a href="' . Url("Admin/Category/add", array("parentid" => $r['id'])) . '">添加子栏目</a> | ';
            }

            $r['str_manage'] .= '<a href="' . Url("Admin/category/edit", array("catid" => $r['id'], "menuid" => input('menuid'))) . '">修改</a>  | <a class="J_ajax_del"  href="' . Url("Admin/category/delete", array("catid" => $r['id'], "menuid" => input('menuid'))) . '">删除</a>';
            if ($r['modelid'] == '1'||$r['modelid'] == '2') {
                $r['str_manage'] .= ' | <a class="J_ajax_url" href="' . Url("Admin/Category/change", array("catid" => $r['id'])) . '">终极属性转换</a> ';
            }

            $r['ismenu'] = $r['ismenu'] ? "显示" : "不显示";
            if ($r['child'] == '1') {
                $r['disabled'] = "是";
                $r['yesadd'] = 'blue';
            } else {
                $r['disabled'] = "否";
                $r['yesadd'] = '';
            }
            if ($r['type'] == '1') {
                $r['type'] = "内部栏目";
            } elseif ($r['type'] == '2') {
                $r['type'] = "<font color='red'>外部链接</font>";
                $r['yesadd'] = '';
            }
            if ($r['modelid'] == '1') {
                $r['model'] = "<font color='blue'>单页模块</font>";
            } elseif ($r['modelid'] == '2') {
                $r['model'] = "列表模块";
            }else{
                $r['model'] = "<font color='red'>外部链接</font>";

            }
            $array[] = $r;
        }
        $tree->init($array);
        $str = "<tr>
	<td align='center'><input name='listorders[\$id]' type='text' size='3' value='\$listorder' class='input'></td>
	<td align='center'><font color='\$yesadd'>\$id</font></td>
	<td>\$spacer\$catname</td>
                    <td align='center'>\$type</td>
                    <td align='center'>\$model</td>
                    <td align='center'>\$ismenu</td>
                    <td align='center'>\$disabled</td>
	<td align='center'>\$str_manage</td>
	</tr>";
        $categorys = $tree->get_tree(0, $str);
        $this->assign("categorys", $categorys);
        return $this->fetch();
    }

    //栏目排序
    public function listorder() {
        if (Request::instance()->isPost()) {
            $Category = db("Category");
            foreach ($_POST['listorders'] as $id => $listorder) {
                $Category->where(array('id' => $id))->update(array('listorder' => $listorder));
            }
            $this->success("栏目排序更新成功！");
        } else {
            $this->error("栏目信息提交有误！");
        }
    }

    //栏目属性转换
    public function change() {
        $catid = input('catid');
        $r = db("Category")->where(array("id" => $catid))->find();
        if ($r) {
            //栏目类型非0，不允许使用属性转换
            $count = db("Category")->where(array("parentid" => $catid))->count();
            if ($count > 0) {
                $this->error("该栏目下已经存在栏目，无法转换！");
            } else {
                $child = $r['child'] ? 0 : 1;
                $status = db("Category")->where(array("id" => $catid))->update(array("child" => $child));
                if ($status !== false) {
                    if($r['child']==1&&$r['modelid']==1){
                        $page= db("Page")->where("catid=".$catid)->find();
                        if(empty($page)){
                            $pagedata["title"]=$r['catname'];
                            $pagedata["catid"]=$catid;
                            $pagedata["id"]=$catid;
                            db("Page")->insert($pagedata);
                        }
                    }
                    $this->success("栏目属性转换成功！");
                } else {
                    $this->error("栏目属性转换失败！");
                }
            }
        } else {
            $this->error("栏目不存在！");
        }
    }

    /**
     *  删除
     */
    public function delete() {
        $id = input('catid');
        $count = db("category")->where(array("parentid" => $id))->count();
        if ($count > 0) {
            $this->error("该栏目下还有子栏目，无法删除！");
        }
        if (db("category")->delete($id)) {
            $id=db("page")->where('catid',$id)->delete();
            if($id){
                db("article")->where('catid',$id)->delete();
            }
            $this->success("删除栏目成功！");
        } else {
            $this->error("删除栏目失败！");
        }
    }

    /**
     *  编辑
     */
    public function edit() {
        $id = input('catid');
        if (Request::instance()->isPost()) {
            $data=input("post.");
            if ($data) {
                if (db("category")->update($data)) {
                    if(input('modelid')==1&&input('child')==1){
                        $page= db("Page")->where("catid=".$id)->find();
                        if(empty($page)){
                            $pagedata["title"]=inpue('catname');
                            $pagedata["catid"]=$id;
                            $pagedata["id"]=$id;
                            db("Page")->insert($pagedata);
                        }
                    }
                    $this->success("修改栏目成功！", Url("Admin/category/index"));
                } else {
                    $this->error("修改栏目失败！");
                }
            } else {
                $this->error("提交数据错误！");
            }
        } else {
            $data = db("category")->where(array("id" => $id))->find();
            if (!$data) {
                $this->error("该栏目不存在！");
            }
            $tree = new Tree();
            $parentid = input('parentid');
            $result = db("category")->select();
            foreach ($result as $r) {
                $r['selected'] = $r['id'] == $data["parentid"] ? 'selected' : '';
                if ($r['child'] == '1') {
                    $r['disabled'] = "disabled";
                } else {
                    $r['disabled'] = "";
                }
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected \$disabled>\$spacer \$catname</option>";
            $tree->init($array);
            $select_categorys = $tree->get_tree(0, $str);
            $this->assign("category", $select_categorys);
            $this->assign("data", $data);
            if($data["type"]==2){
                return $this->fetch('editurl');
            }  else {
                return $this->fetch();
            }
        }
    }


    /**
     *  添加
     */
    public function add() {
        if (Request::instance()->isPost()) {
            $data=input("post.");
            if ($data) {
                $catid=db("Category")->insertGetId($data);
                if ($catid) {
                    if(input('modelid')==1&&input('child')==1){
                        $pagedata["catid"]=$catid;
                        $pagedata["id"]=$catid;
                        $pagedata["title"]=input('catname');
                        db("Page")->insert($pagedata);
                    }
                    $this->success("增加栏目成功！", Url("Admin/Category/index"));
                } else {
                    $this->error("新增栏目失败！");
                }
            } else {
                $this->error("数据错误！");
            }
        } else {
            $tree = new Tree();
            $parentid = input('parentid');
            $result = db("category")->select();
            foreach ($result as $r) {
                $r['selected'] = $r['id'] == $parentid ? 'selected' : '';
                if ($r['child'] == '1') {
                    $r['disabled'] = "disabled";
                } else {
                    $r['disabled'] = "";
                }
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected \$disabled>\$spacer \$catname</option>";
            $tree->init($array);
            $select_categorys = $tree->get_tree(0, $str);
            $this->assign("category", $select_categorys);
            $Ca= $this->categoryinfo($parentid);
            $this->assign('parentid_modelid', $Ca['modelid']);
            return $this->fetch();
        }
    }

    /**
     * 根据栏目ID获取栏目信息
     * @param int $id 栏目ID
     * @return array 栏目信息
     */
    public function categoryinfo($id) {
        $data=db("Category")->where("id",$id)->find();
        return $data;
    }

    //添加外部链接
    public function addurl() {
        if (Request::instance()->isPost()) {
            $this->add();
        }  else {
            $tree = new Tree();
            $parentid = input('parentid');
            $result = db("category")->select();
            foreach ($result as $r) {
                $r['selected'] = $r['id'] == $parentid ? 'selected' : '';
                if ($r['child'] == '1') {
                    $r['disabled'] = "disabled";
                } else {
                    $r['disabled'] = "";
                }
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected \$disabled>\$spacer \$catname</option>";
            $tree->init($array);
            $select_categorys = $tree->get_tree(0, $str);
            $this->assign("category", $select_categorys);
            return $this->fetch();
        }
    }
}