<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:66:"F:\www\bhwz\2.0.1\public/../app/admin\view\investigation\index.php";i:1508211724;s:58:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Head.php";i:1514947352;s:59:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Cssjs.php";i:1503375391;s:57:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Nav.php";i:1503375391;s:56:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Js.php";i:1503375391;}*/ ?>
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

    <div class="h_a">搜索</div>
    <form method="post" action="<?php echo Url('Admin/Investigation/index'); ?>">
        <div class="search_type cc mb10">
    时间：
      <input type="text" name="start_time" class="input length_2 J_date" value="<?php echo \think\Request::instance()->post('start_time'); ?>" style="width:80px;">
      -
      <input type="text" class="input length_2 J_date" name="end_time" value="<?php echo \think\Request::instance()->post('end_time'); ?>" style="width:80px;">
      <button class="btn">搜索</button>
      <a href="<?php echo Url('Admin/Investigation/export'); ?>" class="btn">问卷导出</a>
    
     </div>
    </form>
    <form action="" class="J_ajaxForm" method="post" >
<div class="table_list">
    <table width="100%" cellspacing="0">
        <thead>
        <tr>
            <td><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></td>
            <td align="center" width="10%">ID</td>
            <td align="center" width="15%">开始时间</td>
            <td align="center" width="15%">结束时间</td>
            <td align="center" width="10%">时长(s)</td>
            <td align="center" width="5%">角色ID</td>
            <td align="center" width="5%">服务器ID</td>
            <td align="center" width="15%">姓名/联系方式</td>
            <td align="center" width="15%">礼包状态</td>
            <td width="15%" align="center" >管理操作</td>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($logs) || $logs instanceof \think\Collection): $i = 0; $__LIST__ = $logs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="<?php echo $vo['id']; ?>"></td>
            <td align="center"><?php echo $vo['id']; ?></td>
            <td align="center"><?php echo $vo['begin_time']; ?></td>
            <td align="center"><?php echo $vo['adate']; ?></td>
            <td align="center"><?php if($vo['begin_time']){echo (strtotime($vo['adate'])-strtotime($vo['begin_time']));}else{echo 0;}?></td>
            <td align="center"><?php echo $vo['roleId']; ?></td>
            <td align="center"><?php echo $vo['serverId']; ?></td>
            <td align="center"><?php echo $vo['contact']; ?></td>
            <td align="center">
                <?php if($vo['is_send'] == 0): ?> <span style="color: red">未发放</span><?php endif; if($vo['is_send'] == 1): ?> <span style="color: green">已发放</span><?php endif; ?>
            </td>
            <td align="center" >
                <a href="<?php echo Url('Admin/Investigation/gift',array('id'=>$vo['id'])); ?>" class="J_ajax_url">发送奖励</a> |
                <a href="<?php echo Url('Admin/Investigation/see',array('id'=>$vo['id'])); ?>" title="查看问卷答案" data-width="500" class="J_dialog">查看问卷答案</a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="p10">
        <div class="pages"> <?php echo $Page; ?> </div>
    </div>
</div>
    <div class="btn_wrap">
        <div class="btn_wrap_pd">
            <label class="mr20"><input type="checkbox" class="J_check_all" data-direction="y" data-checklist="J_check_y">全选</label>
            <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="<?php echo Url('Admin/Investigation/giftall'); ?>" type="submit" name="submit" value="del">批量发送奖励</button>

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