{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    {include file="Common:Nav"/}
    <form method="post"  class="J_ajaxForm">
        <div class="table_list">
            <table width="100%" cellspacing="0">
                <thead>
                <tr>

                    <td width="5%" align="center">排序</td>
                    <td width="5%" align="center" >ID</td>
                    <td width="75%" align="left" >类型名称</td>
                    <td width="15%" align="center" >管理操作</td>
                </tr>
                </thead>
                <tbody>
                {$categorys}
                </volist>
                </tbody>
            </table>
            <div class="p10">
                <div class="pages">  </div>
            </div>
        </div>

        <div class="btn_wrap">
            <div class="btn_wrap_pd">
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" data-action="{:Url('Admin/Link/typelistorder')}" type="submit" name="submit" value="listorder" >排序</button>

            </div>
        </div>
    </form>
</div>
{include file="Common:Js" /}
</body>
</html>