{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap">
    <div class="h_a">缓存更新</div>
    <form method="post" class="J_ajaxForm" action="">
    <div class="table_full">
        <table width="100%">
            <col class="th" />
            <col width="400" />
            <col />
            <tr>
                <th>更新站点数据缓存</th>
                <td>
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" data-action="{:Url('Index/deletecache',array('type'=>'site'))}" type="submit">提交</button>
                </td>
                <td><div class="fun_tips">修改过站点设置，或者栏目管理，内容管理等时可以进行缓存更新</div></td>
            </tr>
            <tr>
                <th>更新站点模板缓存</th>
                <td>
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" data-action="{:Url('Index/deletecache',array('type'=>'template'))}" type="submit">提交</button>
                </td>
                <td><div class="fun_tips">当修改模板时，模板没及时生效可以对模板缓存进行更新</div></td>
            </tr>
            <tr>
                <th>清除网站运行日志</th>
                <td>
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" data-action="{:Url('Index/deletecache',array('type'=>'logs'))}" type="submit">提交</button>
                </td>
                <td><div class="fun_tips">网站运行过程中会记录各种错误日志，以文件的方式保存</div></td>
            </tr>
        </table>
    </div>
    </form>
</div>
{include file="Common:Js"/}
</body>
</html>
