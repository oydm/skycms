{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap jj">
    {include file="Common:Nav"/}
    <div class="common-form">
        <form method="post"  action="{:Url('Admin/Link/add')}" class="J_ajaxForm">
            <div class="h_a">链接信息</div>
            <div class="table_full">
                <table width="100%" class="table_form contentWrap">
                    <tbody>
                    <tr>
                        <th width="80">链接类型</th>
                        <td>
                            <span class="must_red">*</span>
                            <select class="select_2" name="catid">
                                <option value="" >请选择链接类型</option>
                                {$category}
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th width="80">标题</th>
                        <td>
                            <span class="must_red">*</span>
                            <input type="text" name="title" class="input length_6 input_hd" placeholder="请输入标题" id="title" value="">
                            <input name="type" type="checkbox" id="type"  value="2">
                            <font color="red">文字链接</font>
                        </td>
                    </tr>

                    <tr >
                        <th width="80">链接地址</th>
                        <td>
                            <input type="text" name="url" class="input length_6 input_hd" placeholder="请输入链接" id="url" value="">
                            <span class="gray">请填写带http://的链接</span>
                        </td>
                    </tr>

                    <tr id="logo">
                        <th>LOGO图片：</th>
                        <td><input type="text" name="image" id="image" class="input length_5" value="" style="float: left"  runat="server" ondblclick='image_priview(this.value);'>&nbsp;
                            <input type="button" class="" value="选择上传" id="uploadify" ><span class="gray"> 双击文本框查看图片</span></td>
                    </tr>
                    <tr>
                        <th>链接描述</th>
                        <td>
                            <textarea  name="description" id="description" class="valid" style="width:500px;height:80px;"></textarea>

                        </td>
                    </tr>

                    <tr>
                        <th>审核</th>
                        <td>
                            <ul class="switch_list cc ">
                                <li>
                                    <label>
                                        <input type='radio' name='status' value='1' checked>
                                        <span>审核</span></label>
                                </li>
                                <li>
                                    <label>
                                        <input type='radio' name='status' value='0'>
                                        <span>未审核</span></label>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
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