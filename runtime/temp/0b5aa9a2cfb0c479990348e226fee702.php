<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:56:"F:\www\bhwz\2.0.1\public/../app/admin\view\link\type.php";i:1503375394;s:58:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Head.php";i:1514947352;s:59:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Cssjs.php";i:1503375391;s:57:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Nav.php";i:1503375391;s:56:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Js.php";i:1503375391;}*/ ?>
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
    <form method="post"  class="J_ajaxForm">
        <div class="table_list">
            <table width="100%" cellspacing="0">
                <thead>
                <tr>

                    <td width="5%" align="center">排序</td>
                    <td width="5%" align="center" >ID</td>
                    <td width="75%" align="left" >类型名称</td>
                    <td width="15%" align="center" >管理操作</td>
                </tr>
                </thead>
                <tbody>
                <?php echo $categorys; ?>
                </volist>
                </tbody>
            </table>
            <div class="p10">
                <div class="pages">  </div>
            </div>
        </div>

        <div class="btn_wrap">
            <div class="btn_wrap_pd">
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" data-action="<?php echo Url('Admin/Link/typelistorder'); ?>" type="submit" name="submit" value="listorder" >排序</button>

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
</body>
</html>