{include file="Common:Head" /}
<body class="J_scroll_fixed">
    <div class="wrap jj">
        {include file="Common:Nav"/}
        <div class="common-form">
            <form method="post" action="{:Url('Admin/Expand/typeadd')}" class="J_ajaxForm">
                <div class="h_a">基本信息</div>
                <div class="table_list">
                    <table cellpadding="0" cellspacing="0" class="table_form" width="100%">
                        <tbody>
                            
                            <tr >
                                <td width="80">名称:</td>
                                <td><input type="text" class="input" name="catname" id="name" value="" ></td>
                            </tr>
                           
                            <tr>
                                <td>状态:</td>
                                <td><select name="status">
                                        <option value="1" selected>启用</option>
                                        <option value="0" >禁用</option>
                                    </select></td>
                            </tr>
                            
            <tr>
              <td>描述:</td>
              <td><textarea name="description" rows="5" cols="57"></textarea></td>
            </tr>
                            <tr>
                                <td>排序:</td>
                                <td><input type="text" class="input" name="listorder" id="listorder" value="0" ></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="btn_wrap">
                    <div class="btn_wrap_pd">
                        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">添加</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {include file="Common:Js" /}
</body>
</html>