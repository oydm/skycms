<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Session;
use think\Tree;
use app\admin\controller\Common;

class Menu extends Common {

	public function index() {
        $result = db("menu")->order(array("listorder" => "DESC"))->select();
        $tree = new Tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        //class="J_ajax_del";
        foreach ($result as $r) {
            $r['str_manage'] = '<a href="' . Url("Admin/Menu/add", array("parentid" => $r['id'], "menuid" => input('menuid'))) . '">添加子菜单</a> | <a href="' . Url("Admin/Menu/edit", array("id" => $r['id'], "menuid" => input('menuid'))) . '">修改</a>  | <a class="J_ajax_del"  href="' . Url("Admin/Menu/delete", array("id" => $r['id'], "menuid" => input('menuid'))) . '">删除</a>';
            $r['ismenu'] = $r['ismenu'] ? "显示" : "不显示";
            if($r['type']==3){
                $r['type']="菜单+权限验证";
            }elseif($r['type']==2){
                 $r['type']="只为权限验证";
            }elseif($r['type']==1){
                 $r['type']="只为菜单";
            }
            $array[] = $r;
        }

        $tree->init($array);
        $str = "<tr>
                <td align='center'><input name='listorders[\$id]' type='text' size='3' value='\$listorder' class='input'></td>
                <td>\$id</td>
                <td>\$spacer\$title</td>
                                <td>\$name</td>
                                <td>\$condition</td>
                                <td>\$type</td>
                                <td>\$ismenu</td>
                <td>\$str_manage</td>
                </tr>";
        $categorys = $tree->get_tree(0, $str);
        $this->assign("categorys", $categorys);
        return $this->fetch();
    }


