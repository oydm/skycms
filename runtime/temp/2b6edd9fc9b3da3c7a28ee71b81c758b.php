<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:66:"F:\www\bhwz\2.0.1\public/../app/super\view\version\version_add.php";i:1514965584;s:58:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Head.php";i:1514947352;s:59:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Cssjs.php";i:1503375391;s:57:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Nav.php";i:1503375391;s:56:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Js.php";i:1503375391;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>系统管理后台</title>
<link href="/static/admin/css/admin_style.css" rel="stylesheet" />
<link href="/static/admin/js/layui/css/layui.css" rel="stylesheet" />
</head>
<body class="J_scroll_fixed">
<div class="wrap jj">
    <?php 
$Menu = \app\admin\controller\Common::getMenu(); 
$getMenu=$Menu['getMenu'];
$cur_action=$Menu['action'];
$menuReturn=$Menu['menuReturn'];
if($getMenu) {
 ?>
<div class="nav">
<?php
  if(!empty($menuReturn)){
	  echo '<div class="return"><a href="'.$menuReturn['url'].'">'.$menuReturn['name'].'</a></div>';
  }
  ?>
  <ul class="cc">
    <?php
	foreach($getMenu as $r){
		$name = $r['name'];
		$app=explode("/",$r['name']);
        $action=$app[2];
	?>
    <li <?php echo $action==$cur_action?'class="current"':""; ?>><a href="<?php echo Url("".$name."");?>"><?php echo $r['title'];?></a></li>
    <?php
	}
	?>
  </ul>
</div>
<?php } ?>
    <div class="common-form">
        <form action="<?php echo Url('super/version/version_add'); ?>" method="post" class="J_ajaxForm">
            <div class="h_a">基本属性</div>
            <div class="table_full">
                <table width="100%" class="table_form contentWrap">
                    <tr >
                        <th width="100">游戏名称</th>
                        <td>
                            <select class="select_2" name="gameId">
                                <option value="" >请选择游戏</option>
                                <?php if(is_array($data) || $data instanceof \think\Collection): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $vo['sdkGameId']; ?>" ><?php echo $vo['gameName']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>更新渠道</th>
                        <td>
                            <select class="select_2" name="channelId">
                                <option value="" >请选择更新渠道</option>
                                <?php if(is_array($channel) || $channel instanceof \think\Collection): $i = 0; $__LIST__ = $channel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $vo['id']; ?>" ><?php echo $vo['channelName']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>更换类型</th>
                        <td>
                            <select class="select_2" name="type">
                                <option value="" >请选择更新类型</option>
                                <option value="1">热更</option>
                                <option value="2">整包更新</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>游戏版本号</th>
                        <td><input type="text" name="gameVersion" id="gameVersion" class="input length_3" value=""></td>
                    </tr>
                    <tr>
                        <th>整包安装版本号</th>
                        <td><input type="text" name="androidVersion" id="androidVersion" class="input length_3" value=""></td>
                    </tr>
                    <tr>
                        <th>更新大小</th>
                        <td><input type="text" name="updateSize" id="updateSize" class="input length_3" value="">M</td>
                    </tr>
                    <tr>
                        <th>更新时间</th>
                        <td><input type="text" class="input length_3 J_datetime laydate-icon" name="updateTime" value="" style="width:150px;"></td>
                    </tr>
                    <tr>
                        <th>更新包地址</th>
                        <td><input type="text" class="input length_6" name="updateUrl" value="" style="width:500px;"> 多地址用逗号,分开 <A href="<?php echo Url('super/super/upload'); ?>" target="_blank" style="color: red;font-weight: bold">点击打开上传包地址</A></td>
                    </tr>
                    <tr>
                        <th>更新内容</th>
                        <td><textarea  name="updateInfo" id="content"></textarea></td>
                    </tr>
                    <tr>
                        <th>状态</th>
                        <td>
                            <ul class="switch_list cc ">
                                <li>
                                  <label>
                                    <input type='radio' name='status' value='1' checked>
                                    <span>开启</span></label>
                                </li>
                                <li>
                                  <label>
                                    <input type='radio' name='status' value='0'>
                                    <span>关闭</span></label>
                                </li>
                              </ul>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="btn_wrap">
                <div class="btn_wrap_pd">
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/layui/layui.js"></script>
<script src="/static/admin/js/laydate/laydate.js"></script>
<script src="/static/admin/js/tabs.js"></script>
<script src="/static/admin/js/ajaxForm.js"></script>
<script src="/static/admin/js/common.js"></script>
<script src="/static/admin/js/content.js"></script>
    <link rel="stylesheet" href="/static/admin/js/editor/themes/default/default.css" />
    <script charset="utf-8" src="/static/admin/js/editor/kindeditor.js"></script>
    <script charset="utf-8" src="/static/admin/js/editor/lang/zh-CN.js"></script>
    <script>
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="updateInfo"]', {
                resizeType : 1,
                width:'500px',
                height:'300px',
                allowPreviewEmoticons : false,
                allowImageUpload : true,
                uploadJson:'/Admin/Upload/imgedit.html',
                items : [
                    'source','fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright'],
                afterBlur: function(){  //利用该方法处理当富文本编辑框失焦之后，立即同步数据
                    KindEditor.sync("#content") ;
                }
            });
        });
    </script>
</body>
</html>