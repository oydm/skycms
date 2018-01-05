<?php
namespace app\admin\model;
use think\Session;
use think\Model;
use think\Config;


class User extends Model
{
	//protected $table = 'weme_user';
	/**
     * 根据提示符(username)和未加密的密码(密码为空时不参与验证)获取本地用户信息
     * @param type $identifier 为数字时，表示uid，其他为用户名
     * @param type $password 
     * @return 成功返回用户信息array()，否则返回布尔值false
     */
    public function getLocalAdminUser($identifier, $password = null) {
        if (empty($identifier)) {
            return false;
        }
        $map = array();
        if (is_int($identifier)) {
            $map['id'] = $identifier;
        } else {
            $map['username'] = $identifier;
        }
        $user = db("user")->where($map)->find();
        if (!$user) {
            return false;
        }
        if ($password) {
            //验证本地密码是否正确
            if ($this->encryption($identifier, $password, $user['verify']) != $user['password']) {
                return false;
            }
        }
        return $user;
    }

     /**
     * 对明文密码，进行加密，返回加密后的密码
     * @param $identifier 为数字时，表示uid，其他为用户名
     * @param type $pass 明文密码，不能为空
     * @return type 返回加密后的密码
     */
    public function encryption($identifier, $pass, $verify = "") {
        $v = array();
        if (is_numeric($identifier)) {
            $v["id"] = $identifier;
        } else {
            $v["username"] = $identifier;
        }
        $pass = md5($pass . md5($verify));
        return $pass;
    }

     /**
     * 根据标识修改对应用户密码
     * @param type $identifier
     * @param type $password
     * @return type 
     */
    public function ChangePassword($identifier, $password) {
        if (empty($identifier) || empty($password)) {
            return false;
        }
        $term = array();
        if (is_int($identifier)) {
            $term['id'] = $identifier;
        } else {
            $term['username'] = $identifier;
        }
        $verify =  $this->genRandomString(6);
        $data['verify'] = $verify;
        $data['password'] = $this->encryption($identifier, $password, $verify);
        $up = db("user")->where($term)->update($data);
        if ($up !== false) {
            return true;
        }
        return false;
    }

    /**
     * 产生随机字符串 
     * 产生一个指定长度的随机字符串,并返回给用户 
     * @access public 
     * @param int $len 产生字符串的位数 
     * @return string 
     */
    function genRandomString($len = 6) {
        $chars = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
            "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
            "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
            "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
            "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
            "3", "4", "5", "6", "7", "8", "9"
        );
        $charsLen = count($chars) - 1;
        shuffle($chars);    // 将数组打乱 
        $output = "";
        for ($i = 0; $i < $len; $i++) {
            $output .= $chars[mt_rand(0, $charsLen)];
        }
        return $output;
    }


    /**
     * 添加管理员
     * @param type $data
     * @return boolean
     */
    public function addUser($data) {
        if (empty($data)) {
            return false;
        }
        //检验数据
       //$data = $this->create($data, 1);
        if ($data) {
            //生成随机认证码
            $data['verify'] = $this->genRandomString(6);
            //利用认证码和明文密码加密得到加密后的
            $data['password'] = $this->encryption(0, $data['password'], $data['verify']);
            unset($data['pwdconfirm']);
            $id = db("user")->insertGetId($data);
            if ($id) {
                //添加角色对应关系
                $group_id=$data['group_id'];
                $auth_group_access=array(
                    'uid'=>$id,
                    'group_id'=>$group_id,
                );
                db("auth_group_access")->insert($auth_group_access);
                return $id;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 删除管理员
     * @param type $userId
     * @return boolean
     */
    public function delUser($userId) {
        $userId = (int) $userId;
        if (empty($userId)) {
            $this->error = '请指定需要删除的用户ID！';
            return false;
        }
        if ($userId == 1) {
            $this->error = '该管理员不能被删除！';
            return false;
        }
        $usermodel = new User;
        if (false !== $usermodel->where(array('id' => $userId))->delete()) {
            return true;
        } else {
            $this->error = '删除失败！';
            return false;
        }
    }


    /**
     * 编辑用户信息
     * @param type $data
     * @return boolean
     */
    public function editUser($data) {
        if (empty($data) || !isset($data['id'])) {
            $this->error = '数据不能为空！';
            return false;
        }
        //角色Id
        $id = (int) $data['id'];
        $username =$data['username'];
        unset($data['id']);
        unset($data['pwdconfirm']);
        unset($data['username']);
        //取得原本用户信息
        $userInfo = db("user")->where(array("id" => $id))->field('id,verify')->find();
        if (empty($userInfo)) {
            $this->error = '该用户不存在！';
            return false;
        }
        //角色id
        $group_id = $data['group_id'];
        if ($data) {
            //密码
            $password = $data['password'];
            if (!empty($password)) {
                //生成随机认证码
                $data['verify'] =$this->genRandomString(6);
                //进行加密
                $pass = $this->encryption($id, $password, $data['verify']);
                $data['password'] = $pass;
            } else {
                unset($data['password']);
            }
            $data['username']=$username;
            if (db("user")->where(array('id' => $id))->update($data) !== false) {
                  if (!empty($group_id)) {
                    db("auth_group_access")->where(array("uid" => $id))->update(array("group_id" => $group_id));
                }
                return true;
            } else {
                $this->error = '更新失败！';
                return false;
            }
        } else {
            return false;
        }
    }
}