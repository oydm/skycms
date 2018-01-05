<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>提示信息</title>
    {include file="admin@Common:Cssjs"/}
</head>
<body>
<div class="wrap">
    <div id="success_tips">
        <h2>成功</h2>
        <div class="success_cont">
            <ul>
                <li>{$msg}</li>
            </ul>
            <div class="success_return"><a href="<?php echo($url); ?>" id="href" class="btn">返回</a>  <b id="wait" style="padding-left: 10px"><?php echo($wait); ?></b></div>
        </div>
    </div>
</div>
{include file="admin@Common:Js"/}
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