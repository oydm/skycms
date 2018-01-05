<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:64:"F:\www\bhwz\2.0.1\public/../app/admin\view\appointment\index.php";i:1504930933;s:58:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Head.php";i:1514947352;s:59:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Cssjs.php";i:1503375391;s:57:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Nav.php";i:1503375391;s:56:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Js.php";i:1503375391;}*/ ?>
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
    <form method="post" action="<?php echo Url('Admin/Appointment/index'); ?>">
        <div class="search_type cc mb10">
      渠道：<input type="text" class="input length_2" name="channel" size='10' value="<?php echo \think\Request::instance()->post('channel'); ?>" placeholder="渠道号">
    时间：
      <input type="text" name="start_time" class="input length_2 J_date" value="<?php echo \think\Request::instance()->post('start_time'); ?>" style="width:80px;">
      -
      <input type="text" class="input length_2 J_date" name="end_time" value="<?php echo \think\Request::instance()->post('end_time'); ?>" style="width:80px;">
      <button class="btn">搜索</button>
     </div>
    </form>
    <form action="" class="J_ajaxForm" method="post" >
<div class="table_list">
    <table width="100%" cellspacing="0">
        <thead>
        <tr>
            <td><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></td>
            <td align="center" width="10%">ID</td>
            <td align="center" width="20%" >时间</td>
            <td align="center" width="15%">渠道号</td>
            <td align="left" >手机号码</td>
            <td align="center" >礼包状态</td>
            <td width="15%" align="center" >管理操作</td>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($logs) || $logs instanceof \think\Collection): $i = 0; $__LIST__ = $logs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="<?php echo $vo['id']; ?>"></td>
            <td align="center"><?php echo $vo['id']; ?></td>
            <td align="center"><?php echo $vo['adate']; ?></td>
            <td align="center"><?php echo $vo['channel']; ?></td>
            <td align="left"><?php echo $vo['phone']; ?></td>
            <td align="center">
                <?php if($vo['status'] == 0): ?> <span style="color: red">未发送</span><?php endif; if($vo['status'] == 1): ?> <span style="color: green">已发送</span><?php endif; ?>
            </td>
            <td align="center" >
                <a href="<?php echo Url('Admin/Appointment/gift',array('id'=>$vo['id'])); ?>" class="J_ajax_url">发送预约礼包</a> |
                <a href="<?php echo Url('Admin/Appointment/delete',array('id'=>$vo['id'])); ?>" style="color: red" class="J_ajax_del">删除</a>
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
            <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="<?php echo Url('Admin/Appointment/del'); ?>" type="submit" name="submit" value="del">删除</button>
            <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="<?php echo Url('Admin/Appointment/giftall'); ?>" type="submit" name="submit" value="del">批量发送礼包</button>
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