<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>冰火王座官方网站-冰火世界首款MMORPG手游</title>
    <meta content="顶级3D西方魔幻MMO手游《冰火王座》，目前开放三大职业，可体验团队PK、多人副本玩法。自研金刚3D技术引擎，逼真还原装备坐骑，兼顾流畅度和光影渲染，战斗时打击感更强。基于纯正《冰与火之歌》的世界观，全新打造史诗剧情，献给魔幻粉的情怀巨作！" name="description" />
    <meta content="冰与火之歌,权力的游戏,异鬼,铁王座,MMORPG,手游" name="keywords" />
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link href="/static/home/pc/css/style.css" rel='stylesheet' type='text/css'>
    <script src="/static/home/pc/js/jquery-1.8.3.min.js"></script>
    <script src="/static/home/pc/js/jquery.fullPage.min.js"></script>
    <link href="/static/home/pc/css/jquery.fullPage.css" rel='stylesheet' type='text/css'>
</head>
<body>
<ul id="menu">
    <li data-menuanchor="page1" class="active"><a href="#page1">官网首页</a></li>
    <li data-menuanchor="page2"><a href="#page2">背景介绍</a></li>
    <li data-menuanchor="page3"><a href="#page3">职业介绍</a></li>
</ul>
<div id="dowebok">
    <div class="section ipage1">
        <div class="logo_content">
            <div class="logo"><img src="/static/home/pc/img/logo.png"></div>
            <div class="center_contrall">
                <div class="index_tip"><img src="/static/home/pc/img/index_tips.png"></div>
                <div class="goto">
                    <a href="http://bhqz.wemepi.com/" target="_blank"></a>
                    <!--<a href="http://bh.wemepi.com/download.php?channel=80000000"></a>-->
                </div>
                <div class="scroll_down"></div>
            </div>
        </div>
        <div class="index_new">
            <div class="new_contrall"><a class="on" href="javascript:;;"></a></div>
            <div class="index_new_main">
                <div class="new_top">官方资讯</div>
                <ul id="index_new_ul">
                    {volist name="data" id="vo" key="k"}
                    <li class="index_new_li {eq name="k" value="3"}noli_ubderline{/eq}">
                        <span class="index_new_content">
                            <a  href="/news/{$vo.id}">{$vo.sortitle}</a>
                            <i>{$vo.inputtime|date="m-d",###}</i>
                        </span>
                    </li>
                    {/volist}
                </ul>
                <div class="index_page">
                    <input name="cur_page" id="cur_page" value="{$cur_page}" type="hidden">
                    <a href="javascript:;" class="prev"></a>
                    <a href="javascript:;" class="next"></a>
                </div>
            </div>
            <i class="clear_both"></i>
        </div>
    </div>
    <div class="section ipage2">
        <div class="main outlook">
            <div class="outlook_1"><img src="/static/home/pc/img/outlook.png"></div>
            <div class="outlook_content">
                <p>8000年前，“先民”与“森林之子”经过4000年旷日持久的战争，最终签订了和平盟誓。从此“森林之子”继续居住在鱼梁木林深处，而“先民”则占据了所有森林之外的区域，除了终年冰冻的极北之地。同时，“先民”接受了“森林之子”的信仰，开始在“心树”下祈祷。一切似乎都在向更加和谐的方向发展。</p>
                <br/>
                <p>然而，一个被称为“异鬼”的黑暗种族突然从北方崛起，迅速向维斯特洛南方横扫，所到之处留下无尽的死亡和废墟，并伴随着几乎一代人的寒冬。他们痛恨光明与温暖，骑着巨大的冰蜘蛛和复活的死马奔袭而来，手持薄如刀片的寒冰之剑，屠杀眼前的一切生灵。他们复活死者为他们战斗，没有军队可以抵抗他们，人类的存亡迫在眉睫……</p>
            </div>


        </div>
    </div>
    <div class="section ipage3">
        <div class="main center_abs">
            <div class="tab_content">
                <div class="main employment" >
                    <div class="flamen_left">
                        <div class="employment_1"><img src="/static/home/pc/img/employment.png"></div>
                        <div class="flamen1"><img src="/static/home/pc/img/flamen1.png"></div>
                        <div class="flamen_des">
                            <ul>
                                <li><span>职业名称：</span><font>祭司</font></li>
                                <li><span>职业介绍：</span><font>女祭司信奉光之王拉赫洛，拥有强大的魔法和预言能力。她们不需要像凡人一样进食，仅靠光之王就能满足所需能量。同时，光之王教导了她们对黑暗和寒冬深深的憎恶。
                                    </font></li>
                                <li><span>操作难度：</span><font><img src="/static/home/pc/img/stars.png"><img src="/static/home/pc/img/stars.png"><img src="/static/home/pc/img/stars.png"><img src="/static/home/pc/img/star.png"><img src="/static/home/pc/img/star.png"></font></li>
                            </ul>
                        </div>
                        <div class="skill">
                            <ul>
                                <li class="flamen_skill1">
                                    <span class="skill_desc"><span>技能效果：</span><font>以自身为中心释放暴风雪，对4米范围内的敌人造成持续伤害</font></span>
                                </li>
                                <li class="flamen_skill2">
                                    <span class="skill_desc"><span>技能效果：</span><font>向前方10米释放一排冰锥，对目标造成大量伤害</font></span>
                                </li>
                                <li class="flamen_skill3">
                                    <span class="skill_desc"><span>技能效果：</span><font>以自身为中心释放若干道闪电，并对4米内的敌人造成大量伤害</font></span>
                                </li>
                                <li class="flamen_skill4">
                                    <span class="skill_desc"><span>技能效果：</span><font>瞬间向四周释放寒冰之力，对附近4米内的敌人造成伤害</font></span>
                                </li>
                                <i class="clear_both"></i>
                            </ul>
                        </div>
                    </div>
                    <div class="flamen_peo"></div>
                    <i class="clear_both"></i>
                </div>
                <div class="main employment" >
                    <div class="flamen_left">
                        <div class="employment_1"><img src="/static/home/pc/img/employment.png"></div>
                        <div class="flamen1"><img src="/static/home/pc/img/wizard.png"></div>
                        <div class="flamen_des">
                            <ul>
                                <li><span>职业名称：</span><font>血术士</font></li>
                                <li><span>职业介绍：</span><font>血术士是来自东方的神秘力量，他们的信仰和神祗被隐藏的很好，不为外人所知。世人对他们仅有的了解就是他们掌握着强大的血魔法，并用生命守护着不朽神殿的秘密。
                                    </font></li>
                                <li><span>操作难度：</span><font><img src="/static/home/pc/img/stars.png"><img src="/static/home/pc/img/stars.png"><img src="/static/home/pc/img/stars.png"><img src="/static/home/pc/img/stars.png"><img src="/static/home/pc/img/star.png"></font></li>
                            </ul>
                        </div>
                        <div class="skill">
                            <ul>
                                <li class="wizard_skill1">
                                    <span class="skill_desc"><span>技能效果：</span><font>以敌人为圆心召唤血池，对4米范围内敌人造成持续伤害，使目标减速50%持续5秒</font></span>
                                </li>
                                <li class="wizard_skill2">
                                    <span class="skill_desc"><span>技能效果：</span><font>召唤一群蝙蝠进行突袭，对前方直线上敌人造成伤害，并对目标造成3次流血伤害</font></span>
                                </li>
                                <li class="wizard_skill3">
                                    <span class="skill_desc"><span>技能效果：</span><font>化身血影冲向5米范围内的目标，并对路径上的敌人造成伤害，使目标眩晕2秒</font></span>
                                </li>
                                <li class="wizard_skill4">
                                    <span class="skill_desc"><span>技能效果：</span><font>原地挥舞镰刀使刀芒四射，对自身范围4米内的敌人造成3次伤害</font></span>
                                </li>
                                <i class="clear_both"></i>
                            </ul>
                        </div>
                    </div>
                    <div class="wizard_peo"></div>
                    <i class="clear_both"></i>
                </div>
                <div class="main employment" >
                    <div class="flamen_left">
                        <div class="employment_1"><img src="/static/home/pc/img/employment.png"></div>
                        <div class="flamen1"><img src="/static/home/pc/img/wizard.png"></div>
                        <div class="flamen_des">
                            <ul>
                                <li><span>职业名称：</span><font>圣骑士</font></li>
                                <li><span>职业介绍：</span><font>骑士是维斯特洛战士传统的一部分，是英勇、荣耀、守诺、忠诚、信仰的存在。虽然并非所有骑士都是那么高尚，但作为守护维斯特洛的重要力量，其战斗力毋庸置疑。
                                    </font></li>
                                <li><span>操作难度：</span><font><img src="/static/home/pc/img/stars.png"><img src="/static/home/pc/img/stars.png"><img src="/static/home/pc/img/star.png"><img src="/static/home/pc/img/star.png"><img src="/static/home/pc/img/star.png"></font></li>
                            </ul>
                        </div>
                        <div class="skill">
                            <ul>
                                <li class="warrior_skill1">
                                    <span class="skill_desc"><span>技能效果：</span><font>奋力向下跺脚，击倒自身附近2.5米的敌人</font></span>
                                </li>
                                <li class="warrior_skill2">
                                    <span class="skill_desc"><span>技能效果：</span><font>瞬间爆发增加攻击力，并对4米内的敌人造成伤害</font></span>
                                </li>
                                <li class="warrior_skill3">
                                    <span class="skill_desc"><span>技能效果：</span><font>给自身加防御盾，并对4米内的敌人造成伤害</font></span>
                                </li>
                                <li class="warrior_skill4">
                                    <span class="skill_desc"><span>技能效果：</span><font>高速冲向5米范围内的目标，并对路人上的敌人造成伤害</font></span>
                                </li>
                                <i class="clear_both"></i>
                            </ul>
                        </div>
                    </div>
                    <div class="warrior_peo"></div>
                    <i class="clear_both"></i>
                </div>
            </div>
            <div class="tab">
                <ul class="J_tabs_nav">
                    <li  class="current"><a class="tab1" href="javascript:;;"></a></li>
                    <li><a class="tab2" href="javascript:;;"></a></li>
                    <li><a class="tab3" href="javascript:;;"></a></li>
                </ul>
            </div>
            <i class="clear_both"></i>
        </div>
    </div>
</div>
<script src="/static/home/pc/js/tabs.js"></script>
<script>
    $(function(){
        $('#cur_page').val(1);
        var tabs_nav = $('ul.J_tabs_nav');
        if (tabs_nav.length) {
            var tabs_contents= tabs_nav.parent().prev('.tab_content').find('.employment');
            $('.J_tabs_nav').tabs(tabs_contents);
        }
        $(".new_contrall a").click(function(){
            $(".index_new_main").toggle();
            $(this).toggleClass("off");
            $(".index_new").toggleClass("index_new_off");
        })
        $(".skill ul li").hover(function(){
            $(this).find('.skill_desc').show();
        })
        $(".skill ul li").mouseleave(function(){
            $(this).find('.skill_desc').hide();
        })
        $('#dowebok').fullpage({
            anchors: ['page1', 'page2', 'page3'],
            menu: '#menu',
            keyboardScrolling:true,
        });
        $(window).resize(function(){
            autoScrolling();
        });
        $("a.prev").click(function(){
            var p=parseInt($("#cur_page").val())-1;
            if(p==0){
                alert('第一页');
                return false;
            }
            $.getJSON('/index/index/get_index_new?p='+p,function (data) {
                if (data.code == 1) {
                    $('#index_new_ul').html(data.html_data);
                    $('#cur_page').val(p);
                } else{
                    alert("没有数据了");
                }
            });
        })
        $("a.next").click(function(){
            var p=parseInt($("#cur_page").val())+1;
            $.getJSON('/index/index/get_index_new?p='+p,function (data) {
                if (data.code == 1) {
                    $('#index_new_ul').html(data.html_data);
                    $('#cur_page').val(p);
                }else {
                    alert("没有数据了");
                }
            });
        })
        function autoScrolling(){
            var $ww = $(window).width();
            if($ww < 1024){
                $.fn.fullpage.setAutoScrolling(false);
            } else {
                $.fn.fullpage.setAutoScrolling(true);
            }
        }
        autoScrolling();
        function flash_cha(){
            var fls = flashChecker();
            var s = "";
            if (fls.f){
                $(".goto").append("<embed src=\"/static/home/pc/img/btn.swf\" width=317 height=201 type=application/x-shockwave-flash wmode=\"transparent\" quality=\"high\"/>");
            }else{
                $(".goto").append("<span></span>");
            }
        }
        function flashChecker() {
            var hasFlash = 0; //是否安装了flash
            var flashVersion = 0; //flash版本
            if (document.all) {
                var swf = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
                if (swf) {
                    hasFlash = 1;
                    VSwf = swf.GetVariable("$version");
                    flashVersion = parseInt(VSwf.split(" ")[1].split(",")[0]);
                }
            } else {
                if (navigator.plugins && navigator.plugins.length > 0) {
                    var swf = navigator.plugins["Shockwave Flash"];
                    if (swf) {
                        hasFlash = 1;
                        var words = swf.description.split(" ");
                        for (var i = 0; i < words.length; ++i) {
                            if (isNaN(parseInt(words[i]))) continue;
                            flashVersion = parseInt(words[i]);
                        }
                    }
                }
            }
            return { f: hasFlash, v: flashVersion };
        }
        flash_cha();


    });
</script>
</body>
</html>