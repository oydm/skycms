<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"F:\www\thinkphp\public/../application/index\view\news\read.php";i:1501923872;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>冰火王座官方网站-冰火世界首款MMORPG手游</title>
    <meta id="description" content="顶级3D西方魔幻MMO手游《冰火王座》，目前开放三大职业，可体验团队PK、多人副本玩法。自研金刚3D技术引擎，逼真还原装备坐骑，兼顾流畅度和光影渲染，战斗时打击感更强。基于纯正《冰与火之歌》的世界观，全新打造史诗剧情，献给魔幻粉的情怀巨作！" name="description" />
    <meta id="keywords" content="冰与火之歌,权力的游戏,异鬼,铁王座,MMORPG,手游" name="keywords" />
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link href="/static/home/pc/css/style.css" rel='stylesheet' type='text/css'>
</head>
<body class="new_bg">
<div class="logo_content">
    <div class="logo"><img src="/static/home/pc/img/logo.png"></div>
    <a class="home" href="/"></a>
</div>
<div class="new_main" >
    <div class="left">
        <div class="download"><img src="/static/home/pc/img/1501725032.png" width="135"></div>
        <a class="story_float" href="http://bhqz.wemepi.com" target="_blank"></a>
    </div>
    <div class="right">
        <div class="right_title">官方资讯 / NEWS</div>
        <div class="new_content">
            <div class="title"><?php echo $data['title']; ?></div>
            <div class="time">[<?php echo date("Y-m-d",$data['inputtime']); ?>]</div>
            <div class="content">
                <?php echo $data['content']; ?>
            </div>
        </div>
    </div>
    <i class="clear_both"></i>
</div>
<div class="foot">
    <div class="share">分享到：&nbsp;
        <a class="weixin" href="javascript:;">微信
            <div class="erweima">
            </div>
        </a>
        <a class="sina"  href="javascript:;" onclick="share_sina(1)">新浪微博</a>
        <a class="qzone" href="javascript:;" onclick="share_qzone(1)">QQ空间</a>

    </div>
    <div class="bottom">
        <div class="foot_logo"><img src="/static/home/pc/img/weme.png" ></div>
        <div class="copyright">
            深圳微米动力科技有限公司版权所有 &copy;2013-2017
        </div>
    </div>
</div>
<script>
    function share_qzone(idx) {
        var _url=document.URL;
        var _desc=document.getElementById("description").content;
        var _summary=document.getElementById("description").content;
        var _title=document.title;
        var _site=document.URL;
        var _pic='http://bh.wemepi.com/img/pc.jpg';
        var _showcount=1;
        var _width=1000;
        var _height=500;
        var _shareUrl = 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?';
        _shareUrl += 'url=' + encodeURIComponent(_url||document.location);   //参数url设置分享的内容链接|默认当前页location
        _shareUrl += '&showcount=' + _showcount||0;      //参数showcount是否显示分享总数,显示：'1'，不显示：'0'，默认不显示
        _shareUrl += '&desc=' + encodeURIComponent(_desc||'分享的描述');    //参数desc设置分享的描述，可选参数
        _shareUrl += '&summary=' + encodeURIComponent(_summary||'分享摘要');    //参数summary设置分享摘要，可选参数
        _shareUrl += '&title=' + encodeURIComponent(_title||document.title);    //参数title设置分享标题，可选参数
        _shareUrl += '&site=' + encodeURIComponent(_site||'');   //参数site设置分享来源，可选参数
        _shareUrl += '&pics=' + encodeURIComponent(_pic||'');   //参数pics设置分享图片的路径，多张图片以＂|＂隔开，可选参数
        if(idx==2){
            window.location.href = _shareUrl;
        }else{
            window.open(_shareUrl,'_blank','width='+_width+',height='+_height+',top='+(screen.height-_height)/2+',left='+(screen.width-_width)/2+',toolbar=no,menubar=no,scrollbars=no, resizable=1,location=no,status=0');
        }
    }
    function share_sina(idx) {
        event.preventDefault();
        var _url=document.URL;
        var _source=document.getElementById("description").content;
        var _summary=document.getElementById("description").content;
        var _title=document.getElementById("description").content;
        var _sourceUrl=document.URL;
        var _pic='http://bh.wemepi.com/img/pc.jpg';
        var _width=1000;
        var _height=500;
        var _shareUrl = 'http://v.t.sina.com.cn/share/share.php?&appkey=895033136';     //真实的appkey，必选参数
        _shareUrl += '&url='+ encodeURIComponent(_url||document.location);     //参数url设置分享的内容链接|默认当前页location，可选参数
        _shareUrl += '&title=' + encodeURIComponent(_title||document.title);    //参数title设置分享的标题|默认当前页标题，可选参数
        _shareUrl += '&source=' + encodeURIComponent(_source||'');
        _shareUrl += '&sourceUrl=' + encodeURIComponent(_sourceUrl||'');
        _shareUrl += '&content=' + 'utf-8';   //参数content设置页面编码gb2312|utf-8，可选参数
        _shareUrl += '&pic=' + encodeURIComponent(_pic||'');  //参数pic设置图片链接|默认为空，可选参数
        if(idx==2){
            window.location.href = _shareUrl;
        }else{
            window.open(_shareUrl,'_blank','width='+_width+',height='+_height+',top='+(screen.height-_height)/2+',left='+(screen.width-_width)/2+',toolbar=no,menubar=no,scrollbars=no, resizable=1,location=no,status=0');
        }
    }
    function share_qq(idx){
        var _url=document.URL;
        var _desc=document.getElementById("description").content;
        var _summary=document.getElementById("keywords").content;
        var _title=document.title;
        var _site=document.URL;
        var _pic='http://bh.wemepi.com/img/pc.jpg';
        var _showcount=1;
        var _width=1000;
        var _height=700;
        var p = {
            url : _url,
            desc:_desc,
            title:_title,
            summary :_summary, /*分享摘要(可选)*/
            pics : _pic, /*分享图片(可选)*/
            flash : '', /*视频地址(可选)*/
            site : _url, /*分享来源(可选) 如：QQ分享*/
            style : '201',
            width : 32,
            height : 32
        };
        var s = [];
        for ( var i in p) {
            s.push(i + '=' + encodeURIComponent(p[i] || ''));
        }
        var url = "http://connect.qq.com/widget/shareqq/index.html?"+s.join('&');
        if(idx==2){
            window.location.href = url;
        }else{
            //window.location.href = url;
            window.open(url,'_blank','width='+_width+',height='+_height+',top='+(screen.height-_height)/2+',left='+(screen.width-_width)/2+',toolbar=no,menubar=no,scrollbars=no, resizable=1,location=no,status=0');
        }

    }
</script>
</body>
</html>