<?php
use think\Db;
use think\Request;
use think\Response;
/**
 * 返回带协议的域名
 */
function get_host(){
    $host=$_SERVER["HTTP_HOST"];
    $protocol=Request::instance()->isSsl()?"https://":"http://";
    return $protocol.$host;
}

/*
*	测试是否可写
*/
function testwrite($d) {
    $tfile = "_test.txt";
    $fp = @fopen($d . "/" . $tfile, "w");
    if (!$fp) {
        return false;
    }
    fclose($fp);
    $rs = @unlink($d . "/" . $tfile);
    if ($rs) {
        return true;
    }
    return false;
}
/*
*	建立文件夹
*/
function create_dir($path) {
    if (is_dir($path))
        return true;
    $path = dir_path($path);
    $temp = explode('/', $path);
    $cur_dir = '';
    $max = count($temp) - 1;
    for ($i = 0; $i < $max; $i++) {
        $cur_dir .= $temp[$i] . '/';
        if (@is_dir($cur_dir))
            continue;
        @mkdir($cur_dir, 0777, true);
        @chmod($cur_dir, 0777);
    }
    return is_dir($path);
}
/*
*	返回路径
*/
function dir_path($path) {
    $path = str_replace('\\', '/', $path);
    if (substr($path, -1) != '/')
        $path = $path . '/';
    return $path;
}
/*
*	执行sql文件
*/
function execute_sql($db,$file,$tablepre){
    //读取SQL文件
    $sql = file_get_contents(APP_PATH. request()->module().'/data/'.$file);
    $sql = str_replace("\r", "\n", $sql);
    $sql = explode(";\n", $sql);
    //替换表前缀
    $default_tablepre = "zz_";
    $sql = str_replace(" `{$default_tablepre}", " `{$tablepre}", $sql);
    //开始安装
    showmsg('开始安装数据库...');
    foreach ($sql as $item) {
        $item = trim($item);
        if(empty($item)) continue;
        preg_match('/CREATE TABLE `([^ ]*)`/', $item, $matches);
        if($matches) {
            $table_name = $matches[1];
            $msg  = "创建数据表{$table_name}";
            if(false !== $db->exec($item)){
                showmsg($msg . ' 完成');
            } else {
                session('error', true);
                showmsg($msg . ' 失败！', 'error');
            }
        } else {
            $db->exec($item);
        }
    
    }
}
/*
*	更新系统设置
*/
function update_site_configs($db,$table_prefix){
    $sitename=input("sitename");
    $siteurl=input("siteurl");
    $seo_keywords=input("sitekeywords");
    $seo_description=input("siteinfo");
    $config=array(
        "sitename"=>'网站名称',
        "siteurl"=>'网站地址',
        "sitetitle"=>'网站标题',
        "sitekeywords"=>'网站关键字',
        "sitedescription"=>'网站描述'
    );
    $site_options=array(
            		"sitename"=>$sitename,
					"siteurl"=>$siteurl,
					"sitetitle"=>$sitename,
					"sitekeywords"=>$seo_keywords,
					"sitedescription"=>$seo_description
    );
    $sql="INSERT INTO `{$table_prefix}config` (varname,info,value,groupid) VALUES ";
    foreach ($site_options as $key => $value) {
        $info=$config[$key];
        $sql.="('$key','$info','$value',1),";
    }
    $sql=rtrim($sql,',');
    $db->exec($sql);
    showmsg("网站信息配置成功!");
}
/*
*	创建管理员
*/
function create_admin_account($db,$table_prefix){
    $username=input("manager");
	$admin_pwd_salt=genRandomString(6);
    $password=encryption(input("manager_pwd"), $admin_pwd_salt);
    $email=input("manager_email");
    $create_date=time();
    $ip=request()->ip();
    $sql =<<<hello
    INSERT INTO `{$table_prefix}user` 
    (id,username, password, email, nickname,lastlogin_time, lastlogin_ip, content, group_id, verify) VALUES
    (1,'{$username}', '{$password}','{$email}','超级管理员','{$create_date}','{$ip}','', 1,'{$admin_pwd_salt}');
	INSERT INTO `{$table_prefix}auth_group_access` 
    (uid, group_id) VALUES
    ('1', '1');
hello;
    $db->exec($sql);
    showmsg("管理员账号创建成功!");
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
     * 对明文密码，进行加密，返回加密后的密码
     * @param $identifier 为数字时，表示uid，其他为用户名
     * @param type $pass 明文密码，不能为空
     * @return type 返回加密后的密码
     */
   function encryption($pass, $verify = "") {
        $pass = md5($pass . md5($verify));
        return $pass;
    }

/*
*	写入配置
*/
function create_config($config){
    if(is_array($config)){
        //读取配置内容
        $conf = file_get_contents(APP_PATH. request()->module(). '/database.php');
        //替换配置项
        foreach ($config as $key => $value) {
            $conf = str_replace("#{$key}#", $value, $conf);
        }
        //写入应用配置文件
        if(file_put_contents(APP_PATH. 'database.php', $conf)){
            showmsg('配置文件写入成功');
        } else {
            session('error', true);
            showmsg('配置文件写入失败！', 'error');
        }
        return '';
    }
}

/**
 * 实时显示提示信息
 * @param  string $msg 提示信息
 * @param  string $class 输出样式（success:成功，error:失败）
 * @author huajie <banhuajie@163.com>
 */
function showmsg($msg, $class = ''){
    echo "<script type=\"text/javascript\">showmsg(\"{$msg}\", \"{$class}\")</script>";
    flush();
    ob_flush();
}