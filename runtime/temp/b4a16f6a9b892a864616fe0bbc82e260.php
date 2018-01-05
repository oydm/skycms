<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"F:\www\thinkphp\public/../application/admin\view\Common\success.php";i:1500973372;s:65:"F:\www\thinkphp\public/../application/admin\view\Common\Cssjs.php";i:1488264017;s:62:"F:\www\thinkphp\public/../application/admin\view\Common\Js.php";i:1501140469;}*/ ?>
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