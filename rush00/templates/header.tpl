<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- INCLUDE head.tpl -->
<body><div class="bg">
<div class="main">
    <!-- BEGIN widget.menu -->
    <div class="menu"><ul>
        <!-- BEGIN widget.menu.item -->
        <li><a href="{widget.menu.item.LINK}">{widget.menu.item.TITLE}</a></li>
        <!-- END widget.menu.item -->
    </ul></div>
    <!-- END widget.menu -->
    <div class="header"><table><tr>
        <td width="33%"><div class="logo">
            <a href="./"><!-- BEGIN logo --><img src="images/logo/logo.png?rand={RAND}" alt="{SITE_NAME}"/><!-- END logo --></a>
        </div></td>
        <td width="33%"><div class="cert">
            <!-- BEGIN widget.if_cert -->
            <div class="arrow L"></div>
            <div class="arrow R"></div>
            <div class="items">
                <!-- BEGIN widget.cert -->
                <div class="item"><a href="images/cert/{widget.cert.FILE}?rand={RAND}" class="fancybox" rel="cert"><img src="images/cert/s/{widget.cert.FILE}?rand={RAND}" alt=""/></a></div>
                <!-- END widget.cert -->
            </div>
            <!-- END widget.if_cert -->
        </div></td>
        <td width="33%"><div class="contact">
            <div class="phone"><span>{PHONE}</span></div>
            <div class="phone2"><span>{PHONE2}</span></div>
            <div class="time">{WORK_HOURS}</div>
            <div class="button red3 call">Заказать обратный звонок</div>
        </div></td>
    </tr>
    <!-- BEGIN descript -->
    <tr><td colspan="3"><div class="descript">{DESCRIPT}</div></td></tr>
    <!-- END descript -->
    </table></div>
    <!-- BEGIN blocks -->
    <div class="blocks"><table><tr>
        <!-- BEGIN guarantee -->
        <td width="33%" class="w"><div class="block">
            <h2>{guarantee.HEADER}</h2>
            <div class="L"><!-- BEGIN guarantee.img --><a href="{guarantee.LINK}"><img src="images/stuff/guarantee.png?rand={RAND}" alt=""/></a><!-- END guarantee.img --></div>
            <div class="R">
                <div class="text">{guarantee.BODY}</div>
            </div>
        </div></td>
        <!-- END guarantee -->
        <!-- BEGIN promo -->
