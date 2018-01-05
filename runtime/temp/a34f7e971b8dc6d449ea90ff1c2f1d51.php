<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:66:"F:\www\thinkphp\public/../application/admin\view\article\index.php";i:1501750545;s:64:"F:\www\thinkphp\public/../application/admin\view\Common\Head.php";i:1484295982;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>系统管理后台</title>
<link href="/static/admin/css/admin_style.css" rel="stylesheet" />
<link href="/static/admin/js/layui/css/layui.css" rel="stylesheet" />
</head>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    <div class="nav">
        <ul class="cc">
            <li class="current"><a href="<?php echo url("/Admin/article/index",array("catid"=>input('catid'))); ?>">内容列表</a></li>
            <li><a href="<?php echo url("/Admin/article/add",array("catid"=>input('catid'))); ?>">添加内容</a></li>
        </ul>
    </div>
        <div class="h_a">搜索</div>
        <form method="get" class="J_ajaxForm" action="<?php echo Url('Admin/Article/index'); ?>">
            <input type="hidden" value="1" name="search">
            <input type="hidden" value="<?php echo $catid; ?>" name="catid">
            <div class="search_type cc mb10">
                <div class="mb10"> <span class="mr20">
                        时间：
                        <input type="text" name="start_time" class="input length_2 J_date laydate-icon" value="<?php echo \think\Request::instance()->get('start_time'); ?>" style="width:80px;">
                        -
                        <input type="text" class="input length_2 J_date laydate-icon" name="end_time" value="<?php echo \think\Request::instance()->get('end_time'); ?>" style="width:80px;">
                        审核：
                        <select class="select_2" name="status" style="width:70px;">
                            <option value=""  <?php if(empty(\think\Request::instance()->get('status')) || (\think\Request::instance()->get('status') instanceof \think\Collection && \think\Request::instance()->get('status')->isEmpty())): ?>selected<?php endif; ?>>全部</option>
                            <option value="1" <?php if(\think\Request::instance()->get('status') == '1'): ?> selected<?php endif; ?>>审核</option>
                            <option value="0" <?php if(\think\Request::instance()->get('status') == '0'): ?> selected<?php endif; ?>>未审核</option>
                        </select>
                        关键字：
                        <select class="select_2" name="searchtype" style="width:70px;">
                            <option value='0' <?php if($searchtype == '0'): ?> selected<?php endif; ?>>标题</option>
                            <option value='1' <?php if($searchtype == '1'): ?> selected<?php endif; ?>>简介</option>
                            <option value='2' <?php if($searchtype == '2'): ?> selected<?php endif; ?>>用户名</option>
                            <option value='3' <?php if($searchtype == '3'): ?> selected<?php endif; ?>>ID</option>
                        </select>
                        <input type="text" class="input length_2" name="keyword" style="width:200px;" value="<?php echo \think\Request::instance()->get('keyword'); ?>" placeholder="请输入关键字...">
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
                    <?php if(is_array($data) || $data instanceof \think\Collection): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="<?php echo $vo['id']; ?>"></td>
                            <td align="center" ><input name='listorders[<?php echo $vo['id']; ?>]' class="input mr5"  type='text' size='3' value='<?php echo $vo['listorder']; ?>' align="center"></td>
                            <td align="center" ><?php echo $vo['id']; ?></td>
                            <td align="left" >
                                <?php if($vo['status'] == 0): ?> <span style="color: red">[未审核]</span><?php endif; if($vo['type'] == 1): ?> <span style="color: red">[推]</span><?php endif; if($vo['islink'] == 1): ?> <span style="color: red">[外链]</span><?php endif; ?>
                               <span title="<?php echo $vo['title']; ?>"><?php echo $vo['sortitle']; ?></span></td>
                            <td align="left" ><?php echo $vo['catname']; ?></td>
                            <td align="center" ><?php echo date("Y-m-d H:i:s",$vo['inputtime']); ?></td>
                            <td align="center" ><?php echo $vo['username']; ?></td>
                            <td align="center" >
                              <a href="<?php echo Url('Admin/Article/edit',array('id'=>$vo['id'])); ?>" >修改</a> |
                              <a href="<?php echo Url('Admin/Article/delete',array('id'=>$vo['id'])); ?>"  class="J_ajax_del">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                   <div class="p10">
                <div class="pages"> <?php echo $Page; ?> </div>
            </div>
            </div>
         
            <div class="btn_wrap">
                <div class="btn_wrap_pd">
                    <label class="mr20"><input type="checkbox" class="J_check_all" data-direction="y" data-checklist="J_check_y">全选</label>   

                                  <button class="btn btn_submit J_ajax_submit_btn" data-action="<?php echo Url('Admin/Article/listorder'); ?>" type="submit" value="listorder" >排序</button>

                                  <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="<?php echo Url('Admin/Article/review'); ?>" type="submit" name="submit" value="review">审核</button>

                              <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="<?php echo Url('Admin/Article/unreview'); ?>" type="submit" name="submit" value="unreview">取消审核</button>

                             <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="<?php echo Url('Admin/Article/pushs'); ?>" type="submit" name="submit" value="pushs">推荐</button>

                             <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="<?php echo Url('Admin/Article/unpushs'); ?>" type="submit" name="submit" value="unpushs">取消推荐</button>

                              <button class="btn btn_submit J_ajax_submit_btn mr10 " data-action="<?php echo Url('Admin/Article/del'); ?>" type="submit" name="submit" value="del">删除</button>

                    
                </div>
            </div>
        </form>
    </div>
<script src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/layui/layui.js"></script>
<script src="/static/admin/js/laydate/laydate.js"></script>
<script src="/static/admin/js/tabs.js"></script>
<script src="/static/admin/js/ajaxForm.js"></script>
<script src="/static/admin/js/common.js"></script>
<script src="/static/admin/js/content.js"></script>
</body>
</html>