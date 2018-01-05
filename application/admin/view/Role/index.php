{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap jj">
{include file="Common:Nav"/}
 <!-- -->
   <div class="table_list">
     <table width="100%" cellspacing="0">
      <thead>
        <tr>
          <td width="20">ID</td>
          <td width="200"  align="left" >角色名称</td>
          <td align="left" >角色描述</td>
          <td width="50"  align="left" >状态</td>
          <td width="300">管理操作</td>
        </tr>
      </thead>
      <tbody>
      {volist name="data" id="vo"}
        <tr>
          <td width="10%" align="">{$vo.id}</td>
          <td width="15%"  >{$vo.title}</td>
          <td >{$vo.remark}</td>
          <td width="5%">
          {if condition="$vo['status'] eq 1"}
          <font color="red">√</font>
          {else /}
          <font color="red">╳</font>
          {/if}
          </td>
          <td  class="text-c">
          {if condition="$vo['id'] eq 1"} 
          <font color="#cccccc">权限设置</font> | <a href="{:Url('Admin/Manager/index',array('group_id'=>$vo['id']))}">成员管理</a> | <font color="#cccccc">修改</font> | <font color="#cccccc">删除</font>
          {else /}
            <a href="{:Url('Admin/Role/auth',array('id'=>$vo['id']))}">权限设置</a> | <a href="{:Url('Admin/Manager/index',array('group_id'=>$vo['id']))}">成员管理</a> | <a href="{:Url('Admin/Role/edit',array('id'=>$vo['id']))}">修改</a> | <a href="{:Url('Admin/Role/delete',array('id'=>$vo['id']))}" class="J_ajax_del">删除</a> 
          {/if}
          </td>
        </tr>
        {/volist}
      </tbody>
    </table>
   </div>
</div>
{include file="Common:Js"/}
</body>
</html>