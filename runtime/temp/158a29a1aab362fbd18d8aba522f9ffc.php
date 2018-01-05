<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:64:"F:\www\thinkphp\public/../application/admin\view\article\add.php";i:1501923690;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>系统管理后台</title>
<link href="/static/admin/css/admin_style.css" rel="stylesheet" />
<link href="/static/admin/js/layui/css/layui.css" rel="stylesheet" />
</head>
<style type="text/css">
            .col-auto {
                overflow: hidden;
                _zoom: 1;
                _float: left;
                border: 1px solid #c2d1d8;
            }
            .col-right {
                float: right;
                width: 210px;
                overflow: hidden;
                margin-left: 6px;
                border: 1px solid #c2d1d8;
            }

            body fieldset {
                border: 1px solid #D8D8D8;
                padding: 10px;
                background-color: #FFF;
            }
            body fieldset legend {
                background-color: #F9F9F9;
                border: 1px solid #D8D8D8;
                font-weight: 700;
                padding: 3px 8px;
            }
            .picList li{ float: left; margin-top: 2px; margin-right: 5px;}
        </style>
<body class="J_scroll_fixed">
    <div class="wrap jj">
        <div class="nav">
            <ul class="cc">
                <li ><a href="<?php echo url("/Admin/article/index",array("catid"=>input('catid'))); ?>">内容列表</a></li>
                <li class="current"><a href="<?php echo url("/Admin/article/add",array("catid"=>input('catid'))); ?>">添加内容</a></li>
            </ul>
        </div>
        <div class="common-form">
            <form method="post" class="J_ajaxForm" action="<?php echo Url('Admin/Article/add'); ?>">
                <div class="h_a">文章信息</div>
                <div class="table_full">
                    <table width="100%" class="table_form contentWrap">
                        <tbody>
                            <tr>
                                <th width="80">栏目</th>
                                <td>
                                    <span class="must_red">*</span>
                                    <input type="hidden" name="catid" id="catid" value="<?php echo $catid; ?>">
                                    <?php echo $catname; ?>
                                </td>
                            </tr>

                            <tr>
                                <th width="80">标题</th>
                                <td>
                                    <span class="must_red">*</span>
                                    <input type="text" name="title" class="input length_6 input_hd" placeholder="请输入标题" id="title" value="">
                                    <input name="islink" type="checkbox" id="islink"  value="1" >
                                    <font color="red">转向链接</font>
                                </td>
                            </tr>

                            <tr id="linktr">
                                <th width="80">外部链接</th>
                                <td>
                                    <input type="text" name="url" class="input length_6 input_hd" placeholder="请输入链接" id="url" value="">
                                    <span class="gray">请填写带http://的链接</span>
                                </td>
                            </tr>

                            <tr>
                                <th>文章图片：</th>
                                <td><input type="text" name="thumb" id="image" class="input length_5" value="" style="float: left"  runat="server" ondblclick='image_priview(this.value);'>&nbsp;
                                    <input type="button" class="" value="选择上传" id="uploadify" > <span class="gray"> 双击文本框查看图片</span></td>
                            </tr>
                            <tr>
                                <th>内容摘要</th>
                                <td>
                                    <textarea  name="description" id="description" class="valid" style="width:500px;height:80px;"></textarea>
                                    <span class="gray">不填写会自动截取内容正文的前250个字符</span>
                                </td>
                            </tr>
                            <tr id="contenttr">
                                <th>内容正文</th>
                                <td>
                                    <textarea  name="content" id="content"></textarea>
                                </td>
                            </tr>
                            <!-- <tr>
                                <th>图片列表：</th>
                                <td>
                                    <fieldset class="blue pad-10">
                                        <legend>图片列表</legend>
                                        <center><div class="onShow" id="nameTip">您最多每次可以同时上传 <font color="red">10</font> 张,双击文本框查看图片</div></center>
                                        <ul id="albums" class="picList"></ul>
                                    </fieldset>

                                    <div class="bk10"></div>
                                    <input type="button" class="button btn_submit" value="选择上传" id="uploadify1" > </td>
                            </tr>-->
                            <tr>
                                <th>属性</th>
                                <td>
                                  <ul class="switch_list cc ">
                  <li>
                    <label>
                      <input type='radio' name='type' value='1' >
                      <span>推荐</span></label>
                  </li>
                  <li>
                    <label>
                      <input type='radio' name='type' value='0'  checked>
                      <span>不推荐</span></label>
                  </li>
                </ul>
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
                      <input type='radio' name='status' value='0' >
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
                        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">添加</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/layui/layui.js"></script>
<script src="/static/admin/js/laydate/laydate.js"></script>
<script src="/static/admin/js/tabs.js"></script>
<script src="/static/admin/js/ajaxForm.js"></script>
<script src="/static/admin/js/common.js"></script>
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
                    'insertunorderedlist', '|', 'emoticons', 'image', 'link'],
                afterBlur: function(){  //利用该方法处理当富文本编辑框失焦之后，立即同步数据
                    KindEditor.sync("#content") ;
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(function(){
            if ($("input[name='islink']:checkbox").attr("checked")) {
                $("#linktr").show();
                $("#contenttr").hide();
            } else {
                $("#contenttr").show();
                $("#linktr").hide();
            }
            $("input[name='islink']:checkbox").click(function() {
                if ($(this).attr("checked")) {
                    $("#linktr").show();
                    $("#contenttr").hide();
                } else {
                    $("#contenttr").show();
                    $("#linktr").hide();
                }
            })
        });
    </script>
</body>
</html>