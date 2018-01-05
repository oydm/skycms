{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap jj">
{include file="Common:Nav"/}
  <div class="common-form">
  <!---->
    <form method="post" action="{:Url('Admin/Manager/myinfo')}" class="J_ajaxForm">
     <input type="hidden" value="{$data.id}" name="id"/>
    <input type="hidden" value="{$data.username}" name="username"/>
    <div class="h_a">用户信息</div>
    <div class="table_full">
      <table width="100%">
        <col class="th" />
        <col/>
        <thead>
          <tr>
            <th>ID</th>
            <td>{$data.id}</td>
          </tr>
        </thead>
        <tr>
          <th>用户名</th>
          <td>{$data.username}</td>
        </tr>
        <tr>
          <th>姓名</th>
          <td><input name="nickname" type="text" class="input length_5 required" value="{$data.nickname}">
           <span id="J_reg_tip_nickname" role="tooltip"></span></td>
        </tr>
        <tr>
          <th>E-mail</th>
          <td><input name="email" type="text" class="input length_5" value="{$data.email}"></td>
        </tr>
        <tr>
          <th>备注</th>
          <td><textarea id="J_textarea" name="content" style="width:400px;height:100px;">{$data.content}</textarea></td>
        </tr>
      </table>
    </div>
      <div class="btn_wrap">
        <div class="btn_wrap_pd">
          <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">修改</button>
        </div>
      </div>
    </form>
  </div>
</div>
{include file="Common:Js" /}
</body>
</html>