    /**
     *  添加菜单
     */
    public function add() {
         if (Request::instance()->isPost()) {
            $data=input();
            if ($data) {
                if (db("menu")->insert($data) !== false) {
                    $this->success("添加成功!",Url("Admin/Menu/index"));
                } else {
                    $this->error("添加失败!");
                }
            }else {
                $this->error("添加失败!");
            }
        } else {
            $tree = new Tree();
            $parentid =  input('parentid');
            $result = db("menu")->select();
            foreach ($result as $r) {
                $r['selected'] = $r['id'] == $parentid ? 'selected' : '';
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected>\$spacer \$title</option>";
            $tree->init($array);
            $select_categorys = $tree->get_tree(0, $str);
            $this->assign("select_categorys", $select_categorys);
            return $this->fetch();
        }
    }

  /**
     *  删除
     */
    public function delete() {
        $id = input('id');
        $count = db("menu")->where(array("parentid" => $id))->count();
        if ($count > 0) {
            $this->error("该菜单下还有子菜单，无法删除！");
        }
        if (db("menu")->delete($id)) {
            $this->success("删除菜单成功!");
        } else {
            $this->error("删除失败!");
        }
    }

    /**
     *  编辑
     */
    public function edit() {
        if (Request::instance()->isPost()) {
            $data=input();
            if ($data) {
                if (db("menu")->where('id', input('post.id'))->update($data) !== false) {
                    $this->success("更新成功!",Url("Admin/Menu/index"));
                } else {
                    $this->error("更新失败!");
                }
            }else {
                $this->error("更新失败!");
            }
        } else {
            $tree = new Tree();
            $id = input('id');
            $rs = db("menu")->where(array("id" => $id))->find();
            $result = db("menu")->select();
            foreach ($result as $r) {
                $r['selected'] = $r['id'] == $rs['parentid'] ? 'selected' : '';
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected>\$spacer \$title</option>";
            $tree->init($array);
            $select_categorys = $tree->get_tree(0, $str);
            $this->assign("data", $rs);
            $this->assign("select_categorys", $select_categorys);
            return $this->fetch();
        }
    }

    //排序
    public function listorders() {
        $ids = $_POST['listorders'];
        foreach ($ids as $key => $r) {
            $data['listorder'] = $r;
            $status=db("Menu")->where(array('id' => $key))->update($data);
        }
        if ($status!== false) {
            $this->success("排序更新成功!");
        } else {
            $this->error("排序更新失败!");
        }
    }
    
     //常用菜单
    public function public_changyong() {
        //角色ID
        $id = Session::get('group_id');
        $userid = Session::get('userid');
        if (!$id||!$userid) {
            $this->error("参数错误！");
        }
        $where["status"]=1;
        $where["type"]=array('in',"2,3");
        $rules='';
        if($id!=1){
            $rules=db('auth_group')->where("id=".$id)->value('rules');
            $rules= explode(',',$rules);
            $where["id"]=array('in',$rules);
        }
        $where["parentid"]=0;
        $result = db("menu")->where($where)->order(array("listorder" => "DESC"))->select();
        $menu=array();
        foreach ($result as $n => $t) {
            $menu[$n]['id']=$t['id'];
            $menu[$n]['title']=$t['title'];
            $menu[$n]['checked']=($this->is_checked($t["id"], $userid)) ? ' checked' : '';
            $child_where["parentid"]=$t['id'];
            $child_where["status"]=1;
            $child_where["type"]=array('in',"2,3");
            if($id!=1) {
                $child_where["id"] = array('in', $rules);
            }
            $child = db("menu")->where($child_where)->order(array("listorder" => "DESC"))->select();
            foreach ($child as $k => $r) {
                $menu[$n]['child'][$k]['id'] = $r['id'];
                $menu[$n]['child'][$k]['title'] = $r['title'];
                $menu[$n]['child'][$k]['checked'] = ($this->is_checked($r["id"], $userid)) ? ' checked' : '';
            }
        }

        $this->assign("menu", $menu);
        $this->assign("userid", $userid);
        return $this->fetch();
    }

    function chanyong_edit(){
        if (Request::instance()->isPost()) {
            $menuid=$_POST["priv_roleid"];
            $data["rules"]=implode(",",$menuid);
            $userid = Session::get('userid');
            $auth=db("user_chanyong")->where(array("userid" => $userid))->value('rules');
            if($auth==''||!$auth){
                $insertdata['userid']=$userid;
                $insertdata['rules']=$data["rules"];
                $result = db("user_chanyong")->insert($insertdata);
                if ($result) {
                    $this->success('设置成功!',Url("Admin/Menu/public_changyong"));
                } else {
                    $this->error('设置失败！');
                }
            }
            if($auth==$data["rules"]){
                $this->success('设置成功!',Url("Admin/Menu/public_changyong"));
            }
            $result = db("user_chanyong")->where(array("userid" => $userid))->update($data);
            if ($result) {
                $this->success('设置成功!',Url("Admin/Menu/public_changyong"));
            } else {
                $this->error('设置失败！');
            }
        }else{
            $this->error('请求错误！');
        }
    }


    /**
     *  检查指定菜单是否有权限
     * @param int $menuid 权限ID
     * @param int $userid
     */
    protected function is_checked($menuid, $userid) {
        $data = db("user_chanyong")->where(array("userid" => $userid))->value('rules');
        $data=  explode(",", $data);
        $info = in_array($menuid, $data);
        if ($info) {
            return true;
        } else {
            return false;
        }
    }

    //后台框架首页菜单搜索
    public function find() {
        $keyword = input('get.keyword');
        if (!$keyword) {
            $this->error("请输入需要搜索的关键词！");
        }
        $where = array();
        $where['title'] = array("LIKE", "%$keyword%");
        $where['status'] = array("EQ", 1);
        $where['ismenu'] = array("EQ", 1);
        $where['type'] = array('in',"1,3");
        $data = db("Menu")->where($where)->select();

        $this->assign("data", $data);
        $this->assign("keyword", $keyword);
        return $this->fetch();
    }
}