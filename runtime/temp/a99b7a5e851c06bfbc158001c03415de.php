<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"F:\www\thinkphp\public/../application/admin\view\menu\public_changyong.php";i:1500632176;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
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
<div class="wrap">
    <div class="h_a">常用菜单</div>
    <form action="<?php echo Url('Admin/Menu/chanyong_edit'); ?>" method="post" class="J_ajaxForm">
        <div class="table_full">
            <table width="100%" class="table_form">
                <tr>
                    <th width="100">常用菜单：</th>
                    <td><div class="user_group J_check_wrap">
                            <?php if(is_array($menu) || $menu instanceof \think\Collection): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <dl>
                                <dt>
                                    <label><input type="checkbox" data-direction="y" data-checklist="J_check_priv_roleid{<?php echo $vo['id']; ?>}" class="checkbox J_check_all" value="<?php echo $vo['id']; ?>" <?php echo $vo['checked']; ?>/><?php echo $vo['title']; ?></label>
                                </dt>
                                <dd>
                                    <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?>
                                    <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{<?php echo $vo['id']; ?>}" name="priv_roleid[]" value="<?php echo $vo2['id']; ?>" <?php echo $vo2['checked']; ?>><span><?php echo $vo2['title']; ?></span></label>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </dd>
                            </dl>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div></td>
                </tr>
            </table>
        </div>
        <div class="">
            <div class="btn_wrap_pd">
                <input type="hidden" name="userid" value="<?php echo $userid; ?>" />
                <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">设置</button>
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
<script src="/static/admin/js/treeTable/treeTable.js"></script>
<link href="/static/admin/js/treeTable/treeTable.css" rel="stylesheet" />
<script type="text/javascript">
    $(document).ready(function(){
        $("#dnd-example").treeTable({
            indent: 20
        });
    });
    function checknode(obj) {
        var chk = $("input[type='checkbox']");
        var count = chk.length;
        var num = chk.index(obj);
        var level_top = level_bottom = chk.eq(num).attr('level')
        for (var i = num; i >= 0; i--) {
            var le = chk.eq(i).attr('level');
            if (eval(le) < eval(level_top)) {
                chk.eq(i).attr("checked", true);
                var level_top = level_top - 1;
            }
        }
        for (var j = num + 1; j < count; j++) {
            var le = chk.eq(j).attr('level');
            if (chk.eq(num).attr("checked") == true) {
                if (eval(le) > eval(level_bottom)) chk.eq(j).attr("checked", true);
                else if (eval(le) == eval(level_bottom)) break;
            } else {
                if (eval(le) > eval(level_bottom)) chk.eq(j).attr("checked", false);
                else if (eval(le) == eval(level_bottom)) break;
            }
        }
    }
</script>
</body>
</html>