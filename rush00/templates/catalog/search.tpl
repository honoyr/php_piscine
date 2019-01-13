<!-- INCLUDE header.tpl -->
<div class="catalog w">
    <div class="head">
        <h2>Поиск</h2>
        <div class="description text">Найдено товаров: {SEARCH_TOTAL}</div>
    </div>
    <!-- BEGIN products -->
    <div class="items">
        <!-- BEGIN product -->
        <div class="item">
            <h3><a href="catalog/item/{product.ID}">{product.NAME}</a></h3>
            <!-- BEGIN product.picture --><div class="img {product.LABEL}"><a href="catalog/item/{product.ID}"><img src="images/product/s/{product.picture.SRC}" alt="{product.NAME}"/></a></div><!-- END product.picture -->
            <div class="brief text"><p>{product.BRIEF}</p></div>
            <!-- BEGIN product.price_old --><div class="oldprice">Старая цена: <span>{product.PRICE_OLD}</span> Р</div><!-- END product.price_old -->
            <!-- BEGIN product.price --><div class="price">Цена: <span>{product.PRICE}</span></div><!-- END product.price -->
            <div class="actions">
                <a href="catalog/item/{product.ID}" class="button gray view">Подробнее</a>
                <div class="button red cart" id="{product.ID}">В корзину</div>
            </div>
        </div>
        <!-- END product -->
        <!-- BEGIN paginator -->
        <div class="oPager"> 
            <!-- BEGIN paginator.first --><a href="catalog/search/{SEARCH_QUERY2}/page/{paginator.first.NUM}{URL_POSTFIX}">{paginator.first.NUM}</a><!-- END paginator.first -->
            <!-- BEGIN paginator.separator1 --><ins>...</ins><!-- END paginator.separator1 -->
            <!-- BEGIN paginator.middle1 --><a href="catalog/search/{SEARCH_QUERY2}/page/{paginator.middle1.NUM}{URL_POSTFIX}">{paginator.middle1.NUM}</a><!-- END paginator.middle1 -->
            <!-- BEGIN paginator.current --><i>{paginator.current.NUM}</i><!-- END paginator.current -->
            <!-- BEGIN paginator.middle2 --><a href="catalog/search/{SEARCH_QUERY2}/page/{paginator.middle2.NUM}{URL_POSTFIX}">{paginator.middle2.NUM}</a><!-- END paginator.middle2 -->
            <!-- BEGIN paginator.separator2 --><ins>...</ins><!-- END paginator.separator2 -->
            <!-- BEGIN paginator.last --><a href="catalog/search/{SEARCH_QUERY2}/page/{paginator.last.NUM}{URL_POSTFIX}">{paginator.last.NUM}</a><!-- END paginator.last -->
        </div>
        <!-- END paginator -->
    </div>
    <!-- END products --> 
</div> 
<!-- INCLUDE footer.tpl -->