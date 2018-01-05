<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Config;
use think\Db;

class Upload extends Controller {

    public function _initialize() {
        if(!Session::has('userid')){
            return json(['state'=>0,'referer'=>'','info'=>'账号未登录,不允许上传文件！']);
        }
    }

    public function imgfile() {
        $weme_group=Config::get('weme_group');
        $dns=Db::connect($weme_group)->query('select dns from file_server where current_status=0 order by rand() limit 1');
        $uri="/file_upload.php?v_cmd=0";
        $url = "http://".$dns[0]['dns'] . $uri;

        if (!empty($form)) {
            $url .= '?' . http_build_query($form);
        }
        if (!$ch = curl_init($url)) {
            return json(['state'=>0,'referer'=>'','info'=>'上传失败！']);
        }
        $curl_files = array();
        $input_name = 'name_uploaded_file';
        foreach ($_FILES as  $info) {
            $curl_files["name_uploaded_file"] = curl_file_create($info['tmp_name'], $info['type'], $info['name']);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_files);
        $result = curl_exec($ch);
        if ($result === false) {
            return json(['state'=>0,'referer'=>'','info'=>'上传文件失败！']);
        }
        $result=json_decode($result,true);
        if($result['cmd']!=-1){
            return json(['state'=>1,'referer'=>'','info'=>$result['content']['url']]);
        }else{
            return json(['state'=>0,'referer'=>'','info'=>'上传文件失败！']);
        }

    }
    public function imgedit() {
        $weme_group=Config::get('weme_group');
        $dns=Db::connect($weme_group)->query('select dns from file_server where current_status=0 order by rand() limit 1');
        $uri="/file_upload.php?v_cmd=0";
        $url = "http://".$dns[0]['dns'] . $uri;

        if (!empty($form)) {
            $url .= '?' . http_build_query($form);
        }
        if (!$ch = curl_init($url)) {
            return json(['state'=>0,'referer'=>'','info'=>'上传失败！']);
        }
        $curl_files = array();
        $input_name = 'name_uploaded_file';
        foreach ($_FILES as  $info) {
            $curl_files["name_uploaded_file"] = curl_file_create($info['tmp_name'], $info['type'], $info['name']);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_files);
        $result = curl_exec($ch);
        if ($result === false) {
            return json(['error'=>1,'message'=>'上传文件失败！']);
        }
        $result=json_decode($result,true);
        if($result['cmd']!=-1){
            return json(['error'=>0,'url'=>$result['content']['url']]);
        }else{
            return json(['error'=>1,'message'=>'上传文件失败！']);
        }

    }
}
