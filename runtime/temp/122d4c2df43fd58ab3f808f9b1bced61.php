<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:62:"F:\www\bhwz\2.0.1\public/../app/super\view\channel\channel.php";i:1514969633;s:58:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Head.php";i:1514947352;s:59:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Cssjs.php";i:1503375391;s:57:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Nav.php";i:1503375391;s:56:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Js.php";i:1503375391;}*/ ?>
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
<div class="wrap J_check_wrap">
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
    <form action="" class="J_ajaxForm" method="post" >
<div class="table_list">
    <table width="100%" cellspacing="0">
        <thead>
        <tr>
            <td align="center" width="5%">ID</td>
            <td align="center" width="8%" >当前游戏</td>
            <td align="center" width="5%" >打包渠道</td>
            <td align="center" width="5%">当前渠道</td>
            <td align="center" width="5%">渠道AppID</td>
            <td align="center" width="25%">渠道秘钥</td>
            <td align="center">渠道支付回调地址</td>
            <td width="15%" width="5%" align="center" >管理操作</td>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($logs) || $logs instanceof \think\Collection): $i = 0; $__LIST__ = $logs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td align="center"><?php echo $vo['id']; ?></td>
            <td align="center"><?php echo $gameName; ?></td>
            <td align="center"><?php echo $vo['channelName']; ?></td>
            <td align="center"><?php echo $vo['changeChannelName']; ?></td>
            <td align="center"><?php echo $vo['channelAppId']; ?></td>
            <td align="center"><?php echo $vo['channelAppSecret']; ?></td>
            <td align="center"><?php echo $vo['channelgamePayNotify']; ?></td>
            <td align="center" >
                <a href="<?php echo Url('Super/channel/channel_edit',array('id'=>$vo['id'])); ?>" >编辑</a> |
                <a href="<?php echo Url('Super/channel/channel_del',array('id'=>$vo['id'])); ?>" style="color: red" class="J_ajax_del">删除</a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
    </form>
</div>
<script src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/layui/layui.js"></script>
<script src="/static/admin/js/laydate/laydate.js"></script>
<script src="/static/admin/js/tabs.js"></script>
<script src="/static/admin/js/ajaxForm.js"></script>
<script src="/static/admin/js/common.js"></script>
<script src="/static/admin/js/content.js"></script>
</body>
</html>