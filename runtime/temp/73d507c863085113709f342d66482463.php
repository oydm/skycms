<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:67:"F:\www\bhwz\2.0.1\public/../app/admin\view\appointment\giftlist.php";i:1504938225;s:58:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Head.php";i:1514947352;s:59:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Cssjs.php";i:1503375391;s:57:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Nav.php";i:1503375391;s:56:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Js.php";i:1503375391;}*/ ?>
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
                    <td><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></td>
                    <td align="center" width="10%">ID</td>
                    <td align="center" width="20%" >时间</td>
                    <td align="left" width="40%">礼包激活码</td>
                    <td align="center" width="10%">礼包状态</td>
                    <td width="20%" align="center" >管理操作</td>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($gift) || $gift instanceof \think\Collection): $i = 0; $__LIST__ = $gift;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="<?php echo $vo['id']; ?>"></td>
                    <td align="center"><?php echo $vo['id']; ?></td>
                    <td align="center"><?php echo $vo['adate']; ?></td>
                    <td align="left"><?php echo $vo['code']; ?></td>
                    <td align="center">
                        <?php if($vo['status'] == 0): ?> <span style="color: red">未发放</span><?php endif; if($vo['status'] == 1): ?> <span style="color: green">已发放</span><?php endif; ?>
                    </td>
                    <td align="center" >
                        <a href="<?php echo Url('Admin/Appointment/giftdelete',array('id'=>$vo['id'])); ?>" style="color: red" class="J_ajax_del">删除</a>
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
                <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="<?php echo Url('Admin/Appointment/giftdel'); ?>" type="submit" name="submit" value="del">删除</button>
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