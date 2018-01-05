<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:64:"F:\www\thinkphp\public/../application/admin\view\expand\area.php";i:1501057492;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:63:"F:\www\thinkphp\public/../application/admin\view\Common\Nav.php";i:1500620345;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
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
  <form action="<?php echo Url('Admin/Expand/arealistorder'); ?>" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%">
        <colgroup>
        <col width="80">
        <col width="200">
        <col>
        <col width="300">
        <col width="300">
        </colgroup>
        <thead>
          <tr>
            <td align='center'>排序</td>
            <td align='center'>ID</td>
            <td align='center'>名称</td>
            <td align='center'>状态</td>
            <td align='center'>管理操作</td>
          </tr>
        </thead>
        <?php if(is_array($data) || $data instanceof \think\Collection): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td align='center'><input name='listorders[<?php echo $vo['id']; ?>]' type='text' size='3' value='<?php echo $vo['listorder']; ?>' class='input'></td>
                <td align='center'><?php echo $vo['id']; ?></td>
                              <td align='center'><?php echo $vo['name']; ?></td>
                              <td align='center'><?php if($vo['status'] == 1): ?><span style="color: green">启用</span><?php else: ?> <span style="color: red">禁用</span><?php endif; ?></td>
                <td align='center'>
                                    <a href="<?php echo Url('Admin/Expand/area', array('parentid' => $vo['id'])); ?>">管理子菜单</a>   |
                                   <a href="<?php echo Url('Admin/Expand/areaadd', array('parentid' => $vo['id'])); ?>">添加子菜单</a> |
                                    <a href="<?php echo Url('Admin/Expand/areaedit', array('id' => $vo['id'])); ?>">修改</a>  |
                                    <a class="J_ajax_del" href="<?php echo Url('Admin/Expand/areadel', array('id' => $vo['id'])); ?>">删除</a>
                               </td>
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
      <div class="p10"><div class="pages"> <?php echo $Page; ?> </div> </div>
    </div>
        <div class="btn_wrap">
          <div class="btn_wrap_pd">
            <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">排序</button>
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