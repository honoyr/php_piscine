<!-- INCLUDE header.tpl -->
<div class="testimonials w">
    <h2>Отзывы</h2>
    <!-- BEGIN tst -->
    <div class="item">
        <!-- BEGIN tst.picture --><div class="L"><a href="images/people/l/{tst.picture.SRC}" class="fancybox"><img src="images/people/s/{tst.picture.SRC}" alt=""/></a></div><!-- END tst.picture -->
        <div<!-- BEGIN tst.picture --> class="R"<!-- END tst.picture -->>
            <div class="text">&laquo;{tst.MESSAGE}&raquo;</div>
            <div class="author">{tst.NAME},<br/>{tst.DUTIES}, {tst.CITY}<!-- BEGIN tst.website --><br/><a href="http://{tst.WEBSITE}" target="_blank">{tst.WEBSITE}</a><!-- END tst.website --></div>
        </div>
    </div>
    <!-- END tst -->
    <div class="button gray write"><span>Оставить отзыв</span></div>
</div>
<!-- INCLUDE footer.tpl -->