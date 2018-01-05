<?php
namespace app\install\controller;
use think\Controller;
use think\Session;
use think\Request;
use think\Db;

class Index extends Controller{

	//初始化
    public function _initialize() {
        header('Content-Type:text/html;charset=utf-8;');
        //检查是否已经安装过
        $request = Request::instance();
        $module=$request->module();
        if (is_file(APP_PATH .DS.$module.DS. 'install.lock')) {
            die('你已经安装过该系统，如果想重新安装，请先删除站点应用目录中' . $module . '目录下的 install.lock 文件，然后再安装。');
        }
        $this->assign('Title', 'SkyCMS管理后台');
        $this->assign('Powered', 'Powered by skycms.com');
    }

    public function index() {
        return $this->fetch(':index');
    }

    public function step2(){
        $data=array();
        $icon_correct='<i class="fa fa-check correct"></i> ';
        $icon_error='<i class="fa fa-close error"></i> ';
        //php版本、操作系统版本
        $data['phpversion'] = @phpversion();
        $data['os']=PHP_OS;
        //环境检测
        $err = 0;
        if (class_exists('pdo')) {
            $data['pdo'] = $icon_correct.'已开启';
        } else {
            $data['pdo'] = $icon_error.'未开启';
            $err++;
        }
        //扩展检测
        if (extension_loaded('pdo_mysql')) {
            $data['pdo_mysql'] = $icon_correct.'已开启';
        } else {
            $data['pdo_mysql'] =$icon_error.'未开启';
            $err++;
        }
        if (extension_loaded('curl')) {
            $data['curl'] = $icon_correct.'已开启';
        } else {
            $data['curl'] = $icon_error.'未开启';
            $err++;
        }
        if (extension_loaded('mbstring')) {
            $data['mbstring'] = $icon_correct.'已开启';
        } else {
            $data['mbstring'] = $icon_error.'未开启';
            $err++;
        }
        if (extension_loaded('exif')) {
            $data['exif'] = $icon_correct.'已开启';
        } else {
            $data['exif'] = $icon_error.'未开启';
            $err++;
        }
        //设置获取
        if (ini_get('file_uploads')) {
            $data['upload_size'] = $icon_correct . ini_get('upload_max_filesize');
        } else {
            $data['upload_size'] = $icon_error.'禁止上传';
        }
        if (ini_get('allow_url_fopen')) {
            $data['allow_url_fopen'] = $icon_correct.'已开启';
        } else {
            $data['allow_url_fopen'] = $icon_error.'未开启';
            $err++;
        }
        //函数检测
        if (function_exists('file_get_contents')) {
            $data['file_get_contents'] = $icon_correct.'已开启';
        } else {
            $data['file_get_contents'] = $icon_error.'未开启';
            $err++;
        }
        if (function_exists('session_start')) {
            $data['session'] = $icon_correct.'已开启';
        } else {
            $data['session'] = $icon_error.'未开启';
            $err++;
        }
        //检测文件夹属性
        $checklist = array(
            'app/database.php',
            'app/config.php',
            'runtime'
        );
        $new_checklist=array();
        foreach($checklist as $dir){
            if(is_dir($dir)){
                $testdir = "./".$dir;
                create_dir($testdir);
                if(testwrite($testdir)){
                    $new_checklist[$dir]['w']=true;
                }else{
                    $new_checklist[$dir]['w']=false;
                    $err++;
                }
                if(is_readable($testdir)){
                    $new_checklist[$dir]['r']=true;
                }else{
                    $new_checklist[$dir]['r']=false;
                    $err++;
                }
            }else{
                if(is_writable($dir)){
                    $new_checklist[$dir]['w']=true;
                }else{
                    $new_checklist[$dir]['w']=false;
                    $err++;
                }
                if(is_readable($dir)){
                    $new_checklist[$dir]['r']=true;
                }else{
                    $new_checklist[$dir]['r']=false;
                    $err++;
                }
            }
        }
        $data['checklist']=$new_checklist;
        $this->assign($data);
        return $this->fetch(':step_2');
    }
    
    public function step3(){
        return $this->fetch(':step_3');
    }


    public function step4(){
        if(request()->isPost()){
            session("step",4);
            session('error',false);
            //创建数据库
            $dbconfig['type']="mysql";
            $dbconfig['hostname']=input('dbhost');
            $dbconfig['username']=input('dbuser');
            $dbconfig['password']=input('dbpw');
            $dbconfig['hostport']=input('dbport');
            $dbname=strtolower(input('dbname'));
            //连接数据库
            $dsn = "mysql:host={$dbconfig['hostname']};port={$dbconfig['hostport']};charset=utf8";
            try {
                $db = new \PDO($dsn, $dbconfig['username'], $dbconfig['password']);
            } catch (\PDOException $e) {
                $this->error('数据库连接失败', url('step3'));
            }
            //建立数据库
            $sql = "CREATE DATABASE IF NOT EXISTS `{$dbname}` DEFAULT CHARACTER SET utf8";
            //$db->exec($sql) || $this->error('数据库创建失败');
            //重新实例化
            $dsn = "mysql:dbname={$dbname};host={$dbconfig['hostname']};port={$dbconfig['hostport']};charset=utf8";
            try {
                $db = new \PDO($dsn, $dbconfig['username'], $dbconfig['password']);
            } catch (\PDOException $e) {
                $this->error('数据库连接失败', url('step3'));
            }
            $dbconfig['database']=$dbname;
            $dbconfig['prefix']=trim(input('dbprefix'));
            $table_prefix=input("dbprefix");
            //显示模板
            echo $this->fetch(':step_4');
            //运行sql

            //execute_sql($db, "skycms.sql", $table_prefix);

            //更新配置信息
            //update_site_configs($db, $table_prefix);
            //创建管理员
            //create_admin_account($db, $table_prefix);
            //生成网站配置文件
            //create_config($dbconfig);
            if(session('error')){
                $this->error("安装失败",url('step3'));
            }else{
                sleep(2);

                $this->redirect(url('step5'));
            }
        }else{
            exit;
        }
    }

    public function step5(){
        session("step",4);
        if(session('step')==4){
            @touch(APP_PATH. request()->module() . '/install.lock');
			cookie('think_var', 'zh-cn');
            session(null);
            return $this->fetch(':step_5');
        }else{
            $this->error("非法安装！",url('index'));
        }
    }

    public function testdb(){
        if(request()->isPost()){
            $dbconfig=input("post.");
            $dsn = "mysql:host={$dbconfig['hostname']};port={$dbconfig['hostport']};charset=utf8";
            try {
                $db = new \PDO($dsn, $dbconfig['username'], $dbconfig['password']);
            } catch (\PDOException $e) {
                die("");
            }
            try{
                $db->query("show databases;");
            }catch (\PDOException $e){
                die("");
            }
            exit("1");
        }else{
            exit("need post!");
        }
    }

}
