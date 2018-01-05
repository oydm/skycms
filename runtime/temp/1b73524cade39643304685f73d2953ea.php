<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\success.php";i:1514947361;s:59:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Cssjs.php";i:1503375391;s:56:"F:\www\bhwz\2.0.1\public/../app/admin\view\Common\Js.php";i:1503375391;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>提示信息</title>
    <link href="/static/admin/css/admin_style.css" rel="stylesheet" />
<link href="/static/admin/js/layui/css/layui.css" rel="stylesheet" />
</head>
<body>
<div class="wrap">
    <div id="success_tips">
        <h2>成功</h2>
        <div class="success_cont">
            <ul>
                <li><?php echo $msg; ?></li>
            </ul>
            <div class="success_return"><a href="<?php echo($url); ?>" id="href" class="btn">返回</a>  <b id="wait" style="padding-left: 10px"><?php echo($wait); ?></b></div>
        </div>
    </div>
</div>
<script src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/layui/layui.js"></script>
<script src="/static/admin/js/laydate/laydate.js"></script>
<script src="/static/admin/js/tabs.js"></script>
<script src="/static/admin/js/ajaxForm.js"></script>
<script src="/static/admin/js/common.js"></script>
<script type="text/javascript">
   /* (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();*/
</script>
</body>
</html>