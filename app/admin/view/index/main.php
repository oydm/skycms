{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap jj">
  <div id="home_toptip"></div>
  <h2 class="h_a">系统信息</h2>
  <div class="home_info">
    <ul>
      <ul>
        {volist name="server_info" id="vo"}
        <li> <em>{$key}</em> <span>{$vo}</span> </li>
        {/volist}
      </ul>
    </ul>
  </div>
  <h2 class="h_a">开发团队</h2>
  <div class="home_info" id="home_devteam">
    <ul>
      <li> <em>开发者</em> <span>wemeSky</span> </li>
      <li> <em>联系邮箱</em> <span>389602549@qq.com</span></li>
    </ul>
  </div>
  <h2 class="h_a">常用菜单</h2>
  <div class="home_info" id="home_devteam">
    <div class="layui-btn-group">
      {volist name="items" id="vo"}
      <a href="{$vo.url}" class="layui-btn tab_href J_chanyong_items" data-id="{$vo.id}">{$vo.name}</a>
      {/volist}
    </div>
  </div>
  <!--
   <h2 class="h_a">问题反馈</h2>
   <form method="post" action="ajax_php/ajax_from.php" id="RegForm" name="RegForm" class="J_ajaxForm">
   <div class="table_full">
       <table width="100%" class="table_form">
             <tr>
                 <th width="80">类型<font color="red">*</font></th>
                 <td>
           <select name='type' id='type' ><option value="1" >意见反馈</option><option value="2" >Bug反馈</option></select></td>
             </tr>
             <tr>
                 <th width="80">反馈者<font color="red">*</font></th>
                 <td><input type="text" name="name"  class="input" id="name" /></td>
             </tr>
             <tr>
                 <th>联系邮箱<font color="red">*</font></th>
                 <td><input type="text" name="email"  class="input" id="email" />
           </td>
             </tr>
             <tr>
                 <th>反馈内容<font color="red">*</font></th>
                 <td><textarea id="content" name="content" style="width:600px; height:150px;"></textarea></td>
             </tr>
         </table>
     </div>-->
     <!--定位使用css-class btn_wrap
    <div class="">
        <div class="btn_wrap_pd">
          <button class="btn btn_submit mr10 J_ajax_submit_btn" data-subcheck='1' type="submit">提交</button>
        </div>
    </div>
  </form>-->
</div>
{include file="Common:Js"/}
<script>
  $(function(){
    $('a.J_chanyong_items').on('click', function(e){
      e.preventDefault();
      var $this = $(this);
      var data_id = $(this).attr('data-id');
      var href = this.href;
      parent.window.iframeJudge({
        elem: $this,
        href: href,
        id: data_id
      });
    });

  });

</script>
</body>
</html>
