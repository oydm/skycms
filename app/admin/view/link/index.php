{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    {include file="Common:Nav"/}
    <div class="h_a">搜索</div>
    <form method="get" action="{:Url('Admin/Link/index')}">
        <input type="hidden" value="1" name="search">
        <div class="search_type cc mb10">
            <div class="mb10"> <span class="mr20">
                        类型：
                        <select class="select_2" name="catid">
                            <option value="" >全部</option>
                            {$category}
                        </select>
                        审核：
                        <select class="select_2" name="status" style="width:70px;">
                            <option value=""  {empty name="Think.get.status"}selected{/empty}>全部</option>
                            <option value="1" {if condition=" $Think.get.status eq '1'"} selected{/if}>审核</option>
                            <option value="0" {if condition=" $Think.get.status eq '0'"} selected{/if}>未审核</option>
                        </select>

                        <button class="btn">搜索</button>
                    </span> </div>
        </div>
    </form>

    <form action="" method="post" class="J_ajaxForm">
        <div class="table_list">
            <table width="100%" cellspacing="0">
                <thead>
                <tr>
                    <td><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></td>
                    <td width="5%" align="center">排序</td>
                    <td width="5%" align="center" >ID</td>
                    <td width="35%" align="left" >标题</td>
                    <td width="15%" align="left" >LOGO图片</td>
                    <td width="10%" align="left" >所属分类</td>
                    <td width="10%"  align="center" >链接类型</td>
                    <td width="10%"  align="center" >状态</td>
                    <td width="15%" align="center" >管理操作</td>
                </tr>
                </thead>
                <tbody>
                {volist name="data" id="vo"}
                    <tr>
                        <td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="{$vo.id}"></td>
                        <td align="center" ><input name='listorders[{$vo.id}]' class="input mr5"  type='text' size='3' value='{$vo.listorder}' align="center"></td>
                        <td align="center" >{$vo.id}</td>
                        <td align="left" >
                            <span title="{$vo.title}">{$vo.sortitle}</span></td>
                        <td align="left" >
                            {if condition="$vo.type eq 1"}
                                <img src="{$vo.image}" height="30" >
                            {/if}
                        </td>
                        <td align="left" >{$vo.catname}</td>
                        <td align="center" >{if condition="$vo.type eq 2"}文字链接{/if}{if condition="$vo.type eq 1"}图片链接{/if}</td>
                        <td align="center" >{if condition="$vo.status eq 0"} <span style="color: red">未审核</span>{/if}
                            {if condition="$vo.status eq 1"} <span style="color: #5FB878">已审核</span>{/if}
                        </td>
                        <td align="center" >
                                <a href="{:Url('Admin/Link/edit',array('id'=>$vo['id']))}" >修改</a> |
                                <a href="{:Url('Admin/Link/delete',array('id'=>$vo['id']))}" class="J_ajax_del">删除</a>
                        </td>
                    </tr>
                {/volist}
                </tbody>
            </table>
            <div class="p10">
                <div class="pages"> {$Page} </div>
            </div>
        </div>

        <div class="btn_wrap">
            <div class="btn_wrap_pd">
                <label class="mr20"><input type="checkbox" class="J_check_all" data-direction="y" data-checklist="J_check_y">全选</label>
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" data-action="{:Url('Admin/Link/listorder')}" type="submit" name="submit" value="listorder" >排序</button>
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" data-action="{:Url('Admin/Link/review')}" type="submit" name="submit" value="review">审核</button>
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" data-action="{:Url('Admin/Link/unreview')}" type="submit" name="submit" value="unreview">取消审核</button>
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" data-action="{:Url('Admin/Link/del')}" type="submit" name="submit" value="del">删除</button>
            </div>
        </div>
    </form>
</div>
{include file="Common:Js" /}
</body>
</html>