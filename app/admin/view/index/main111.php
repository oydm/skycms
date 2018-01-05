{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap jj">
{include file="Common:Nav"/}
<div class="nav">
  <div class="return"><a href="">上一级</a></div>
  <ul class="cc">
    <li class="current"><a href="">测试测试</li>
    <li class=""><a href="">测试测试</li>
    <li class=""><a href="">测试测试</li>
  </ul>
</div>
  <h2 class="h_a">测试</h2>
  <div class="home_info">
    <a href="test.html" class="J_dialog" title="测试" data-width="800" data-height="500" >J_dialog</a>
    <a href="ajax_php/ajax_del.php" class="J_ajax_del" title="测试" >Ajax删除</a>

    <input type="button" class="btn" name="del_log_4" value="按钮"  />
    <input type="button" class="btn btn_submit" name="del_log_4" value="提交按钮"  />
    <input type="button" class="btn btn_success" name="del_log_4" value="确认按钮" />
    <input type="button" class="btn btn_error" name="del_log_4" value="错误按钮" />
    <br>
    <input type="button" class="layui-btn layui-btn-primary" name="del_log_4" value="原始按钮"  />
    <button class="layui-btn layui-btn-primary">原始按钮</button>
    <button class="layui-btn">默认按钮</button>
    <button class="layui-btn layui-btn-normal">百搭按钮</button>
    <button class="layui-btn layui-btn-warm">暖色按钮</button>
    <button class="layui-btn layui-btn-danger">警告按钮</button>
    <button class="layui-btn layui-btn-disabled">禁用按钮</button>
    <br>
    <button class="layui-btn layui-btn-big">大型按钮</button>
    <button class="layui-btn ">默认按钮</button>
    <button class="layui-btn layui-btn-small">小型按钮</button>
    <button class="layui-btn layui-btn-mini">迷你按钮</button>
    <br>
    <button class="layui-btn layui-btn-radius layui-btn-primary">原始按钮</button>
    <button class="layui-btn layui-btn-radius">默认按钮</button>
    <button class="layui-btn layui-btn-radius layui-btn-normal">百搭按钮</button>
    <button class="layui-btn layui-btn-radius layui-btn-warm">暖色按钮</button>
    <button class="layui-btn layui-btn-radius layui-btn-danger">警告按钮</button>
    <button class="layui-btn layui-btn-radius layui-btn-disabled">禁用按钮</button>
    <p>
        <button class="layui-btn"><i class="layui-icon">&#xe608;</i> 添加</button>
        <button class="layui-btn"><i class="layui-icon">&#x1006;</i></button>
        <button class="layui-btn"><i class="layui-icon">&#xe614;</i></button>
        <button class="layui-btn"><i class="layui-icon">&#x1002;</i></button>
        <button class="layui-btn"><i class="layui-icon">&#xe602;</i></button>
        <button class="layui-btn"><i class="layui-icon">&#xe603;</i></button>
        <button class="layui-btn"><i class="layui-icon">&#xe631;</i></button>
        <button class="layui-btn"><i class="layui-icon">&#xe61f;</i></button>
        <button class="layui-btn layui-btn-small layui-btn-primary"><i class="layui-icon">&#x1002;</i></button>
    </p>
    <p>
      <div class="layui-btn-group">
        <button class="layui-btn">增加</button>
        <button class="layui-btn">编辑</button>
        <button class="layui-btn">删除</button>
      </div>
      <div class="layui-btn-group">
        <button class="layui-btn layui-btn-small">
          <i class="layui-icon">&#xe642;</i>
        </button>
        <button class="layui-btn layui-btn-small">
          <i class="layui-icon">&#xe640;</i>
        </button>
        <button class="layui-btn layui-btn-small">
          <i class="layui-icon">&#xe602;</i>
        </button>
      </div>
       
      <div class="layui-btn-group">
        <button class="layui-btn layui-btn-primary layui-btn-small">
          <i class="layui-icon">&#xe642;</i>
        </button>
        <button class="layui-btn layui-btn-primary layui-btn-small">
          <i class="layui-icon">&#xe640;</i>
        </button>
      </div>
    </p>
  </div>
  <h2 class="h_a">系统信息</h2>
  <div class="home_info">
    <ul>
       <li> <em>操作系统</em> <span>WINNT</span> </li>
       <li> <em>运行环境</em> <span>Apache/2.4.4 (Win32) PHP/5.4.16</span> </li>
       <li> <em>PHP运行方式</em> <span>apache2handler</span> </li>
       <li> <em>MYSQL版本</em> <span>5.6.12-log</span> </li>
    </ul>
  </div>
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
            <span class="gray"><b class="red  ">单位</b> (备注、备注、备注)</span>
          </td>
    		</tr>
            <tr>
    			<th>反馈内容<font color="red">*</font></th>
    			<td><textarea id="content" name="content" style="width:600px; height:150px;"></textarea></td>
    		</tr>
         <tr>
          <th>时间<font color="red">*</font></th>
          <td>
           <input type="text" name="date_start"  class="input J_date laydate-icon" id="date" />
           <input type="text" name="date_end"  class="input J_datetime laydate-icon" id="datetime" />
          </td>
        </tr>
        <tr>
              <th>审核</th>
              <td><ul class="switch_list cc ">
                  <li>
                    <label>
                      <input type='radio' name="setting[member_check]" checked value='1'>
                      <span>需要审核</span></label>
                  </li>
                  <li>
                    <label>
                      <input type='radio' name="setting[member_check]" value='0'>
                      <span>无需审核</span></label>
                  </li>
                </ul></td>
            </tr>
            <tr>
              <th>显示位置</th>
              <td><ul class="switch_list cc ">
                  <li>
                    <label>
                      <input type='checkbox' name="shuxing[member_check]" value='1'>
                      <span>首页</span></label>
                  </li>
                  <li>
                    <label>
                      <input type='checkbox' name="shuxing[member_check]" value='2'>
                      <span>推荐</span></label>
                  </li>
                </ul></td>
            </tr>
            <tr>
              <th width="200">权限：</th>
              <td><div class="user_group J_check_wrap">
                  <dl>
                    <dt>
                      <label><input type="checkbox" data-direction="y" data-checklist="J_check_priv_roleid{1}" class="checkbox J_check_all"/>管理员</label>
                    </dt>
                    <dd>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{1}" name="priv_roleid[]" value="init,1" ><span>查看</span></label>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{1}" name="priv_roleid[]" value="add,1" ><span>添加</span></label>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{1}" name="priv_roleid[]" value="edit,1" ><span>修改</span></label>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{1}" name="priv_roleid[]" value="delete,1" ><span>删除</span></label>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{1}" name="priv_roleid[]" value="listorder,1" ><span>排序</span></label>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{1}" name="priv_roleid[]" value="push,1" ><span>推送</span></label>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{1}" name="priv_roleid[]" value="remove,1" ><span>移动</span></label>
                    </dd>
                  </dl>
                  <dl>
                    <dt>
                      <label><input type="checkbox" data-direction="y" data-checklist="J_check_priv_roleid{2}" class="checkbox J_check_all"/>游客</label>
                    </dt>
                    <dd>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{2}" name="priv_roleid[]" value="init,2" ><span>查看</span></label>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{2}" name="priv_roleid[]" value="add,2" ><span>添加</span></label>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{2}" name="priv_roleid[]" value="edit,2" ><span>修改</span></label>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{2}" name="priv_roleid[]" value="delete,2" ><span>删除</span></label>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{2}" name="priv_roleid[]" value="listorder,2" ><span>排序</span></label>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{2}" name="priv_roleid[]" value="push,2" ><span>推送</span></label>
                      <label><input class="J_check" type="checkbox" data-yid="J_check_priv_roleid{2}" name="priv_roleid[]" value="remove,2" ><span>移动</span></label>
                    </dd>
                  </dl>
                </div></td>
            </tr>
    	</table>
    </div>
    <!--定位使用css-class btn_wrap-->
    <div class="">
        <div class="btn_wrap_pd">
          <button class="btn btn_submit mr10 J_ajax_submit_btn" data-subcheck='1' type="submit">提交</button>
        </div>
    </div>
  </form>
  
<form class="layui-form" action="">
  <div class="layui-form-item">
    <label class="layui-form-label">输入框</label>
    <div class="layui-input-block">
      <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">密码框</label>
    <div class="layui-input-inline">
      <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">辅助文字</div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">选择框</label>
    <div class="layui-input-block">
      <select name="city" lay-verify="required">
        <option value=""></option>
        <option value="0">北京</option>
        <option value="1">上海</option>
        <option value="2">广州</option>
        <option value="3">深圳</option>
        <option value="4">杭州</option>
      </select>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">复选框</label>
    <div class="layui-input-block">
      <input type="checkbox" name="like[write]" title="写作">
      <input type="checkbox" name="like[read]" title="阅读" checked>
      <input type="checkbox" name="like[dai]" title="发呆">

      <input type="checkbox" name="" title="写作" lay-skin="primary" checked>
      <input type="checkbox" name="" title="发呆" lay-skin="primary"> 
      <input type="checkbox" name="" title="禁用" lay-skin="primary" disabled> 
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">开关</label>
    <div class="layui-input-block">
      <input type="checkbox" name="switch" lay-skin="switch">
    </div>
  </div>
  
  <div class="layui-form-item">
    <label class="layui-form-label">单选框</label>
    <div class="layui-input-block">
      <input type="radio" name="sex" value="男" title="男">
      <input type="radio" name="sex" value="女" title="女" checked>
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">文本域</label>
    <div class="layui-input-block">
      <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>
 
<script>
//Demo
layui.use('form', function(){
  var form = layui.form();
  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});
</script>

  <h2 class="h_a">选项卡</h2>
   <!--css-class pop_nav-->
     <div class="nav">
      <ul class="J_tabs_nav">
        <li class="current"><a href="javascript:void(0);">Content 1</a></li>
        <li><a href="javascript:void(0);">Content 2</a></li>
        <li><a href="javascript:void(0);">Content 3</a></li>
      </ul>
       </div>
      <div class="tabs_content J_tabs_contents">
        <div>Content1</div>
        <div>Content2</div>
        <div>Content3</div>
      </div>
<div class="h_a">搜索</div>
<div class="search_type cc mb10">
    <div class="mb10"> <span class="mr20"> 搜索类型：
      <select class="select" name="type" >
        <option value="ruleid" >行为ID</option>
        <option value="guid" >标识</option>
      </select>
      关键字：
      <input type="text" class="input length_5" name="keyword" size='10' value="" placeholder="关键字">
       时间：<input type="text" name="date_start"  class="input J_date laydate-icon" id="date" /> 至
           <input type="text" name="date_end"  class="input J_datetime laydate-icon" id="datetime" />
      <button class="btn">搜索</button>
    
      <input type="button" class="btn" name="del_log_4" value="删除一月前数据" onClick="location='{:url("Logs/deletelog")}'"  />
     
      </span></div>
  </div>
<div class="table_list">

      <table width="100%">
        <colgroup>
        <col width="16">
        <col width="50">
        <col width="60">
        <col width="">
        <col width="80">
        <col width="90">
        <col width="140">
        <col width="120">
        </colgroup>
        <thead>
          <tr>
            <td><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></td>
            <td>排序</td>
            <td align="center">ID</td>
            <td>标题</td>
            <td align="center">点击量</td>
            <td align="center">发布人</td>
            <td align="center"><span>发帖时间</span></td>
            <td align="center">管理操作</td>
          </tr>
        </thead>
          <tr>
            <td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="1"></td>
            <td><input name='listorders[]' class="input mr5"  type='text' size='3' value='11'></td>
            <td align="center"><a href="" title="点击生成">1</a></td>
            <td>
                <a href="" target="_blank"><font color="#FF0000">[未审核]</font> - 标题标题标题标题标题标题</a></td>
            <td align="center">2</td>
            <td align="center"><if condition=" $vo['sysadd'] ">会员投稿</td>
            <td align="center">2016-09-28 11:21:12</td>
            <td align="center">
              <a href="javascript:;;" onClick="javascript:openwinx('test.html')">修改</a>
              <a href="test.html" class="J_dialog" title="修改" data-width="800" data-height="500" >修改</a>
              <a href="ajax_php/ajax_del.php" class="J_ajax_del" title="删除" >删除</a>
            </td>
          </tr>
      </table>
      <div class="p10">

        <div class="pages">
          <span class="all">共有10条信息</span><span class="pageindex">1 / 10</span>
          <a href="javascript:;" title="首页">首页</a>
          <a href="javascript:;" >上一页</a>
          <a href="javascript:;" >1</a>
          <a href="javascript:;" >2</a>
          <span class="current">3</span>
          <a href="javascript:;" >4</a>
          <a href="javascript:;" >5</a>
          <a href="javascript:;" >下一页</a>
          <a href="javascript:;" title="尾页">尾页</a>
        </div>
      </div>
     
    </div>
  <div class="btn_wrap">
      <div class="btn_wrap_pd">
        <label class="mr20"><input type="checkbox" class="J_check_all" data-direction="y" data-checklist="J_check_y">全选</label>                
        <button class="btn  J_ajax_submit_btn" type="submit" data-action="">排序</button>
        <button class="btn J_ajax_submit_btn" type="submit" data-action="">审核</button>
        <button class="btn J_ajax_submit_btn" type="submit" data-action="">取消审核</button>
        <button class="btn J_ajax_submit_btn" type="submit" data-action="">删除</button>
        <button class="btn" type="button" onClick="pushs()">推送</button>
        <button class="btn" type="button" id="J_Content_remove">批量移动</button>
        <button class="btn J_ajax_submit_btn" type="submit" data-action="">批量生成HTML</button>
      </div>
    </div>


</div>
{include file="Common:Js"/}
</body>
</html>