<!-- BEGIN promo.timer -->
<script:no-cache language="javascript" type="text/javascript"> 
$(document).ready(function(){
    setInterval(function(){
        var now = new Date(); 
        var endTS = {promo.TIMESTAMP}*1000; 
        var totalRemains = (endTS-now.getTime()); 
        if (totalRemains>1){ 
            var RemainsSec=(parseInt(totalRemains/1000)); 
            var RemainsFullDays=(parseInt(RemainsSec/(24*60*60))); 
            var secInLastDay=RemainsSec-RemainsFullDays*24*3600; 
            var RemainsFullHours=(parseInt(secInLastDay/3600)); 
            if (RemainsFullHours<10){RemainsFullHours="0"+RemainsFullHours}; 
            var secInLastHour=secInLastDay-RemainsFullHours*3600; 
            var RemainsMinutes=(parseInt(secInLastHour/60)); 
            if (RemainsMinutes<10){RemainsMinutes="0"+RemainsMinutes}; 
            var lastSec=secInLastHour-RemainsMinutes*60; 
            if (lastSec<10){lastSec="0"+lastSec}; 
            $('.timer>.digits').html((RemainsFullDays ? "<span>"+RemainsFullDays+"дн.</span> " :"")+RemainsFullHours+":"+RemainsMinutes+":"+lastSec);
        } 
        else {$(".timer").remove();} 
    },1000);
});
</script>
<!-- END promo.timer -->
        <td width="33%" class="w"><div class="block">
            <h2>{promo.HEADER}</h2>
            <div class="L"><!-- BEGIN promo.img --><a href="{promo.LINK}"><img src="images/stuff/promo.png?rand={RAND}" alt=""/></a><!-- END promo.img --></div>
            <div class="R">
                <div class="text">{promo.BODY}</div>
                <!-- BEGIN promo.timer -->
                <div class="timer">
                    <p>До конца акции</p>
                    <div class="digits"></div>
                </div>
                <!-- END promo.timer -->
            </div>
        </div></td>
        <!-- END promo -->
        <!-- BEGIN discount -->
        <td width="33%" class="w"><div class="block">
            <h2>{discount.HEADER}</h2>
            <div class="L"><!-- BEGIN discount.img --><a href="{discount.LINK}"><img src="images/stuff/discount.png?rand={RAND}" alt=""/></a><!-- END discount.img --></div>
            <div class="R"><div class="text">{discount.BODY}</div></div>
        </div></td>
        <!-- END discount -->
    </tr></table></div>
    <!-- END blocks -->
    <!-- BEGIN widget.cats -->
    <div class="cats w"><ul>
        <!-- BEGIN widget.cat -->
        <li<!-- BEGIN widget.cat.has_child --> class="active"<!-- END widget.cat.has_child -->>
            <span><a href="catalog/{widget.cat.KEY}">{widget.cat.NAME}</a></span>
            <!-- BEGIN widget.cat.has_child -->
            <ul>
                <!-- BEGIN widget.cat.sub -->
                <li<!-- BEGIN widget.cat.sub.has_child --> class="active"<!-- END widget.cat.sub.has_child -->>
                    <span><a href="catalog/{widget.cat.sub.KEY}">{widget.cat.sub.NAME}</a></span>
                    <!-- BEGIN widget.cat.sub.has_child -->
                    <ul>
                        <!-- BEGIN widget.cat.sub.sub2 -->
                        <li><span><a href="catalog/{widget.cat.sub.sub2.KEY}">{widget.cat.sub.sub2.NAME}</a></span></li>
                        <!-- END widget.cat.sub.sub2 -->
                    </ul>
                    <!-- END widget.cat.sub.has_child -->
                </li>
                <!-- END widget.cat.sub -->
            </ul>
            <!-- END widget.cat.has_child -->
        </li>
        <!-- END widget.cat -->
    </ul></div>
    <!-- END widget.cats -->
    <div class="body">
        <div class="R">
            <!-- BEGIN widget.search -->
            <div class="block search w">
                <h2>Поиск по каталогу</h2>
                <form action="catalog/search" method="post">
                    <input type="text" name="query" value="{SEARCH_QUERY}"/>
                </form>
            </div>
            <!-- END widget.search -->
            <!-- BEGIN category_block -->
            <div class="block w">
                {category_block.HTML}
            </div>
            <!-- END category_block -->
            <!-- BEGIN widget.testimonials -->
            <div class="testimonials w">
                <h2>Отзывы</h2>
                <!-- BEGIN widget.tst -->
                <div class="item">
                    <!-- BEGIN widget.tst.picture --><div class="L"><a href="images/people/l/{widget.tst.picture.SRC}" class="fancybox" title='{widget.tst.NAME}, {widget.tst.DUTIES}, {widget.tst.CITY}'><img src="images/people/s/{widget.tst.picture.SRC}" alt=""/></a></div><!-- END widget.tst.picture -->
                    <div<!-- BEGIN widget.tst.picture --> class="R"<!-- END widget.tst.picture -->>
                        <div class="text">&laquo;{widget.tst.MESSAGE}&raquo;</div>
                        <div class="author">{widget.tst.NAME},<br/>{widget.tst.DUTIES}, {widget.tst.CITY}<!-- BEGIN widget.tst.website --><br/><a href="http://{widget.tst.WEBSITE}" target="_blank">{widget.tst.WEBSITE}</a><!-- END widget.tst.website --></div>
                    </div>
                </div>
                <!-- END widget.tst -->
                <div class="button gray write"><span>Оставить отзыв</span></div>
                <span class="all"><a href="testimonials">Все отзывы</a> ({widget.testimonials.TOTAL})</span>
            </div>
            <!-- END widget.testimonials -->
            <!-- BEGIN widget.justbuy -->
            <div class="block justbuy w">
                <h2>{widget.justbuy.NAME}</h2>
                <!-- BEGIN widget.justbuy.item -->
                <div class="item">
	                <!-- BEGIN widget.justbuy.item.picture --><div class="L"><a href="catalog/item/{widget.justbuy.item.ID}"><img src="images/product/s/{widget.justbuy.item.picture.SRC}" alt=""/></a></div><!-- END widget.justbuy.item.picture -->
	                <div class="R">
	                    <div class="name"><a href="catalog/item/{widget.justbuy.item.ID}">{widget.justbuy.item.NAME}</a></div>
	                    <div class="text">{widget.justbuy.item.BRIEF}</div>
	                </div>
                </div>
                <!-- END widget.justbuy.item -->
            </div>
            <!-- END widget.justbuy -->
            <!-- BEGIN vk -->
            <div class="block w">
                <h2>Сообщество</h2>
                <div id="vk_groups" style="margin-bottom:10px;"></div>
                <script:no-cache type="text/javascript">
                VK.Widgets.Group("vk_groups", {mode: 0, width: "272", height: "218"}, {vk.GROUP_ID});
                </script>
                <script:no-cache type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
                <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,lj"></div> 
            </div>
            <!-- END vk -->
        </div>
        <div class="L">