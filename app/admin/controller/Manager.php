<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Session;
use app\admin\controller\Common;
use app\admin\model\User;

class Manager extends Common {

    public function myinfo(){
    	if (Request::instance()->isPost()) {
            $User = db('user');
            $data = input('post.');
            //判断是否修改的是否本人
            if (input('post.id')!= Session::get('userid')) {
                $this->error("只能修改本人!");
            }
            if ($data) {
                //过滤数据，防止自己修改自己信息给自己提权，比如，角色提升
                $noq = array("password", "last_login_time", "last_login_ip", "login_count", "role_id", "verify");
                foreach ($noq as $key => $value) {
                    unset($data[$value]);
                }
                if ($User->where('id', Session::get('userid'))->update($data) !== false) {
                    $this->success("资料修改成功!");
                } else {
                    $this->error("更新失败！");
                }
            } else {
                $this->error("数据为空！");
            }
        } else {
            $data = db('user')->where(array("id" => Session::get('userid')))->find();
            $this->assign("data", $data);
            return $this->fetch();
        }
    }

    /**
     * 修改密码
     * @author oydm<389602549@qq.com>  time|2017-01-13
     */
    public function chanpass() {
        if (Request::instance()->isPost()) {
            $userid = intval(Session::get('userid'));
            if (trim(input('post.password')) == "") {
                $this->error("请输入旧密码！");
            }
            $usermodel = new User();
            //检验原密码是否正确
            $user = $usermodel->getLocalAdminUser($userid, trim(input('post.password')));
            //$user =M("User")->where(array("id" =>$_SESSION['userid'],"password"=>  md5(trim($_POST["password"]))))->find();
            if ($user == false) {
                $this->error("旧密码输入错误！");
            }
            if (trim(input('post.new_password')) == "") {
                $this->error("请输入新密码！");
            }
            if (trim(input('post.new_pwdconfirm')) == "") {
                $this->error("请输入重复密码！");
            }
            if (trim(input('post.new_password')) != trim(input('post.new_pwdconfirm'))) {
                $this->error("两次密码不相同！");
            }
            $pass = trim(input('post.new_password'));
            $up = $usermodel->ChangePassword($userid, $pass);
            if ($up) {
                //退出登陆
                //$event = controller('Admin/Login', 'event');
                //$event->outlogin();
                Session::clear();
                $this->success("密码已经更新，请重新登陆！",url('Admin/Login/Index'));
            } else {
                $this->error("密码更新失败！");
            }
        } else {
            $data = db('user')->where(array("id" => Session::get('userid')))->field("username")->find();
            $this->assign("data", $data);
            return $this->fetch();
        }
    }


    public function index() {
        $group_id =  (int)input('group_id');
        $UserView = db("user");
        if (empty($group_id)) {
            $User = $UserView->select();
        } else {
            $User = $UserView->where(array("group_id" => $group_id))->select();
        }
        foreach ($User as $key => $value) {
            $User[$key]["role_name"] = db("auth_group")->where("id=" . $value["group_id"])->value('title');
        }
        $this->assign("Userlist", $User);
        return $this->fetch();
    }

    /**
     *  添加
     */
    public function add() {
        if (Request::instance()->isPost()) {
            $user = new User();
            if ($user->addUser(input())) {
                $this->success("添加管理员成功！",url('Admin/Manager/Index'));
            } else {
                $this->error("添加管理员失败！");
            }
        } else {
            $role = db("auth_group")->select();
            $this->assign("role", $role);
            return $this->fetch();
        }
    }



    /**
     *  删除
     */
    public function delete() {
        $id = input('id');
        if (empty($id)) {
            $this->error("没有指定删除对象！");
        }
        if ($id == 1) {
            $this->error("该用户不能被删除！");
        }
        if ((int) $id == Session::get('userid')) {
            $this->error("你不能删除你自己！");
        }
        //执行删除
        $user = new User();
        if ($user->delUser($id)) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }


    /**
     *  编辑
     */
    public function edit() {
        if (Request::instance()->isPost()) {
            $user = new User();
            if (false !== $user->editUser(input())) {
                $this->success("更新成功！");
            } else {
                $this->error("更新失败！");
            }
        } else {
            $role = db("auth_group")->select();
            $this->assign("role", $role);
            $data = db("user")->where(array("id" => input("id")))->find();
            $this->assign("data", $data);
            return $this->fetch();
        }
    }
}
