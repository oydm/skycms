<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:65:"F:\www\thinkphp\public/../application/admin\view\advert\index.php";i:1500966238;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:63:"F:\www\thinkphp\public/../application/admin\view\Common\Nav.php";i:1500620345;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
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
    <div class="h_a">搜索</div>
    <form method="get" action="<?php echo Url('Admin/Advert/index'); ?>">
        <input type="hidden" value="1" name="search">
        <div class="search_type cc mb10">
            <div class="mb10"> <span class="mr20">
                        类型：
                        <select class="select_2" name="catid">
                            <option value="" >全部</option>
                            <?php echo $category; ?>
                        </select>
                        审核：
                       <select class="select_2" name="status" style="width:70px;">
                           <option value=""  <?php if(empty(\think\Request::instance()->get('status')) || (\think\Request::instance()->get('status') instanceof \think\Collection && \think\Request::instance()->get('status')->isEmpty())): ?>selected<?php endif; ?>>全部</option>
                           <option value="1" <?php if(\think\Request::instance()->get('status') == '1'): ?> selected<?php endif; ?>>审核</option>
                           <option value="0" <?php if(\think\Request::instance()->get('status') == '0'): ?> selected<?php endif; ?>>未审核</option>
                       </select>

                        <button class="btn">搜索</button>
                    </span> </div>
        </div>
    </form>

    <form class="J_ajaxForm" method="post" >
        <div class="table_list">
            <table width="100%" cellspacing="0">
                <thead>
                <tr>
                    <td><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></td>
                    <td width="5%" align="center">排序</td>
                    <td width="5%" align="center" >ID</td>
                    <td width="35%" align="left" >标题</td>
                    <td width="15%" align="left" >图片</td>
                    <td width="10%" align="left" >所属分类</td>
                    <td width="10%"  align="center" >状态</td>
                    <td width="15%" align="center" >管理操作</td>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($data) || $data instanceof \think\Collection): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="<?php echo $vo['id']; ?>"></td>
                        <td align="center" ><input name='listorders[<?php echo $vo['id']; ?>]' class="input mr5"  type='text' size='3' value='<?php echo $vo['listorder']; ?>' align="center"></td>
                        <td align="center" ><?php echo $vo['id']; ?></td>
                        <td align="left" >
                            <span title="<?php echo $vo['title']; ?>"><?php echo $vo['sortitle']; ?></span></td>
                        <td align="left" >
                            <img src="<?php echo $vo['image']; ?>" height="30" >
                        </td>
                        <td align="left" ><?php echo $vo['catname']; ?></td>
                        <td align="center" ><?php if($vo['status'] == 0): ?> <span style="color: red">未审核</span><?php endif; if($vo['status'] == 1): ?><span style="color: #5FB878">已审核</span><?php endif; ?>
                        </td>
                        <td align="center" >
                                <a href="<?php echo Url('Admin/Advert/edit',array('id'=>$vo['id'])); ?>" >修改</a>
                                <a href="<?php echo Url('Admin/Advert/delete',array('id'=>$vo['id'])); ?>" class="J_ajax_del" >删除</a>
                        </td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <div class="p10">
                <div class="pages"> <?php echo $Page; ?> </div>
            </div>
        </div>

        <div class="btn_wrap">
            <div class="btn_wrap_pd">
                <label class="mr20">
                    <input type="checkbox" class="J_check_all" data-direction="y" data-checklist="J_check_y">全选</label>
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="<?php echo Url('Admin/Advert/listorder'); ?>"  name="submit" value="listorder" >排序</button>
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="<?php echo Url('Admin/Advert/review'); ?>" name="submit" value="review">审核</button>
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="<?php echo Url('Admin/Advert/unreview'); ?>" name="submit" value="unreview">取消审核</button>
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="<?php echo Url('Admin/Advert/del'); ?>" name="submit" value="del">删除</button>

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