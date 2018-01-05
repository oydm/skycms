<?php
namespace app\admin\controller;
use think\Config;
use think\Session;
use think\Controller;
use app\admin\model\User;

class Login extends Controller {

    public function index(){
        if(Session::has('userid')){
            $admin_userid=Session::get('userid');
            if ($admin_userid) {
                $this->redirect('Admin/Index/index');
            }
        }

        return $this->fetch();
    }

    public function verify(){
    	$config=Config::get('captcha');
        return captcha($id = "admin_login_verify", $config);
    }

    public function login(){
    	$username=input('post.username');
    	$password=input('post.password');
    	$verify=input('post.verify');
    	if(!$username){
            $this->ini_error("用户名不能为空!");
    	}
    	if(!$password){
            $this->ini_error("密码不能为空!");
    	}
    	if(!$verify){
            $this->ini_error("验证码不能为空!");
    	}
    	$config=Config::get('captcha');
    	if(!captcha_check($verify,$id = "admin_login_verify", $config)){
            $this->ini_error("验证码错误!");
		}
		if ($this->loginAdmin($username, $password)) {
            $this->ini_success("登陆成功!",url('Admin/Index/Index'));
        } else {
            $this->recordLoginAdmin($username, $password, 0, "账号密码错误"); //记录登录日志
            $this->ini_error("登陆失败！");
        }
    }

    /* 退出登录 */
    public function logout() {
        //清除用户名
        Session::delete('userid');
        Session::delete('user');
        //清除标记为后台登陆
        Session::delete('isadmin');
        //清除角色
        Session::delete('group_id');
        // 清除session
        Session::clear();
        $this->ini_success("注销成功！",url('Admin/Login/Index'));
    }


    public function outlogin() {
        //清除用户名
        Session::delete('userid');
        Session::delete('user');
        //清除标记为后台登陆
        Session::delete('isadmin');
        //清除角色
        Session::delete('group_id');
        // 清除session
        Session::clear();
    }

    /**
     * 登陆后台
     * @param type $identifier 用户ID,或者用户名
     * @param type $password 用户密码，不能为空
     * @return type 成功返回true，否则返回false
     */
    public function loginAdmin($identifier, $password) {
        if (empty($identifier) || empty($password)) {
            return false;
        }
        $user = new User();
        $userinfo = $user->getLocalAdminUser($identifier, $password);
        if (!$userinfo) {
            $this->recordLoginAdmin($identifier, $password, 0, "帐号密码错误");
            return false;
        }
        //判断帐号状态
        if ($userinfo['status'] == 0) {
            //记录登陆日志
            $this->recordLoginAdmin($identifier, $password, 0, "帐号被禁止");
            return false;
        }
        //设置用户名

        Session::set('userid',$userinfo['id']);
        Session::set('user',$userinfo['username']);
          //标记为后台登陆
        Session::set('isadmin',true);
        //角色
        Session::set('group_id',$userinfo['group_id']);

        $this->recordLoginAdmin($identifier, $password, 1);
        db('user')->where('id',$userinfo['id'])->update(array(
            "lastlogin_time" => time(),
            "login_num" => $userinfo["login_num"] + 1,
            "lastlogin_ip" => get_client_ip()
        ));
        return true;
    }


    /**
     * 记录后台登陆信息
     * @param string $identifier 用户名
     * @param string $password 用户密码
     * @param int $status 状态 1登录成功 0登录失败
     * @param string $info 备注
     * @author oydm<389602549@qq.com>  time|20140421
     */
    public function recordLoginAdmin($identifier, $password, $status, $info = "") {
    	db('loginlog')->insert(array(
            "username" => $identifier,
            "logintime" => date("Y-m-d H:i:s"),
            "loginip" => get_client_ip(),
            "status" => $status,
            "password" => "***" . substr($password, 3, 4) . "***",
            "info" => $info
        ));
    }

}