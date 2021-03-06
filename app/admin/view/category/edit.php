{include file="Common:Head" /}
<style>
.pop_nav{
	padding: 0px;
}
.pop_nav ul{
	border-bottom:1px solid #266AAE;
	padding:0 5px;
	height:25px;
	clear:both;
}
.pop_nav ul li.current a{
	border:1px solid #266AAE;
	border-bottom:0 none;
	color:#333;
	font-weight:700;
	background:#F3F3F3;
	position:relative;
	border-radius:2px;
	margin-bottom:-1px;
}

</style>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
{include file="Common:Nav"/}
<form name="myform" id="myform" action="{:Url('Admin/Category/edit')}" method="post" class="J_ajaxForm">
    <div class="pop_nav">
        <ul class="J_tabs_nav">
          <li class="current"><a href="javascript:;;">基本属性</a></li>
          <li class=""><a href="javascript:;;">选项设置</a></li>
        </ul>
    </div>
    <div class="tabs_content J_tabs_contents">
      <div class="J_tabs_div">
        <div class="h_a">基本属性</div>
        <div class="table_full">
          <table width="100%" >
            <tr>
              <th width="200">请选择模型：</th>
              <td><select name="modelid" id="modelid">
                  <option value="" {if condition="'' eq $data['modelid']"}selected{/if}>请选择模型</option>
                  <option value="2" {if condition="2 eq $data['modelid']"}selected{/if}>列表模块</option>
                  <option value="1" {if condition="1 eq $data['modelid']"}selected{/if}>单页模块</option>
                </select></td>
            </tr>
            <tr>
              <th width="200">上级栏目：</th>
              <td><select name="parentid" id="parentid">
                  <option value='0'>≡ 作为一级栏目 ≡</option>
                  {$category}
                </select></td>
            </tr>
            <tr id="normal_add">
              <th>栏目名称：</th>
              <td><input type="text" name="catname" id="catname" class="input" value="{$data.catname}"></td>
            </tr>
            <tr id="catdir_tr">
              <th>英文名称：</th>
              <td><input type="text" name="encatname" id="encatname" class="input" value="{$data.encatname}"></td>
            </tr>
            <tr>
              <th>栏目缩略图：</th>
              <td><input type="text" name="image" id="image" class="input length_5" value="{$data.image}" style="float: left"   runat="server" ondblclick='image_priview(this.value);'>&nbsp;
                  <input type="button" class="" value="选择上传" id="uploadify" ><span class="gray"> 双击文本框查看图片</span></td>
            </tr>
            <tr>
              <th>栏目简介：</th>
              <td><textarea name="description" maxlength="255" style="width:300px;height:60px;">{$data.description}</textarea></td>
            </tr>
              <tr>
              <th >是否显示：</th>
              <td><ul class="switch_list cc ">
                  <li>
                    <label>
                      <input type='radio' name='ismenu' value='1' {if condition="$data['ismenu'] eq '1' "}checked{/if}>
                      <span>显示</span></label>
                  </li>
                  <li>
                    <label>
                      <input type='radio' name='ismenu' value='0'  {if condition="$data['ismenu'] eq '0' "}checked{/if}>
                      <span>不显示</span></label>
                  </li>
                </ul></td>
            </tr>
            <tr>
              <th>显示排序：</th>
              <td><input type="text" name="listorder" id="listorder" class="input" value="{$data.listorder}"></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="J_tabs_div">
        <div class="h_a">选项设置</div>
        <div class="table_full">
          <table width="100%">
          <tr >
              <th  width="200"><strong>META Title（栏目标题）</strong><br/>
                针对搜索引擎设置的标题</th>
              <td><input name='meta_title' type='text' id='meta_title' class="input" value='{$data.meta_title}' size='60' maxlength='60'></td>
            </tr>
            <tr>
              <th ><strong>META Keywords（栏目关键词）</strong><br/>
                关键字中间用半角逗号隔开</th>
              <td><textarea name='meta_keywords' id='meta_keywords' style="width:90%;height:40px">{$data.meta_keywords}</textarea></td>
            </tr>
            <tr>
              <th ><strong>META Description（栏目描述）</strong><br/>
                针对搜索引擎设置的网页描述</th>
              <td><textarea name='meta_description' id='meta_description' style="width:90%;height:50px">{$data.meta_description}</textarea></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="btn_wrap">
      <div class="btn_wrap_pd">
          <input type="hidden" name="type" value="{$data.type}">
          <input name="id" type="hidden" value="{$data.id}">
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">提交</button>
      </div>
    </div>
  </form>
</div>
{include file="Common:Js" /}
<script src="/static/admin/js/content.js"></script>
<link rel="stylesheet" href="/static/admin/js/editor/themes/default/default.css" />
<script charset="utf-8" src="/static/admin/js/editor/kindeditor.js"></script>
<script charset="utf-8" src="/static/admin/js/editor/lang/zh-CN.js"></script>
<script>
    KindEditor.ready(function(K) {
        var uploadbutton = K.uploadbutton({
            button : K('#uploadify')[0],
            fieldName : 'imgFile',
            url : '/Admin/Upload/imgfile.html',
            afterUpload : function(data) {
                if (data.state === 1) {
                    var url = K.formatUrl(data.info, 'absolute');
                    K('#image').val(url);
                } else {
                    layui.use('layer', function(){
                        var layer = layui.layer;
                        layer.msg(data.info, {time: 2000,icon: 2});
                    });
                }
            },
            afterError : function(str) {
                layui.use('layer', function(){
                    var layer = layui.layer;
                    layer.msg(str, {time: 2000,icon: 2});
                });
            }
        });
        uploadbutton.fileBox.change(function(e) {
            uploadbutton.submit();
        });
    });
</script>
</body>
</html>