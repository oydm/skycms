<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:58:"F:\www\bhwz\2.0.1\public/../app/super\view\order\order.php";i:1514947480;s:58:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Head.php";i:1514947352;s:59:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Cssjs.php";i:1503375391;s:57:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Nav.php";i:1503375391;s:56:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Js.php";i:1503375391;}*/ ?>
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
            <td align="center" width="8%">时间</td>
            <td align="center" width="5%" >所属游戏</td>
            <td align="left" width="10%" >用户ID</td>
            <td align="center" width="5%" >下单渠道</td>
            <td align="center" width="10%">订单名称</td>
            <td align="center" width="5%">价格（分）</td>
            <td align="center" width="8%">订单号</td>
            <td align="center" width="12%">游戏订单号</td>
            <td align="center" width="12%">渠道订单号</td>
            <td align="center" width="5%">订单结果</td>
            <td align="center" width="5%">通知结果</td>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($logs) || $logs instanceof \think\Collection): $i = 0; $__LIST__ = $logs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td align="center"><?php echo $vo['adate']; ?></td>
            <td align="center"><?php echo $vo['gameName']; ?></td>
            <td align="left">SDK：<?php echo $vo['sdkId']; ?><br>渠道用户ID：<?php echo $vo['channelUser']; ?></td>
            <td align="center"><?php if($vo['channelId'] == '1'): ?>wemePay<?php endif; if($vo['channelId'] == '2'): ?>Ftx平台<?php endif; ?></td>
            <td align="center"><?php echo $vo['orderName']; ?></td>
            <td align="center"><?php echo $vo['orderAmount']; ?></td>
            <td align="center"><?php echo $vo['orderSn']; ?></td>
            <td align="center"><?php echo $vo['gameOrderSn']; ?></td>
            <td align="center"><?php echo $vo['channelOrderSn']; ?></td>
            <td align="center"><?php if($vo['orderStatus'] == '1'): ?><span style="color: green">支付成功</span><?php endif; if($vo['orderStatus'] == '-1'): ?><span style="color: red">支付失败</span><?php endif; if($vo['orderStatus'] == '0'): ?><span style="color: blue">未知</span><?php endif; ?></td>
            <td align="center"><?php if($vo['notifyStatus'] == '1'): ?><span style="color: green">通知成功</span><?php endif; if($vo['notifyStatus'] == '0'): ?><span style="color: red">未通知/通知失败</span><?php endif; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
        <div class="p10">
            <div class="pages"> <?php echo $Page; ?> </div>
        </div>
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