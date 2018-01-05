{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    {include file="Common:Nav"/}
    <div class="table_list">
        <table width="100%" cellspacing="0">
            <thead>
            <tr>
                <td width="5%" align="center" >序号</td>
                <td width="30%" align="left" >标题</td>
                <td width="20%" align="left" >所属栏目</td>
                <td width="15%"  align="center" >修改时间</td>
                <td width="15%"  align="center" >修改操作人</td>
                <td width="15%" align="center" >管理操作</td>
            </tr>
            </thead>
            <tbody>
            {volist name="data" id="data"}
                <tr>
                    <td align="center">{$data.id}</td>
                    <td>{$data.title}</td>
                    <td>{$data.catname}</td>
                    <td align="center">{$data.updatetime|date="Y-m-d H:i:s",###}</td>
                    <td align="center">{$data.username}</td>
                    <td align="center"><a href="{:Url('Admin/Pages/edit',array('catid'=>$data['id']))}">修改</a></td>
                </tr>
            {/volist}
            </tbody>
        </table>
        <div class="p10">
            <div class="pages"></div>
        </div>

    </div>
</div>

</div>
</div>
{include file="Common:Js" /}
</body>
</html>