{include file="Common:Head" /}
<body class="J_scroll_fixed">
    <div class="wrap J_check_wrap">
        {include file="Common:Nav"/}
        <div class="h_a">站点配置</div>
             <form method='post' class="J_ajaxForm" action="{:Url('Admin/Config/index')}">
             <div class="table_full">
                <table cellpadding=0 cellspacing=0 width="100%" class="table_form" >
                    <tr>
                        <th width="140">站点名称:</th>
                        <td><input type="text" class="input"  name="sitename" value="{$Site.sitename}" size="40"></td>
                    </tr>
                    <tr>
                        <th width="140">网站域名:</th>
                        <td><input type="text" class="input"  name="siteurl" value="{$Site.siteurl}" size="40"> <span class="gray"> 请以“/”结尾，当前域名 {$URL}</span></td>
                    </tr>
                     <tr>
                        <th width="140">网站标题:</th>
                        <td><input type="text" class="input"  name="sitetitle" value="{$Site.sitetitle}" size="40"></td>
                    </tr>
                    <tr>
                        <th width="140">网站关键字:</th>
                        <td><input type="text" class="input"  name="sitekeywords" value="{$Site.sitekeywords}" size="40"> </td>
                    </tr>
                    <tr>
                        <th width="140">网站描述:</th>
                        <td><textarea name="sitedescription" style="width:350px; height:100px;">{$Site.sitedescription}</textarea> </td>
                    </tr>
                     <tr>
                        <th width="140">网站电话:</th>
                        <td><input type="text" class="input"  name="sitetel" value="{$Site.sitetel}" size="40"> </td>
                    </tr>
                    <tr>
                        <th width="140">公司地址:</th>
                        <td><input type="text" class="input"  name="siteaddress" value="{$Site.siteaddress}" size="40"> </td>
                    </tr>
                    <tr>
                        <th width="140">版权信息:</th>
                        <td><input type="text" class="input"  name="sitecopyright" value="{$Site.sitecopyright}" size="40"> </td>
                    </tr>
                    <tr>
                        <th width="140">备案号:</th>
                        <td><input type="text" class="input"  name="siteicp" value="{$Site.siteicp}" size="40"> </td>
                    </tr>
                        <tr>
                        <th width="140">侧边联系方式:</th>
                        <td><textarea name="siteleftcontact" style="width:350px; height:100px;">{$Site.siteleftcontact}</textarea>  <span class="gray"> 允许写入HTML标签；例如：换行使用<<span>br</span>/></span></td>
                    </tr>
                       <tr>
                        <th width="140">第三方代码:</th>
                        <td><textarea name="sitecode" style="width:350px; height:100px;">{$Site.sitecode}</textarea>  <span class="gray"> 允许写入HTML标签</span></td>
                    </tr>
                </table>
                </div>
                <div class="btn_wrap">
                    <div class="btn_wrap_pd">             
                        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">提交</button>
                    </div>
            </form>
        </div>
    </div>
    {include file="Common:Js"/}
</body>
</html>