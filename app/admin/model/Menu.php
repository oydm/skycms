<?php
namespace app\admin\model;
use think\Model;
use think\Session;
use think\Config;

class Menu extends Model
{   
    //$prefix=Config::get('database.prefix');
	//protected $table = $prefix.'menu';
	
    /**
     * 菜单树状结构集合
     */
    public function menu_json() {
        /*$rules=db('user_chanyong')->where("userid=".Session::get('userid'))->value('rules');
        $rules= explode(',',$rules);
        $where["id"]=array('in',$rules);
        $Panel = db("menu")->where($where)->select();*/
        $items['0changyong'] = array(
            "id" => "",
            "name" => "常用菜单",
            "parent" => "changyong",
            "url" => Url("Menu/public_changyong"),
        );
       /* foreach ($Panel as $r) {
            $items[$r['id'] . '0changyong'] = array(
                "icon" => "",
                "id" => $r['id'] . 'changyong',
                "name" => $r['title'],
                "parent" => "changyong",
                "url" => url($r['name'], array("menuid" => $r['id'])),
            );
        }*/
       $changyong = array(
            "changyong" => array(
                "icon" => "",
                "id" => "changyong",
                "name" => "常用",
                "parent" => "",
                "url" => "",
                "items" => $items
            )
        );
        $data = $this->get_tree(0);
        return array_merge($changyong, $data);
    }

    //取得树形结构的菜单
    public function get_tree($myid, $parent = "", $Level = 1) {
        $data = $this->admin_menu($myid);
        $Level++;
        $ret=array();
        if (is_array($data)) {
            foreach ($data as $a) {
                $id = $a['id'];
                $name =$a['name'];
                $app=explode("/",$a['name']);
                $app=$app[0];
                $array = array(
                    "icon" => "",
                    "id" => $id . $app,
                    "name" => $a['title'],
                    "parent" => $parent,
                    "url" => url("{$name}", array("menuid" => $id)),
                );
                $ret[$id . $app] = $array;
                $child = $this->get_tree($a['id'], $id, $Level);
                //由于后台管理界面只支持三层，超出的不层级的不显示
                if ($child && $Level <= 3) {
                    $ret[$id . $app]['items'] = $child;
                }
            }
        }
        return $ret;
    }


/**
     * 按父ID查找菜单子项
     * @param integer $parentid   父菜单ID  
     * @param integer $with_self  是否包括他自己
     */
    
    public function admin_menu($parentid, $with_self = false) {
        //父节点ID
        $uid=Session::get('userid');
        if($uid!=1){
            $User = db('user')->where(array("id" => $uid))->find();
            $rules=db('auth_group')->where("id=".$User["group_id"])->value('rules');
            $rules= explode(',',$rules);
            $select["id"]=array('in',$rules);
        }

        $parentid = (int) $parentid;
        $select["parentid"]=$parentid;
        $select["ismenu"]=1;
        $select["status"]=1;
        $select["type"]=array('in','1,3');
        $result = db('menu')->where($select)->order(array("listorder" => "DESC"))->select();
        if ($with_self) {
            $result2[] = db('menu')->where(array('id' => $parentid))->find();
            $result = array_merge($result2, $result);
        }
     
        return $result;
    }

    /**
     * 获取菜单 头部菜单导航
     * @param $parentid 菜单id
     */
    public function submenu($parentid = '', $big_menu = false) {
        $array = $this->admin_menu($parentid, 1);
        $numbers = count($array);
        if ($numbers == 1 && !$big_menu) {
            return '';
        }
        return $array;
    }

    //验证菜单是否超出三级
    public function checkParentid($parentid) {
        $find = db('menu')->where(array("id" => $parentid))->getField("parentid");
        if ($find) {
            $find2 = db('menu')->where(array("id" => $find))->getField("parentid");
            if ($find2) {
                $find3 = db('menu')->where(array("id" => $find2))->getField("parentid");
                if ($find3) {
                    return false;
                }
            }
        }
        return true;
    }

}