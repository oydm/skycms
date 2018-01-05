{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap jj">
{include file="Common:Nav"/}
  <div class="common-form">
  <!---->
    <form method="post" action="{:Url('Admin/Role/add')}" class="J_ajaxForm">
      <div class="h_a">角色信息</div>
   <div class="table_full">
      <table width="100%">
        <tr>
          <th width="100">角色名称</th>
          <td><input type="text" name="title" value="" class="input" id="title"></input></td>
        </tr>
        <tr>
          <th>角色描述</th>
          <td><textarea name="remark" rows="2" cols="20" id="remark" class="inputtext" style="height:100px;width:500px;"></textarea></td>
        </tr>
        <tr>
          <th>是否启用</th>
          <td><input type="radio" name="status" value="1"  checked>启用<label>  &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="0">禁止</label></td>
        </tr>
      </table>
      </div>
      <div class="">
        <div class="btn_wrap_pd">
          <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">添加</button>
        </div>
      </div>
    </form>
  </div>
</div>
{include file="Common:Js"/}
</body>
</html>