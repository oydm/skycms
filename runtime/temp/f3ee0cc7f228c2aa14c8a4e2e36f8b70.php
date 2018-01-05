<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"F:\www\bhwz\2.0.1\public/../app/admin\view\article\main.php";i:1503375390;}*/ ?>
<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8" />
    <title>后台管理系统 -</title>
    <link href="/static/admin/css/admin_layout.css?v=" rel="stylesheet" />
</head>
<body>
<div class="wrap">
    <table width="100%" height="100%" style="table-layout:fixed;">
        <tr class="content">
            <th style="overflow:hidden;border-right: 1px solid #CCC;" width="140"> <div id="B_menunav" style="margin-top: 0px;">
                    <div class="menubar">
                        <dl id="B_menubar">
                            <?php if(is_array($result) || $result instanceof \think\Collection): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <dt><a href="<?php echo $vo['url']; ?>"><b><?php echo $vo['catname']; ?></b></a></dt>
                            <?php if(!(empty($vo['childs']) || ($vo['childs'] instanceof \think\Collection && $vo['childs']->isEmpty()))): ?>
                            <dd style="display: block; ">
                                <ul>
                                    <?php if(is_array($vo['childs']) || $vo['childs'] instanceof \think\Collection): $i = 0; $__LIST__ = $vo['childs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?>
                                    <li><a href="<?php echo $voo['url']; ?>"><?php echo $voo['catname']; ?></a></li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </dd>
                            <?php endif; endforeach; endif; else: echo "" ;endif; ?>

                        </dl>
                    </div>
                </div>
            </th>
            <td id="content_frame" style="height:100%;">
                <iframe id="iframe_right" src="<?php echo Url("home"); ?>" style="height: 100%; width: 100%;" frameborder="0" scrolling="auto"></iframe>
            </td>
        </tr>
    </table>
</div>
<script src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/common.js"></script>
<script>
    $(function () {
        $('#B_menubar').on('click', 'a', function (e) {
            e.preventDefault();
            e.stopPropagation();
            content_iframe_height();
            var $this = $(this),
                _dt = $this.parent(),
                _dd = _dt.next('dd');
            $("#B_menubar li").removeClass('current');
            //当前菜单状态
            _dt.addClass('current').parent('ul').parent('dd').siblings('dt.current').removeClass('current');
            //子菜单显示&隐藏
            if (_dd.length) {
                _dt.toggleClass('current');
                _dd.toggle();
                return false;
            };
            var data_id = $(this).attr('data-id'),
                li = $('#B_history li[data-id=' + data_id + ']');
            var href = this.href;
            var rframe = document.getElementById("iframe_right") ;
            rframe.src = href;
        });
    });

    function content_iframe_height(){
        def_iframe_height = $("body").height();
        $("#content_frame").height(def_iframe_height);
    }
</script>
</body>
</html>
