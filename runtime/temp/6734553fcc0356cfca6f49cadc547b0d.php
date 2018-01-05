<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:63:"F:\www\thinkphp\public/../application/admin\view\index\main.php";i:1501833696;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
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
  <div id="home_toptip"></div>
  <h2 class="h_a">系统信息</h2>
  <div class="home_info">
    <ul>
      <ul>
        <?php if(is_array($server_info) || $server_info instanceof \think\Collection): $i = 0; $__LIST__ = $server_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li> <em><?php echo $key; ?></em> <span><?php echo $vo; ?></span> </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </ul>
  </div>
  <h2 class="h_a">开发团队</h2>
  <div class="home_info" id="home_devteam">
    <ul>
      <li> <em>开发者</em> <span>wemeSky</span> </li>
      <li> <em>联系邮箱</em> <span>389602549@qq.com</span></li>
    </ul>
  </div>
  <h2 class="h_a">常用菜单</h2>
  <div class="home_info" id="home_devteam">
    <div class="layui-btn-group">
      <?php if(is_array($items) || $items instanceof \think\Collection): $i = 0; $__LIST__ = $items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <a href="<?php echo $vo['url']; ?>" class="layui-btn tab_href J_chanyong_items" data-id="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></a>
      <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </div>
  <!--
   <h2 class="h_a">问题反馈</h2>
   <form method="post" action="ajax_php/ajax_from.php" id="RegForm" name="RegForm" class="J_ajaxForm">
   <div class="table_full">
       <table width="100%" class="table_form">
             <tr>
                 <th width="80">类型<font color="red">*</font></th>
                 <td>
           <select name='type' id='type' ><option value="1" >意见反馈</option><option value="2" >Bug反馈</option></select></td>
             </tr>
             <tr>
                 <th width="80">反馈者<font color="red">*</font></th>
                 <td><input type="text" name="name"  class="input" id="name" /></td>
             </tr>
             <tr>
                 <th>联系邮箱<font color="red">*</font></th>
                 <td><input type="text" name="email"  class="input" id="email" />
           </td>
             </tr>
             <tr>
                 <th>反馈内容<font color="red">*</font></th>
                 <td><textarea id="content" name="content" style="width:600px; height:150px;"></textarea></td>
             </tr>
         </table>
     </div>-->
     <!--定位使用css-class btn_wrap
    <div class="">
        <div class="btn_wrap_pd">
          <button class="btn btn_submit mr10 J_ajax_submit_btn" data-subcheck='1' type="submit">提交</button>
        </div>
    </div>
  </form>-->
</div>
<script src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/layui/layui.js"></script>
<script src="/static/admin/js/laydate/laydate.js"></script>
<script src="/static/admin/js/tabs.js"></script>
<script src="/static/admin/js/ajaxForm.js"></script>
<script src="/static/admin/js/common.js"></script>
<script>
  $(function(){
    $('a.J_chanyong_items').on('click', function(e){
      e.preventDefault();
      var $this = $(this);
      var data_id = $(this).attr('data-id');
      var href = this.href;
      parent.window.iframeJudge({
        elem: $this,
        href: href,
        id: data_id
      });
    });

  });

</script>
</body>
</html>
