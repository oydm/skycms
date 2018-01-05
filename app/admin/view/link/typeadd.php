{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap jj">
    {include file="Common:Nav"/}
    <div class="common-form">
        <form action="{:Url('Admin/link/typeadd')}" method="post" class="J_ajaxForm">
            <div class="h_a">基本属性</div>
            <div class="table_full">
                <table width="100%" class="table_form contentWrap">
                    <tr>
                        <th width="80">上级栏目</th>
                        <td><select name="parentid" id="parentid">
                                <option value='0'>≡ 作为一级栏目 ≡</option>
                                {$category}
                            </select></td>
                    </tr>
                    <tr id="normal_add">
                        <th>类型名称</th>
                        <td><input type="text" name="catname" id="catname" class="input" value=""></td>
                    </tr>
                    <tr>
                        <th>简介</th>
                        <td><textarea name="description" maxlength="255" style="width:300px;height:60px;"></textarea></td>
                    </tr>
                    <tr>
                        <th>显示排序</th>
                        <td><input type="text" name="listorder" id="listorder" class="input" value="0"></td>
                    </tr>
                </table>
            </div>
            <div class="btn_wrap">
                <div class="btn_wrap_pd">
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
{include file="Common:Js" /}
</body>
</html>