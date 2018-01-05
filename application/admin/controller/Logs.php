<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Session;
use think\Page;
use app\admin\controller\Common;

class Logs extends Common {
	 /**
     * 登录日志查看
     */
    public function  login(){
        $username =input("username");
        $start_time =input('start_time');
        $end_time =input('end_time');
        $ip = input("ip");
        $status = input("status");
        $data=array();
        if(!empty($username)){
            $data['username'] = array('like', '%'.$username.'%');
        }
        if(!empty($start_time) && !empty($end_time)){
        	$data['logintime'] = array(array('gt',$start_time." 00:00:00"),array('lt',$end_time." 23:59:59"));
        }
        if(!empty($ip )){
            $data['loginip'] = array('like', '%'.$ip.'%');
        }
        if(!empty($status)){
            $data['status'] = array('eq',$status);
        }

        $count = db("loginlog")->where($data)->count();
        $page=new Page($count,10);
        $Logs = db("loginlog")->where($data)->limit($page->firstRow.','.$page->listRows)->order(array("logintime"=>"desc"))->select();
        $show = $page->show();
        $this->assign("logs",$Logs);
        $this->assign("Page",$show);
        return $this->fetch();
    }
    
     /**
     * 删除一个月前的登陆日志
     */
    public function logindel(){
        $t = date("Y-m-d H:i:s",  time()-2592000);
     
        if(db("Loginlog")->where(array("logintime"=>array("lt",$t)))->delete() !== false){
             $this->success("删除操作日志成功！");
        }else{
            $this->error("删除操作日志失败！");
        }
    }
    
    /**
     * 操作日志查看
     */
    public function index(){
        $uid =input("uid");
        $start_time =input('start_time');
        $end_time =input('end_time');
        $ip = input("ip");
        $status = input("status");
        $data=array();
        if(!empty($uid)){
            $data['uid'] = array('eq', $uid);
        }
        if(!empty($start_time) && !empty($end_time)){
            $data['time'] = array(array('gt',$start_time." 00:00:00"),array('lt',$end_time." 23:59:59"));
        }
        if(!empty($ip )){
            $data['ip '] = array('like', '%'.$ip.'%');
        }
        if(!empty($status)){
            $data['status'] = array('eq',$status);
        }
        $count = db("Log")->where($data)->count();
        $page=new Page($count,10);
        $Logs = db("Log")->where($data)->limit($page->firstRow.','.$page->listRows)->order(array("id"=>"desc"))->select();
        foreach ($Logs as $key => $value) {
            $Logs[$key]["username"]=db("user")->where("id=".$value["uid"])->value("username");
        }
        $show = $page->show();
        $this->assign("logs",$Logs);
        $this->assign("Page",$show);
        return $this->fetch();
    }
    
    /**
     * 删除一个月前的操作日志
     */
    public function del(){
        $t = date("Y-m-d H:i:s",  time()-2592000);
          
        if(db("Log")->where(array("time"=>array("lt",$t)))->delete() !== false){
            $this->success("删除操作日志成功！");
        }else{
            $this->error("删除操作日志失败！");
        }
    }
}
