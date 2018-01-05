<?php
namespace app\admin\model;
use think\Model;
use think\Config;

class Webconfig extends Model
{

      /**
     * 更新网站配置项
     * @param type $data 数据
     * @return boolean
     */
    public function saveConfig($data) {
        if (empty($data) || !is_array($data)) {
            $this->error = '配置数据不能为空！';
            return false;
        }
        $config=array();
        foreach ($data as $key => $value) {
            if (empty($key)) {
                continue;
            }
            $saveData = array();
            $saveData["value"] = trim($value);
            $config[]=array(
                'varname'=>$key,
                'value'=>trim($value)
            );
            if ($this->where(array("varname" => $key))->update($saveData) === false) {
                $this->error = "更新到{$key}项时，更新失败！";
                return false;
            }
        }
        $this->config_cache();
        return true;
    }
    /**
     * 更新缓存
     * @return type
     */
    public function config_cache() {
        $data = db("webconfig")->column("varname,value");
        $this->config_save($data);
        return $data;
    }

    public function  config_save($data){
        Config::set($data,'site');
    }
}
