{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap jj">
    <div class="nav">
        <ul class="cc">
            <li class="current"><a href="{:url("/Admin/pages/edit",array("catid"=>input('catid')))}">{$catname}</a></li>
        </ul>
    </div>
    <div class="common-form">
        <!---->
        <form method="post" action="{:Url('Admin/Pages/edit')}" class="J_ajaxForm">
            <div class="h_a">单页内容</div>
            <div class="table_full">
                <table width="100%" class="table_form contentWrap">
                    <tbody>
                    <tr>
                        <th width="80">标题</th>
                        <td> <input type="hidden" name="id" value="{$data.id}"/>
                            <input type="hidden" name="catid" value="{$data.catid}"/>
                            <span class="must_red">*</span><input type="text" name="title" class="input length_6 input_hd" placeholder="请输入标题" id="title" value="{$data.title}">
                        </td>
                    </tr>
                    <tr>
                        <th>图片：</th>
                        <td><input type="text" name="thumb" id="image" class="input length_5" placeholder="双击文本框查看图片" ondblclick='image_priview(this.value);' value="{$data.thumb}" style="float: left"  runat="server">&nbsp;
                            <input type="button" class="" value="选择上传" id="uploadify" style="float: left" ></td>
                    </tr>
                    <tr>
                        <th>内容摘要</th>
                        <td>
                            <textarea  name="description" id="description" class="valid" style="width:500px;height:80px;">{$data.description}</textarea>
                            <span class="gray">不填写会自动截取内容正文的前250个字符</span>
                        </td>
                    </tr>
                    <tr>
                        <th>内容正文</th>
                        <td><span class="must_red">*</span>
                            <textarea  name="content" id="content">{$data.content}</textarea>
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
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[name="content"]', {
            resizeType : 1,
            width:'800px',
            height:'400px',
            allowPreviewEmoticons : false,
            allowImageUpload : true,
            uploadJson:'/Admin/Upload/imgedit.html',
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'image', 'link']
        });
    });
</script>
</body>
</html>