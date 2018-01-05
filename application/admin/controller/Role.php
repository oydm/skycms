<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Session;
use think\Tree;
use app\admin\controller\Common;

class Role extends Common {

    public function index() {
       $data = db("auth_group")->order(array("id" => "asc"))->select();
        $this->assign("data", $data);
        return $this->fetch();
    }
    
    /**
     *  删除
     */
    public function delete() {
        $id = input('id');
        if ($id == 1) {
            $this->error('超级管理员角色不能被删除');
        }
        $status =  db("auth_group")->delete($id);
        if ($status) {
            $this->success('删除成功!',Url("Admin/Role/index"));
        } else {
            $this->error('删除失败');
        }
    }

    /**
     *  添加
     */
    public function add() {
        if (Request::instance()->isPost()) {
            $data=input();
            if ($data) {
                if (db("auth_group")->insert($data) !== false) {
                    $this->success('添加角色成功！',Url("Admin/Role/index"));
                } else {
                    $this->error('添加失败!');
                }   
            }else {
                $this->error('添加失败!');
            }
        } else {
            return $this->fetch();
        }
    }



     /**
     *  编辑
     */
    public function edit() {
       $id = input('id');
        if ($id == 1) {
            $this->error("超级管理员角色不能被修改！");
        }
         if (Request::instance()->isPost()) {
            $data=input();
            if ($data) {
                if (db("auth_group")->update($data)) {
                    $this->success('修改成功！',Url("Admin/Role/index"));
                } else {
                    $this->error('修改失败!');
                }
            } else {
                $this->error('修改失败!');
            }
        } else {
            $data = db("auth_group")->where(array("id" => $id))->find();
            if (!$data) {
                $this->error("该角色不存在！");
            }
            $this->assign("data", $data);
            return $this->fetch();
        }
    }

    //权限管理
    public function auth() {
        if (Request::instance()->isPost()) {
           $menuid=$_POST["menuid"];
           $data["rules"]=implode(",",$menuid);
           $id=input("id");
           $auth=db("auth_group")->where(array("id" => $id))->value('rules');
           if($auth==$data["rules"]){
               $this->success('授权成功!',Url("Admin/Role/index"));
           }
           $result = db("auth_group")->where(array("id" =>$id))->update($data);
            if ($result) {
                $this->success('授权成功!',Url("Admin/Role/index"));
            } else {
                $this->error('授权失败!');
            }
        } else {
            //角色ID
            $id = (int)input("id");
            if (!$id) {
                $this->error("参数错误！");
            }
            $menu = new Tree();
            $menu->icon = array('│ ', '├─ ', '└─ ');
            $menu->nbsp = '&nbsp;&nbsp;&nbsp;';
           $result = db("menu")->where("status=1 and type in (2,3)")->order(array("listorder" => "DESC"))->select();
            foreach ($result as $n => $t) {
                $result[$n]['checked'] = ($this->is_checked($t["id"], $id)) ? ' checked' : '';
                $result[$n]['level'] = $this->get_level($t['id'], $result);
                $result[$n]['parentid_node'] = ($t['parentid']) ? ' class="child-of-node-' . $t['parentid'] . '"' : '';
            }
            //print_r($result);
            $str = "<tr id='node-\$id' \$parentid_node>
                           <td style='padding-left:30px;'>\$spacer<input type='checkbox' name='menuid[]' value='\$id' level='\$level' \$checked onclick='javascript:checknode(this);'> \$title</td>
        </tr>";
            $menu->init($result);
            $categorys = $menu->get_tree(0, $str);
            $this->assign("categorys", $categorys);
            $this->assign("id", $id);
            return $this->fetch();
        }
      }

   /**
     *  检查指定菜单是否有权限
     * @param int $menuid 权限ID
     * @param int $roleid 需要检查的角色ID
     */
    protected function is_checked($menuid, $roleid) {
         $data = db("auth_group")->where(array("id" => $roleid))->value('rules');
         $data=  explode(",", $data);
         $info = in_array($menuid, $data);
        if ($info) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取菜单深度
     * @param $id
     * @param $array
     * @param $i
     */
    protected function get_level($id, $array = array(), $i = 0) {
        foreach ($array as $n => $value) {
            if ($value['id'] == $id) {
                if ($value['parentid'] == '0')
                    return $i;
                $i++;
                return $this->get_level($value['parentid'], $array, $i);
            }
        }
    }
}
