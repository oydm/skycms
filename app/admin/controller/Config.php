<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Webconfig;
use app\admin\controller\Common;

class Config extends Common {

	/**
     * 站点设置
     * @author oydm<389602549@qq.com>  time|2017
     */
	public function index(){

    	if (Request::instance()->isPost()) {
            return $this->dosite();
        } else {
            $config = db('Webconfig')->where(array("groupid" => 1))->select();
            foreach ($config as $key => $r) {
                $data[$r['varname']] = $r['value'];
            }
            $this->assign('URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
            $this->assign('Site', $data);
            return $this->fetch();
        }
    }


    /**
     * 邮箱设置
     * @author oydm<389602549@qq.com>  time|2017
     */
    public function email() {
         if (Request::instance()->isPost()) {
            return $this->dosite();
        } else {
            $config = db("Webconfig")->where(array("groupid" => 2))->select();
            foreach ($config as $key => $r) {
                $data[$r['varname']] = $r['value'];
            }
            $this->assign('Site', $data);
            return $this->fetch();
        }
        
    }

    /**
     * 更新配置
     * @author oydm<389602549@qq.com>  time|2017
     */
    protected function dosite() {
        $Config = new Webconfig();
        $re=$Config->saveConfig($_POST);
        if ($re) {
            $this->success('更新成功！');
        } else {
            $this->error('配置更新失败!');
        }
    }

}