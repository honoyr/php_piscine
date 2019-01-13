<!-- BEGIN widget.if_pano -->
<script type="text/javascript">
$(document).ready(function() {
    var pano = $(".pano");
    $(".Pager a",pano).eq(0).addClass('active');
    $(".Pager a",pano).click(function(){
        var item = $(this);
        $(".Slider>a",pano).attr('href',$(item).attr('href'));
        var img = new Image();
        img.src = $(item).attr('rel');
        $(".Slider>a>img",pano).fadeOut(500,'linear',function(){
            $(".Slider>a>img",pano).attr('src',img.src).fadeIn(500);
        });
        $(".Pager a",pano).removeClass('active');
        $(item).addClass('active');
        return false;
    });
    var startPano = function(){
        return setInterval(function(){
            var next = $(".Pager a.active",pano).next();
            if (!next.length) {
                next = $(".Pager a:eq(0)",pano);
            }
            next.click();
        },5000);
    }
    var panoInterval = startPano();
    pano.mouseover(function(){
        clearInterval(panoInterval);
    }).mouseout(function(){
        panoInterval = startPano();
    });
});
</script>
<div class="pano" style="height:158px">
    <!-- BEGIN widget.pano -->
    <div class="Slider">
        <a href="{widget.pano.LINK}"><img src="images/pano/{widget.pano.FILE}" alt=""/></a>
        <!-- BEGIN widget.pano.pages -->
        <div class="Pager" style="display:none">
            <div class="Bg"><i>&nbsp;</i><b>&nbsp;</b><u>&nbsp;</u></div>
            <div class="in"><!-- BEGIN widget.pano.page --><a href="{widget.pano.page.LINK}" rel="images/pano/{widget.pano.page.FILE}" class="e">{widget.pano.page.NUM}</a><!-- END widget.pano.page --></div>
        </div>
        <!-- END widget.pano.pages -->
    </div>
    <!-- END widget.pano -->
</div>
<!-- END widget.if_pano -->