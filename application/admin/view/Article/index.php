{include file="Common:Head" /}
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    <div class="nav">
        <ul class="cc">
            <li class="current"><a href="{:url("/Admin/article/index",array("catid"=>input('catid')))}">内容列表</a></li>
            <li><a href="{:url("/Admin/article/add",array("catid"=>input('catid')))}">添加内容</a></li>
        </ul>
    </div>
        <div class="h_a">搜索</div>
        <form method="get" class="J_ajaxForm" action="{:Url('Admin/Article/index')}">
            <input type="hidden" value="1" name="search">
            <input type="hidden" value="{$catid}" name="catid">
            <div class="search_type cc mb10">
                <div class="mb10"> <span class="mr20">
                        时间：
                        <input type="text" name="start_time" class="input length_2 J_date laydate-icon" value="{$Think.get.start_time}" style="width:80px;">
                        -
                        <input type="text" class="input length_2 J_date laydate-icon" name="end_time" value="{$Think.get.end_time}" style="width:80px;">
                        审核：
                        <select class="select_2" name="status" style="width:70px;">
                            <option value=""  {empty name="Think.get.status"}selected{/empty}>全部</option>
                            <option value="1" {if condition=" $Think.get.status eq '1'"} selected{/if}>审核</option>
                            <option value="0" {if condition=" $Think.get.status eq '0'"} selected{/if}>未审核</option>
                        </select>
                        关键字：
                        <select class="select_2" name="searchtype" style="width:70px;">
                            <option value='0' {if condition=" $searchtype eq '0' "} selected{/if}>标题</option>
                            <option value='1' {if condition=" $searchtype eq '1' "} selected{/if}>简介</option>
                            <option value='2' {if condition=" $searchtype eq '2' "} selected{/if}>用户名</option>
                            <option value='3' {if condition=" $searchtype eq '3' "} selected{/if}>ID</option>
                        </select>
                        <input type="text" class="input length_2" name="keyword" style="width:200px;" value="{$Think.get.keyword}" placeholder="请输入关键字...">
                        <button class="btn">搜索</button>
                    </span>
                </div>
            </div>
        </form> 

        <form action="" class="J_ajaxForm" method="post" >
            <div class="table_list">
                <table width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></td>
                            <td width="5%" align="center">排序</td>
                            <td width="5%" align="center" >ID</td>
                            <td width="45%" align="left" >标题</td>
                            <td width="10%" align="left" >所属栏目</td>
                            <td width="15%"  align="center" >发布时间</td>
                            <td width="10%"  align="center" >发布人</td>
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
                                {if condition="$vo.status eq 0"} <span style="color: red">[未审核]</span>{/if}
                                {if condition="$vo.type eq 1"} <span style="color: red">[推]</span>{/if}
                                {if condition="$vo.islink eq 1"} <span style="color: red">[外链]</span>{/if}
                               <span title="{$vo.title}">{$vo.sortitle}</span></td>
                            <td align="left" >{$vo.catname}</td>
                            <td align="center" >{$vo.inputtime|date="Y-m-d H:i:s",###}</td>
                            <td align="center" >{$vo.username}</td>
                            <td align="center" >
                              <a href="{:Url('Admin/Article/edit',array('id'=>$vo['id']))}" >修改</a> |
                              <a href="{:Url('Admin/Article/delete',array('id'=>$vo['id']))}"  class="J_ajax_del">删除</a>
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

                                  <button class="btn btn_submit J_ajax_submit_btn" data-action="{:Url('Admin/Article/listorder')}" type="submit" value="listorder" >排序</button>

                                  <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="{:Url('Admin/Article/review')}" type="submit" name="submit" value="review">审核</button>

                              <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="{:Url('Admin/Article/unreview')}" type="submit" name="submit" value="unreview">取消审核</button>

                             <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="{:Url('Admin/Article/pushs')}" type="submit" name="submit" value="pushs">推荐</button>

                             <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="{:Url('Admin/Article/unpushs')}" type="submit" name="submit" value="unpushs">取消推荐</button>

                              <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="{:Url('Admin/Article/del')}" type="submit" name="submit" value="del">删除</button>

                    
                </div>
            </div>
        </form>
    </div>
{include file="Common:Js" /}
<script src="/static/admin/js/content.js"></script>
</body>
</html>