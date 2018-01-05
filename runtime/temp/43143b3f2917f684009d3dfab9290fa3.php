<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:62:"F:\www\thinkphp\public/../application/admin\view\menu\edit.php";i:1497422732;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:63:"F:\www\thinkphp\public/../application/admin\view\Common\Nav.php";i:1500620345;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
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
  <div class="common-form">
  <!---->
    <form method="post" action="<?php echo Url('Admin/Menu/edit'); ?>" class="J_ajaxForm">
      <div class="h_a">菜单信息</div>
      <div class="table_list">
        <table cellpadding="0" cellspacing="0" class="table_form" width="100%">
          <tbody>
            <tr>
              <td width="140">上级:</td>
              <td>
                  <input type="hidden" class="input" name="id" id="title" value="<?php echo $data['id']; ?>" >
                  <select name="parentid">
                  <option value="0">作为一级菜单</option>          
                     <?php echo $select_categorys; ?>  
                </select></td>
            </tr>
            <tr>
              <td>名称:</td>
              <td><input type="text" class="input" name="title" id="title" value="<?php echo $data['title']; ?>" ></td>
            </tr>
            <tr>
              <td>规则:</td>
              <td><input type="text" class="input" name="name" id="name" value="<?php echo $data['name']; ?>"> <span class="gray">模块/控制器/方法 例 Admin/index/index</span></td>
            </tr>
            <tr>
              <td>规则表达式:</td>
              <td><input type="text" class="input" name="condition" id="condition" value="<?php echo $data['condition']; ?>"> <span class="gray">例如：score<100 积分小于100</span></td>
            </tr>
           
            <tr>
              <td>备注:</td>
              <td><textarea name="remark" rows="5" cols="57"><?php echo $data['title']; ?></textarea></td>
            </tr>
            <tr>
              <td>状态:</td>
              <td><select name="ismenu">
                  <option value="1" <?php if($data['ismenu'] == '1'): ?>selected<?php endif; ?> >显示</option>
                  <option value="0" <?php if($data['ismenu'] == '0'): ?>selected<?php endif; ?> >不显示</option>
                </select></td>
            </tr>
            <tr>
              <td>权限状态:</td>
              <td><select name="status">
                  <option value="1" <?php if($data['status'] == '1'): ?>selected<?php endif; ?> >启用</option>
                  <option value="0" <?php if($data['status'] == '0'): ?>selected<?php endif; ?> >禁用</option>
                </select></td>
            </tr>
            <tr>
              <td>类型:</td>
              <td><select name="type">
                  <option value="3" <?php if($data['type'] == '3'): ?>selected<?php endif; ?>>权限认证+菜单</option>
                  <option value="2" <?php if($data['type'] == '2'): ?>selected<?php endif; ?>>只作为权限认证</option>
                  <option value="1" <?php if($data['type'] == '1'): ?>selected<?php endif; ?>>只作为菜单</option>
                </select>
              <span class="gray">  注意：“权限认证+菜单”表示加入后台权限管理，纯碎是菜单项请不要选择此项。</span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="">
        <div class="btn_wrap_pd">
          <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">修改</button>
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