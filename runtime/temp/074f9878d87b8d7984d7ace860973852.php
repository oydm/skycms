<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:65:"F:\www\thinkphp\public/../application/admin\view\config\index.php";i:1501901857;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:63:"F:\www\thinkphp\public/../application/admin\view\Common\Nav.php";i:1500620345;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
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
        <div class="h_a">站点配置</div>
             <form method='post' class="J_ajaxForm" action="<?php echo Url('Admin/Config/index'); ?>">
             <div class="table_full">
                <table cellpadding=0 cellspacing=0 width="100%" class="table_form" >
                    <tr>
                        <th width="140">站点名称:</th>
                        <td><input type="text" class="input"  name="sitename" value="<?php echo $Site['sitename']; ?>" size="40"></td>
                    </tr>
                    <tr>
                        <th width="140">网站域名:</th>
                        <td><input type="text" class="input"  name="siteurl" value="<?php echo $Site['siteurl']; ?>" size="40"> <span class="gray"> 请以“/”结尾，当前域名 <?php echo $URL; ?></span></td>
                    </tr>
                     <tr>
                        <th width="140">网站标题:</th>
                        <td><input type="text" class="input"  name="sitetitle" value="<?php echo $Site['sitetitle']; ?>" size="40"></td>
                    </tr>
                    <tr>
                        <th width="140">网站关键字:</th>
                        <td><input type="text" class="input"  name="sitekeywords" value="<?php echo $Site['sitekeywords']; ?>" size="40"> </td>
                    </tr>
                    <tr>
                        <th width="140">网站描述:</th>
                        <td><textarea name="sitedescription" style="width:350px; height:100px;"><?php echo $Site['sitedescription']; ?></textarea> </td>
                    </tr>
                     <tr>
                        <th width="140">网站电话:</th>
                        <td><input type="text" class="input"  name="sitetel" value="<?php echo $Site['sitetel']; ?>" size="40"> </td>
                    </tr>
                    <tr>
                        <th width="140">公司地址:</th>
                        <td><input type="text" class="input"  name="siteaddress" value="<?php echo $Site['siteaddress']; ?>" size="40"> </td>
                    </tr>
                    <tr>
                        <th width="140">版权信息:</th>
                        <td><input type="text" class="input"  name="sitecopyright" value="<?php echo $Site['sitecopyright']; ?>" size="40"> </td>
                    </tr>
                    <tr>
                        <th width="140">备案号:</th>
                        <td><input type="text" class="input"  name="siteicp" value="<?php echo $Site['siteicp']; ?>" size="40"> </td>
                    </tr>
                        <tr>
                        <th width="140">侧边联系方式:</th>
                        <td><textarea name="siteleftcontact" style="width:350px; height:100px;"><?php echo $Site['siteleftcontact']; ?></textarea>  <span class="gray"> 允许写入HTML标签；例如：换行使用<<span>br</span>/></span></td>
                    </tr>
                       <tr>
                        <th width="140">第三方代码:</th>
                        <td><textarea name="sitecode" style="width:350px; height:100px;"><?php echo $Site['sitecode']; ?></textarea>  <span class="gray"> 允许写入HTML标签</span></td>
                    </tr>
                </table>
                </div>
                <div class="btn_wrap">
                    <div class="btn_wrap_pd">             
                        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">提交</button>
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