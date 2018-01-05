{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap">
    <div class="h_a">常用菜单</div>
    <form action="{:Url('Admin/Menu/chanyong_edit')}" method="post" class="J_ajaxForm">
        <div class="table_full">
            <table width="100%" class="table_form">
                <tr>
                    <th width="100">常用菜单：</th>
                    <td><div class="user_group J_check_wrap">
                            {volist name="menu" id="vo"}
                            <dl>
                                <dt>
                                    <label><input type="checkbox" data-direction="y" data-checklist="J_check_priv_roleid{{$vo.id}}" class="checkbox J_check_all" value="{$vo.id}" {$vo.checked}/>{$vo.title}</label>
                                </dt>
                                <dd>
                                    {volist name="vo.child" id="vo2"}
                                    <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{{$vo.id}}" name="priv_roleid[]" value="{$vo2.id}" {$vo2.checked}><span>{$vo2.title}</span></label>
                                    {/volist}
                                </dd>
                            </dl>
                            {/volist}
                        </div></td>
                </tr>
            </table>
        </div>
        <div class="">
            <div class="btn_wrap_pd">
                <input type="hidden" name="userid" value="{$userid}" />
                <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">设置</button>
            </div>
        </div>
    </form>
</div>
{include file="Common:Js"/}
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