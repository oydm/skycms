<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:63:"F:\www\thinkphp\public/../application/admin\view\logs\login.php";i:1497435756;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:63:"F:\www\thinkphp\public/../application/admin\view\Common\Nav.php";i:1500620345;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
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
 <!-- -->
  <div class="h_a">搜索</div>
  <form method="post" action="<?php echo Url('Admin/Logs/login'); ?>">
  <div class="search_type cc mb10">
    <div class="mb10"> <span class="mr20">
              搜索类型：
    <select class="select_2" name="status" style="width:70px;">
                <option value='' <?php if(\think\Request::instance()->post('status') == ''): ?>selected<?php endif; ?>>不限</option>
                <option value="1" <?php if(\think\Request::instance()->post('status') == '1'): ?>selected<?php endif; ?>>成功</option>
                <option value="2" <?php if(\think\Request::instance()->post('status') == '2'): ?>selected<?php endif; ?>>失败</option>
              
      </select>
      用户ID：<input type="text" class="input length_2" name="uid" size='10' value="<?php echo \think\Request::instance()->post('uid'); ?>" placeholder="用户ID">
      IP：<input type="text" class="input length_2" name="ip" size='20' value="<?php echo \think\Request::instance()->post('ip'); ?>" placeholder="IP">
    时间：
      <input type="text" name="start_time" class="input length_2 J_date" value="<?php echo \think\Request::instance()->post('start_time'); ?>" style="width:80px;">
      -
      <input type="text" class="input length_2 J_date" name="end_time" value="<?php echo \think\Request::instance()->post('end_time'); ?>" style="width:80px;">
      <button class="btn">搜索</button>
      <a class="J_ajax_del btn" name="del_log_4" href="<?php echo Url('Admin/Logs/logindel'); ?>" >删除一月前数据</a>
      </span> </div>
      </form> 
  </div>
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="center" width="80">ID</td>
            <td  align="center">用户名</td>
            <td align="center">密码</td>
            <td align="center">状态</td>
            <td align="center">其他说明</td>
            <td align="center" width="120">时间</td>
            <td align="center" width="120">IP</td>
          </tr>
        </thead>
        <tbody>
          <?php if(is_array($logs) || $logs instanceof \think\Collection): $i = 0; $__LIST__ = $logs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
              <td align="center"><?php echo $vo['loginid']; ?></td>
            <td align="center"><?php echo $vo['username']; ?></td>
            <td align="center"><?php echo $vo['password']; ?></td>
            <td align="center"><?php if($vo['status'] == 1): ?>登陆成功<?php else: ?><font color="#FF0000">登陆失败</font><?php endif; ?></td>
            <td align="center"><?php echo $vo['info']; ?></td>
            <td align="center"><?php echo $vo['logintime']; ?></td>
            <td align="center"><?php echo $vo['loginip']; ?></td>
            </tr>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
      <div class="p10">
        <div class="pages"> <?php echo $Page; ?> </div>
      </div>
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