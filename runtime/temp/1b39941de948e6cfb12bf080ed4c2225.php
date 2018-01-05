<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:59:"F:\www\bhwz\2.0.1\public/../app/super\view\channel\edit.php";i:1514976131;s:58:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Head.php";i:1514947352;s:59:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Cssjs.php";i:1503375391;s:57:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Nav.php";i:1503375391;s:56:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Js.php";i:1503375391;}*/ ?>
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
        <form action="<?php echo Url('super/channel/edit'); ?>" method="post" class="J_ajaxForm">
            <div class="h_a">基本属性</div>
            <div class="table_full">
                <table width="100%" class="table_form contentWrap">
                    <tr >
                        <th width="150">渠道名称</th>
                        <td><input type="text" name="channelName" id="channelName" class="input length_2" value="<?php echo $data['channelName']; ?>"></td>
                    </tr>
                    <tr>
                        <th>渠道登录验证地址</th>
                        <td><input type="text" name="channelLoginUrl" id="channelLoginUrl" class="input length_6" value="<?php echo $data['channelLoginUrl']; ?>"></td>
                    </tr>
                    <tr>
                        <th>状态</th>
                        <td>
                            <ul class="switch_list cc ">
                                <li>
                                    <label>
                                        <input type='radio' name='status' value='1' <?php if($data['status'] == '1'): ?>checked<?php endif; ?>>
                                        <span>开启</span></label>
                                </li>
                                <li>
                                    <label>
                                        <input type='radio' name='status' value='0' <?php if($data['status'] == '0'): ?>checked<?php endif; ?>>
                                        <span>关闭</span></label>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="btn_wrap">
                <div class="btn_wrap_pd">
                    <input type="hidden" name="id" id="id" class="input" value="<?php echo $data['id']; ?>">
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">提交</button>
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