<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:65:"F:\www\thinkphp\public/../application/admin\view\manager\edit.php";i:1497426836;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:63:"F:\www\thinkphp\public/../application/admin\view\Common\Nav.php";i:1500620345;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
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
    <form method="post" action="<?php echo Url('Admin/Manager/edit'); ?>" class="J_ajaxForm">
      <div class="h_a">基本信息</div>
      <div class="table_full">
        <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80">用户名</th>
            <td> <input type="hidden" name="id" value="<?php echo $data['id']; ?>"/>
                <input type="text" name="username" class="input" id="username" value="<?php echo $data['username']; ?>">
              <span class="gray">请输入用户名</span></td>
          </tr>
          <tr>
            <th>密码</th>
            <td><input type="password" name="password" class="input" id="password" value="">
              <span class="gray">请输入密码</span></td>
          </tr>
          <tr>
            <th>确认密码</th>
            <td><input type="password" name="pwdconfirm" class="input" id="pwdconfirm" value="">
              <span class="gray">请输入确认密码</span></td>
          </tr>
          <tr>
            <th>E-mail</th>
            <td><input type="text" name="email" class="input" id="email" value="<?php echo $data['email']; ?>" size="30">
              <span class="gray">请输入E-mail</span></td>
          </tr>
          <tr>
            <th>真实姓名</th>
            <td><input type="text" name="nickname" class="input" id="nickname"  value="<?php echo $data['nickname']; ?>" ></td>
          </tr>
          <tr>
          <th>备注</th>
          <td><textarea name="content" rows="2" cols="20" id="content" class="inputtext" style="height:100px;width:500px;"><?php echo $data['content']; ?> </textarea></td>
        </tr>
          <tr>
            <th>所属角色</th>
            <td>
            <select name="group_id">
                <?php if(is_array($role) || $role instanceof \think\Collection): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['id']; ?>" <?php if($data['group_id'] == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['title']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </select></td>
          </tr>
          <tr>
          <th>状态</td>
          <td><select name="status">
                <option value="1" <?php if($data['status'] == 1): ?>selected<?php endif; ?>>开启</option>
                <option value="0" <?php if($data['status'] == 0): ?>selected<?php endif; ?>>禁止</option>
          </select></td>
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