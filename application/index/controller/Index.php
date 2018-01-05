<?php
namespace app\index\controller;
use think\Controller;
use think\Config;
use think\Page;

class Index extends Controller{
    public function index(){
        $count = db("Article")->where('catid=16 and status=1')->count();
        $page = new Page($count, 3);
        $data=db("article")->where('catid=16 and status=1')->order('listorder desc,id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        foreach ($data as $k => $r) {
            $data[$k]["sortitle"] = $this->str_cut($r["title"], 22);
        }
        $this->assign("data",$data);
        $this->assign("cur_page",1);
        return $this->fetch();
    }

    public function get_index_new(){
        $count = db("Article")->where('catid=16 and status=1')->count();
        $page = new Page($count, 3);
        $data=db("article")->where('catid=16 and status=1')->order('listorder desc,id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        $html='';
        if(count($data)<=0){
            return json_encode(array('code'=>-1,"msg"=>"没有数据了"));
        }
        $i=1;
        foreach ($data as $k => $r) {
            $noli_ubderline='';
            if($i==3){
                $noli_ubderline='noli_ubderline';
            }
            $html.='<li class="index_new_li '.$noli_ubderline.'">
                        <span class="index_new_content">
                            <a  href="/news/'.$r['id'].'">'.$this->str_cut($r['title'],22).'</a>
                            <i>'.date('m-d',$r['inputtime']).'</i>
                        </span>
                    </li>';
            $i++;
        }
        return json(array('code'=>1,"html_data"=>$html,'cur_page'=>input("p")));
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
