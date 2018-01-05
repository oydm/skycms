<?php
namespace app\admin\controller;
use think\Session;
use think\Request;
use think\Config;
use think\Controller;
use think\Auth;

class Common extends Controller{

    public function _initialize() {
    	if(Session::has('userid')){
    		$admin_userid=Session::get('userid');
    		if (!$admin_userid) {
            	$this->error('请先登录！', 'Admin/Login/index');
        	}
            $group_id=Session::get('group_id');
            $group_name=db("auth_group")->where('id', $group_id)->value('title');
            $this->assign("group_name", $group_name);
           if ($admin_userid != 1) {
                $request = Request::instance();
                $module=$request->module();
                $controller=$request->controller();
                $action=$request->action();
                $name = strtolower($module . '/' . $controller . '/' . $action);
                if(!in_array($name, Config::get('AUTH_Filter'))) {
                    $AUTH = new Auth();
                    $rules = $AUTH->check($name, $admin_userid);
                    if (!$rules) {
                        $this->error('您在当前模块没有权限',url('admin/index/main'));
                    }
                }
            }
            /*$request = Request::instance();
              $path=$request->path();
              $text = "访问：模块/控制器/方法：" . $path;
              $this->addLogs($text,1,$path);*/
    	}else{
    		$this->redirect('Admin/Login/index');
    	}

    }

    /**
     * 消息提示
     * @param type $message
     * @param type $jumpUrl
     * @param type $ajax
     */
    public function error($message, $jumpUrl = '', $data = '') {
        $request = Request::instance();
        $module=$request->module();
        $controller=$request->controller();
        $action=$request->action();
        $name=db('menu')->where('name',$module . '/' . $controller . '/' . $action)->value('title');
        $text = "模块名：".$name."，模块/控制器/方法：" . $module . '/' . $controller . '/' . $action . "<br>提示语：" . $message;
        $status = 0;
        $application = $module . '/' . $controller . '/' . $action;
        $this->addLogs($text, $status, $application);
        parent::ini_error($message, $jumpUrl, $data);

    }

    /**
     * 消息提示
     * @param type $message
     * @param type $jumpUrl
     * @param type $ajax
     */
    public function success($message, $jumpUrl = '',$data = '') {
        $request = Request::instance();
        $module=$request->module();
        $controller=$request->controller();
        $action=$request->action();
        $name=db('menu')->where('name',$module . '/' . $controller . '/' . $action)->value('title');
        $text = "模块名：".$name."; 模块/控制器/方法：" . $module . '/' . $controller . '/' . $action . "<br>提示语：" . $message;
        $status = 1;
        $application = $module . '/' . $controller . '/' . $action;
        $this->addLogs($text, $status, $application);
        parent::ini_success($message, $jumpUrl, $data);
    }

    function addLogs($info, $status, $application) {
        $uid = Session::get('userid');
        if (!$uid) {
            return false;
        }
        db("log")->insert(array(
            "uid" => $uid,
            "time" => date("Y-m-d H:i:s"),
            "ip" => get_client_ip(),
            "status" => $status,
            "info" => $info,
            "application" => $application
        ));
    }

    /**
     * 获取菜单导航
     */
    public static function getMenu() {
        $menuid = (int)input('menuid');
        $menuid = $menuid ? $menuid : cookie("menuid", "", array("prefix" => ""));
        $db = db('menu');
        $info_where["id"]=$menuid;
        $find_where["parentid"]=$menuid;
        $find_where["ismenu"]=1;
        $group_id=Session::get('group_id');
        if($group_id!=1){
            $rules=db('auth_group')->where("id=".$group_id)->value('rules');
            $rules= explode(',',$rules);
            $find_where["id"]=array('in',$rules);
        }
        $info = $db->cache(true, 60)->where($info_where)->field("id,title,parentid,type,name")->select();
        $find = $db->cache(true, 60)->where($find_where)->field("id,title,parentid,type,name")->select();
        if ($find&&$info) {
            if(is_array($info[0])){
               array_unshift($find, $info[0]); 
            }
        } else {
            $find = $info;
        }
        foreach ($find as $k => $v) {
            $find[$k]['data'] = "menuid=$menuid";
        }
        $request = Request::instance();
        //$module=$request->module()
        //$controller=$request->controller();
        $action=$request->action();
        return array('getMenu' => $find,'action'=>$action,'menuReturn'=>'');;
    }

    /**
     * 字符截取
     * @param $string 需要截取的字符串
     * @param $length 长度
     * @param $dot
     */
    function str_cut($sourcestr, $length, $dot = '...') {
        $returnstr = '';
        $i = 0;
        $n = 0;
        $str_length = strlen($sourcestr); //字符串的字节数
        while (($n < $length) && ($i <= $str_length)) {
            $temp_str = substr($sourcestr, $i, 1);
            $ascnum = Ord($temp_str); //得到字符串中第$i位字符的ascii码
            if ($ascnum >= 224) {//如果ASCII位高与224，
                $returnstr = $returnstr . substr($sourcestr, $i, 3); //根据UTF-8编码规范，将3个连续的字符计为单个字符
                $i = $i + 3; //实际Byte计为3
                $n++; //字串长度计1
            } elseif ($ascnum >= 192) { //如果ASCII位高与192，
                $returnstr = $returnstr . substr($sourcestr, $i, 2); //根据UTF-8编码规范，将2个连续的字符计为单个字符
                $i = $i + 2; //实际Byte计为2
                $n++; //字串长度计1
            } elseif ($ascnum >= 65 && $ascnum <= 90) { //如果是大写字母，
                $returnstr = $returnstr . substr($sourcestr, $i, 1);
                $i = $i + 1; //实际的Byte数仍计1个
                $n++; //但考虑整体美观，大写字母计成一个高位字符
            } else {//其他情况下，包括小写字母和半角标点符号，
                $returnstr = $returnstr . substr($sourcestr, $i, 1);
                $i = $i + 1;            //实际的Byte数计1个
                $n = $n + 0.5;        //小写字母和半角标点等与半个高位字符宽...
            }
        }
        if ($str_length > strlen($returnstr)) {
            $returnstr = $returnstr . $dot; //超过长度时在尾处加上省略号
        }
        return $returnstr;
    }
}
?>