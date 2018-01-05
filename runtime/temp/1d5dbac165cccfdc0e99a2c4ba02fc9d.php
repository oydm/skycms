<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:60:"F:\www\bhwz\2.0.1\public/../app/super\view\game\game_add.php";i:1514968562;s:58:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Head.php";i:1514947352;s:59:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Cssjs.php";i:1503375391;s:57:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Nav.php";i:1503375391;s:56:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Js.php";i:1503375391;}*/ ?>
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
        <form action="<?php echo Url('super/game/game_add'); ?>" method="post" class="J_ajaxForm">
            <div class="h_a">基本属性</div>
            <div class="table_full">
                <table width="100%" class="table_form contentWrap">
                    <tr >
                        <th width="150">游戏名称</th>
                        <td><input type="text" name="gameName" id="gameName" class="input length_6" value=""></td>
                    </tr>
                    <!--<tr>
                        <th>支付回调地址</th>
                        <td><input type="text" name="gamePayNotify" id="gamePayNotify" class="input length_6" value=""></td>
                    </tr>-->
                    <tr>
                        <th>打包支付渠道为</th>
                        <td>
                            <select class="select_2" name="channelId">
                                <option value="" >请选择支付渠道</option>
                                <?php if(is_array($channel) || $channel instanceof \think\Collection): $i = 0; $__LIST__ = $channel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $vo['id']; ?>" ><?php echo $vo['channelName']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>对应SDK的游戏ID</th>
                        <td><input type="text" name="sdkGameId" id="sdkGameId" class="input length_4" value="0"></td>
                    </tr>
                </table>
            </div>
            <div class="h_a">渠道参数</div>
            <div class="table_full">
                <table width="100%" class="table_form contentWrap">
                    <tr >
                        <th width="150">渠道AppID</th>
                        <td><input type="text" name="channelAppId" id="channelAppId" class="input length_2" value=""></td>
                    </tr>
                    <tr>
                        <th>渠道秘钥AppSecret</th>
                        <td><input type="text" name="channelAppSecret" id="channelAppSecret" class="input length_6" value=""></td>
                    </tr>
                    <tr>
                        <th>渠道支付回调地址</th>
                        <td><input type="text" name="channelgamePayNotify" id="channelgamePayNotify" class="input length_6" value=""></td>
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
</body>
</html>