<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:63:"F:\www\thinkphp\public/../application/admin\view\role\index.php";i:1497429377;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:63:"F:\www\thinkphp\public/../application/admin\view\Common\Nav.php";i:1500620345;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
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
   <div class="table_list">
     <table width="100%" cellspacing="0">
      <thead>
        <tr>
          <td width="20">ID</td>
          <td width="200"  align="left" >角色名称</td>
          <td align="left" >角色描述</td>
          <td width="50"  align="left" >状态</td>
          <td width="300">管理操作</td>
        </tr>
      </thead>
      <tbody>
      <?php if(is_array($data) || $data instanceof \think\Collection): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
          <td width="10%" align=""><?php echo $vo['id']; ?></td>
          <td width="15%"  ><?php echo $vo['title']; ?></td>
          <td ><?php echo $vo['remark']; ?></td>
          <td width="5%">
          <?php if($vo['status'] == 1): ?>
          <font color="red">√</font>
          <?php else: ?>
          <font color="red">╳</font>
          <?php endif; ?>
          </td>
          <td  class="text-c">
          <?php if($vo['id'] == 1): ?> 
          <font color="#cccccc">权限设置</font> | <a href="<?php echo Url('Admin/Manager/index',array('group_id'=>$vo['id'])); ?>">成员管理</a> | <font color="#cccccc">修改</font> | <font color="#cccccc">删除</font>
          <?php else: ?>
            <a href="<?php echo Url('Admin/Role/auth',array('id'=>$vo['id'])); ?>">权限设置</a> | <a href="<?php echo Url('Admin/Manager/index',array('group_id'=>$vo['id'])); ?>">成员管理</a> | <a href="<?php echo Url('Admin/Role/edit',array('id'=>$vo['id'])); ?>">修改</a> | <a href="<?php echo Url('Admin/Role/delete',array('id'=>$vo['id'])); ?>" class="J_ajax_del">删除</a> 
          <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
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