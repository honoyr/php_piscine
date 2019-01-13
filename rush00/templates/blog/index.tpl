<!-- INCLUDE header.tpl -->
<div class="blog w">
    <a href="blog/rss" class="rss"></a>
    <h2>{TITLE}</h2>
    <!-- BEGIN blog -->
    <div class="item">
        <h3><a href="blog/note/{blog.KEY}">{blog.NAME}</a></h3>
        <div class="text">{blog.CONTENT}</div>
        <div class="date">{blog.DATE}</div>
        <div class="more"><a href="blog/note/{blog.KEY}">Читать далее &raquo;</a></div>
    </div>
    <!-- END blog -->
    <!-- BEGIN paginator -->
    <div class="oPager"> 
        <!-- BEGIN paginator.first --><a href="blog/page/{paginator.first.NUM}{URL_POSTFIX}">{paginator.first.NUM}</a><!-- END paginator.first -->
        <!-- BEGIN paginator.separator1 --><ins>...</ins><!-- END paginator.separator1 -->
        <!-- BEGIN paginator.middle1 --><a href="blog/page/{paginator.middle1.NUM}{URL_POSTFIX}">{paginator.middle1.NUM}</a><!-- END paginator.middle1 -->
        <!-- BEGIN paginator.current --><i>{paginator.current.NUM}</i><!-- END paginator.current -->
        <!-- BEGIN paginator.middle2 --><a href="blog/page/{paginator.middle2.NUM}{URL_POSTFIX}">{paginator.middle2.NUM}</a><!-- END paginator.middle2 -->
        <!-- BEGIN paginator.separator2 --><ins>...</ins><!-- END paginator.separator2 -->
        <!-- BEGIN paginator.last --><a href="blog/page/{paginator.last.NUM}{URL_POSTFIX}">{paginator.last.NUM}</a><!-- END paginator.last -->
    </div>
    <!-- END paginator -->
</div>
<!-- INCLUDE footer.tpl -->