<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Cache;
use think\Request;
use app\admin\controller\Common;
use app\admin\model\Menu;

class Index extends Common {

    public function index(){
    	$menu = new Menu();
    	$menuinfo=$menu->menu_json();
    	$this->assign("SUBMENU_CONFIG", json_encode($menuinfo));
        return $this->fetch();
    }

    public function main(){
        //服务器信息
        $info = array(
            '操作系统' => PHP_OS,
            '运行环境' => $_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式' => php_sapi_name(),
            '上传附件限制' => ini_get('upload_max_filesize'),
            '执行时间限制' => ini_get('max_execution_time') . "秒",
            '剩余空间' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',
        );
        $this->assign('server_info', $info);
        $rules=db('user_chanyong')->where("userid=".Session::get('userid'))->value('rules');
        $rules= explode(',',$rules);
        $where["id"]=array('in',$rules);
        $Panel = db("menu")->where($where)->select();
        $items=array();
        foreach ($Panel as $r) {
             $items[$r['id']] = array(
                 "id" => $r['id'] . 'changyong',
                 "name" => $r['title'],
                 "url" => url($r['name'],array('menuid'=>$r['id'])),
             );
        }
        $this->assign('items', $items);
        return $this->fetch();
    }
    function deletecache(){
        if (Request::instance()->isPost()) {
            $type = input('type');
            set_time_limit(0);
            switch ($type) {
                case "site":
                    Cache::clear();
                    $this->success("站点数据缓存清理成功！");
                    break;
                case "template":
                    array_map('unlink', glob(TEMP_PATH.DS.'*.php' ));
                    $this->success("站点模板缓存清理成功！");
                    break;
                case "logs":
                    $path = glob(LOG_PATH.'/*' );
                    foreach ($path as $item) {
                        array_map('unlink', glob( $item.DS.'*.*' ) );
                    }
                    $this->success("站点日志清理成功！");
                    break;
                default:
                    return $this->fetch();
                    break;
            }
        } else {
            return $this->fetch();
        }
    }
}
