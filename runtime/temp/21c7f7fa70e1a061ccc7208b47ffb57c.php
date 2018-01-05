<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:63:"F:\www\thinkphp\public/../application/admin\view\menu\index.php";i:1497421950;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:63:"F:\www\thinkphp\public/../application/admin\view\Common\Nav.php";i:1500620345;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
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
  <form action="<?php echo Url('Admin/Menu/listorders'); ?>" class="J_ajaxForm" method="post">
    <div class="table_list">
      <table width="100%">
        <colgroup>
        <col width="80">
        <col width="50">
        <col>
        <col width="250">
        <col width="200">
        <col width="150">
        <col width="80">
        <col width="200">
        </colgroup>
        <thead>
          <tr>
            <td>排序</td>
            <td>ID</td>
            <td>名称</td>
            <td>规则</td>
            <td>表达式</td>
             <td>类型</td>
            <td>状态</td>
            <td>管理操作</td>
          </tr>
        </thead>
        <?php echo $categorys; ?>
      </table>
      <div class="p10"></div>
     
    </div>
       <if condition="authcheck('Admin/Menu/listorders')">
                 <div class="btn_wrap">
      <div class="btn_wrap_pd">             
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">排序</button>
      </div>
    </div>
              </if>
    
  
  </form>
</div>
<script src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/layui/layui.js"></script>
<script src="/static/admin/js/laydate/laydate.js"></script>
<script src="/static/admin/js/tabs.js"></script>
<script src="/static/admin/js/ajaxForm.js"></script>
<script src="/static/admin/js/common.js"></script>
</body>
</html>