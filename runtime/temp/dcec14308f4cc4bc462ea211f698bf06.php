<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:67:"F:\www\thinkphp\public/../application/admin\view\category\index.php";i:1501139542;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:63:"F:\www\thinkphp\public/../application/admin\view\Common\Nav.php";i:1500620345;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
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
 <div class="h_a">温馨提示</div>
  <div class="prompt_text">
    <p>1、栏目<font color="blue">ID</font>为<font color="blue">蓝色</font>才可以添加内容。可以使用“属性转换”进行转换！</p>
    <p>2、终极栏目不能添加子栏目</p>
    <p>3、排序按照排序数值倒序排列</p>
    <p>4、外部链接不能进行“属性转换”</p>
  </div>
 <!-- -->
   <form name="myform" action="<?php echo Url('Admin/Category/listorder'); ?>" method="post" class="J_ajaxForm">
  <div class="table_list">
    <table width="100%" class="table_form">
        <colgroup>
        <col width="80">
        <col width="80">
        <col>
        <col width="100">
        <col width="100">
        <col width="100">
        <col width="100" >
        <col width="300">
        </colgroup>
        <thead>
          <tr>
            <td align='center'>排序</td>
            <td align='center'>栏目ID</td>
            <td>栏目名称</td>
            <td align='center'>栏目类型</td>
            <td align='center'>所属模型</td>
            <td align='center'>是否显示</td>
            <td align='center'>是否终极</td>
            <td align='center'>管理操作</td>
          </tr>
        </thead>
        <?php echo $categorys; ?>
      </table>
    <div class="btn_wrap">
      <div class="btn_wrap_pd">
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">排序</button>
      </div>
    </div>
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