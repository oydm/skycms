{include file="Common:Head" /}
<body>
<div class="wrap">
    <!--搜索开始-->
    <div class="h_a">有关“<span class="red">{$keyword}</span>”的搜索结果</div>
    <div class="search_list">

                {volist name="data" id="vo"}
                <h2><a class="J_search_items" href="{:Url($vo["name"],array('menuid'=>$vo['id']) )}" data-id="{$vo.id}Admin"><?php echo str_replace($keyword,"<font color=\"red\">".$keyword."</font>",$vo['title'])?></a></h2>
                {/volist}

    </div>
    <!--搜索结束-->
</div>
{include file="Common:Js"/}
<script>
    $(function(){
        $('a.J_search_items').on('click', function(e){
            e.preventDefault();
            var $this = $(this);
            var data_id = $(this).attr('data-id');
            var href = this.href;
            parent.window.iframeJudge({
                elem: $this,
                href: href,
                id: data_id
            });
        });

    });

</script>
</body>
</html>