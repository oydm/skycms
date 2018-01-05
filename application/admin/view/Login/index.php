<!doctype html>
<html>
    <head>
        <meta charset="GBK" />
        <title>网站管理系统后台</title>
        <link href="/static/admin/css/admin_login.css?v20130227" rel="stylesheet" />
    </head>
    <body>
        <div class="wrap">
            <h1><a href="">后台管理中心</a></h1>
            <form method="post" action="{:url('login')}" id="RegForm" name="RegForm" class="J_ajaxForm">
                <div class="login">
                    <ul>
                        <li>
                            <input class="input"  id="username" name="username"type="text"  title="用户名" placeholder="用户名" />
                        </li>
                        <li>
                            <input class="input" id="password" name="password" type="password"  title="密码" placeholder="密码"/>
                        </li>
                         <li>
                            <input class="input" id="verify" name="verify" type="text" style="width:130px;"  title="密码" placeholder="验证码" />
                            <div class="yanzhengma_box" id="verifyshow"><img class="verifyimg reloadverify" style=" cursor: pointer;" align="right"  src="{:url('verify')}" title="点击刷新"> </div>
                        </li>
                    </ul>
                     <button type="submit" class="btn J_ajax_submit_btn" id="subbtn">登录</button>
                </div>
                </form>
        </div>
<script language="javascript" type="text/javascript" src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/ajaxForm.js"></script>
<script src="/static/admin/js/common.js"></script>
<script>
		$(document).ready(function(){
			var verifyimg = $(".verifyimg").attr("src");
	        $(".reloadverify").click(function(){
	                if( verifyimg.indexOf('?')>0){
	                    $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
	                }else{
	                    $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
	                }
	            });
			});
                     
</script>
</body>
</html>
