{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    {include file="Common:Nav"/}
  <form action="{:Url('Admin/Expand/arealistorder')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%">
        <colgroup>
        <col width="80">
        <col width="200">
        <col>
        <col width="300">
        <col width="300">
        </colgroup>
        <thead>
          <tr>
            <td align='center'>排序</td>
            <td align='center'>ID</td>
            <td align='center'>名称</td>
            <td align='center'>状态</td>
            <td align='center'>管理操作</td>
          </tr>
        </thead>
        {volist name="data" id="vo"}
            <tr>
                <td align='center'><input name='listorders[{$vo.id}]' type='text' size='3' value='{$vo.listorder}' class='input'></td>
                <td align='center'>{$vo.id}</td>
                              <td align='center'>{$vo.name}</td>
                              <td align='center'>{if condition="$vo.status eq 1"}<span style="color: green">启用</span>{else/} <span style="color: red">禁用</span>{/if}</td>
                <td align='center'>
                                    <a href="{:Url('Admin/Expand/area', array('parentid' => $vo['id']))}">管理子菜单</a>   |
                                   <a href="{:Url('Admin/Expand/areaadd', array('parentid' => $vo['id']))}">添加子菜单</a> |
                                    <a href="{:Url('Admin/Expand/areaedit', array('id' => $vo['id']))}">修改</a>  |
                                    <a class="J_ajax_del" href="{:Url('Admin/Expand/areadel', array('id' => $vo['id']))}">删除</a>
                               </td>
            </tr>
        {/volist}
      </table>
      <div class="p10"><div class="pages"> {$Page} </div> </div>
    </div>
        <div class="btn_wrap">
          <div class="btn_wrap_pd">
            <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">排序</button>
          </div>
        </div>
  </form>
</div>
{include file="Common:Js"/}
</body>
</html>