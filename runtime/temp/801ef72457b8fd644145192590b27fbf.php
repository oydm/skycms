<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:66:"F:\www\thinkphp\public/../application/admin\view\manager\index.php";i:1497424780;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:63:"F:\www\thinkphp\public/../application/admin\view\Common\Nav.php";i:1500620345;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
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
            <td width="5%">序号</td>
            <td width="10%" align="left" >用户名</td>
            <td width="10%" align="left" >所属角色</td>
            <td width="15%"  align="left" >最后登录IP</td>
            <td width="15%"  align="left" >最后登录时间</td>
            <td width="15%"  align="left" >E-mail</td>
            <td width="15%">备注</td>
            <td width="15%" >管理操作</td>
          </tr>
        </thead>
        <tbody>
        <?php if(is_array($Userlist) || $Userlist instanceof \think\Collection): $i = 0; $__LIST__ = $Userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <tr>
            <td width="5%" align="left"><?php echo $vo['id']; ?></td>
            <td width="10%" align="left"><?php echo $vo['username']; ?></td>
            <td width="10%" align="left"><?php echo $vo['role_name']; ?></td>
            <td width="15%" align="left"><?php echo $vo['lastlogin_ip']; ?></td>
            <td width="10%"  align="left">
            <?php if($vo['lastlogin_time'] == 0): ?>
            该用户还没登陆过
            <?php else: ?>
            <?php echo date("Y-m-d H:i:s",$vo['lastlogin_time']); endif; ?>
            </td>
            <td width="15%" align="left"><?php echo $vo['email']; ?></td>
            <td width="20%"  align="left"><?php echo $vo['content']; ?></td>
            <td width="15%"  align="left">
                <a href="<?php echo Url('Admin/Manager/edit',array('id'=>$vo['id'])); ?>">修改</a>
             | 
                <a href="<?php echo Url('Admin/Manager/delete',array('id'=>$vo['id'])); ?>" class="J_ajax_del">删除</a>
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