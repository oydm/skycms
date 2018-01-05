{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap jj">
{include file="Common:Nav"/}
 <div class="h_a">角色授权</div>
  <form action="{:Url('Admin/Role/auth')}" method="post" class="J_ajaxForm">
    <div class="table_full">
      <table width="100%" cellspacing="0" id="dnd-example">
        <tbody>
          <?php echo $categorys;?>
        </tbody>
      </table>
    </div>
    <div class="btn_wrap">
      <div class="btn_wrap_pd">
        <input type="hidden" name="id" value="{$id}" />
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">授权</button>
      </div>
    </div>
  </form>
</div>
{include file="Common:Js"/}
<script src="/static/admin/js/treeTable/treeTable.js"></script>
<link href="/static/admin/js/treeTable/treeTable.css" rel="stylesheet" />
<script type="text/javascript">
$(document).ready(function(){
   $("#dnd-example").treeTable({
       indent: 20,
       expandable :true,
    });
});

function checknode(obj) {
    var chk = $("input[type='checkbox']");
    var count = chk.length;
    var num = chk.index(obj);
    var level_top = level_bottom = chk.eq(num).attr('level')
    for (var i = num; i >= 0; i--) {
        var le = chk.eq(i).attr('level');
        if (eval(le) < eval(level_top)) {
            chk.eq(i).attr("checked", true);
            var level_top = level_top - 1;
        }
    }
    for (var j = num + 1; j < count; j++) {
        var le = chk.eq(j).attr('level');
        if (chk.eq(num).attr("checked") == true) {
            if (eval(le) > eval(level_bottom)) chk.eq(j).attr("checked", true);
            else if (eval(le) == eval(level_bottom)) break;
        } else {
            if (eval(le) > eval(level_bottom)) chk.eq(j).attr("checked", false);
            else if (eval(le) == eval(level_bottom)) break;
        }
    }
}
</script>

</body>
</html>