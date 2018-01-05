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
                            {volist name="result" id="vo"}
                            <dt><a href="{$vo.url}"><b>{$vo.catname}</b></a></dt>
                            {notempty name="vo.childs"}
                            <dd style="display: block; ">
                                <ul>
                                    {volist name="vo.childs" id="voo"}
                                    <li><a href="{$voo.url}">{$voo.catname}</a></li>
                                    {/volist}
                                </ul>
                            </dd>
                            {/notempty}
                            {/volist}

                        </dl>
                    </div>
                </div>
            </th>
            <td id="content_frame" style="height:100%;">
                <iframe id="iframe_right" src="{:Url("home")}" style="height: 100%; width: 100%;" frameborder="0" scrolling="auto"></iframe>
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
