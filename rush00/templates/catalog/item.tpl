<!-- INCLUDE header.tpl -->            
<div class="product w item">
    <!-- BEGIN product -->
    <!-- BEGIN if_uppercats -->
    <div class="uppercats">
        <!-- BEGIN uppercat --><a href="catalog/{uppercat.KEY}">{uppercat.NAME}</a> &raquo; <!-- END uppercat -->
    </div>
    <!-- END if_uppercats -->
    <div class="L">
	    <!-- BEGIN product.picture -->
	    <div class="img cycle {product.LABEL}">
	        <a href="images/product/l/{product.picture.SRC}" title='{product.NAME}' class="fancybox" rel="gallery"><img src="images/product/s/{product.picture.SRC}" title='{product.NAME}' alt='{product.NAME}'/></a>
	        <!-- BEGIN product.album --><a href="images/product/l/{product.album.SRC}" title='{product.NAME}' class="fancybox" rel="gallery"><img src="images/product/s/{product.album.SRC}" title='{product.NAME}' alt='{product.NAME}'/></a><!-- END product.album -->
	    </div>
        <!-- END product.picture -->
        <!-- BEGIN product.if_album -->
        <div class="album">
            <!-- BEGIN product.picture --><a href="images/product/l/{product.picture.SRC}" title='{product.NAME}' class="fancybox" rel="album"><img src="images/product/s/{product.picture.SRC}" title='{product.NAME}' alt='{product.NAME}'/></a><!-- END product.picture -->
            <!-- BEGIN product.album --><a href="images/product/l/{product.album.SRC}" title='{product.NAME}' class="fancybox" rel="album"><img src="images/product/s/{product.album.SRC}" title='{product.NAME}' alt='{product.NAME}'/></a><!-- END product.album -->
        </div>
        <!-- END product.if_album -->
        <!-- BEGIN vk -->
        <div id="vk_like" style="margin-top:10px;"></div>
        <script:no-cache type="text/javascript">
        VK.Widgets.Like("vk_like", {type: "button"});
        </script>
        <!-- END vk -->
    </div>
    <div class="R">
	    <h2>{product.NAME}</h2>
	    <div class="text">
	        {product.DESCRIPTION}
	        <!-- BEGIN product.sizes -->
	        <h3>В наличии:</h3>
	        <table>
            <tr><th>Цвет</th><th>Размеры</th></tr>
	        <!-- BEGIN product.size --><tr><td>{product.size.COLOR}</td><td>{product.size.SIZE}</td></tr><!-- END product.size -->
	        </table>
	        <!-- END product.sizes -->
	    </div>
	    <!-- BEGIN product.price_old --><div class="oldprice text">Старая цена: <span>{product.PRICE_OLD}</span> грн.</div><!-- END product.price_old -->
        <!-- BEGIN product.price --><div class="price">Цена: {product.PRICE} грн.</div><!-- END product.price -->
        <div class="actions">
            <div class="button red3 cart" id="{product.ID}">Купить</div>
        </div>
     </div>
     <!-- BEGIN product.seotext --><div class="text basement">{product.SEOTEXT}</div><!-- END product.seotext -->
     <!-- END product -->
</div>
<!-- BEGIN see_also -->
<div class="catalog w">
    <div class="head">
        <h3>С этим товаром чаще всего покупают</h3>
    </div>
    <div class="items">
        <!-- BEGIN also -->
        <div class="item">
            <h3><a href="catalog/item/{also.ID}">{also.NAME}</a></h3>
            <!-- BEGIN also.picture -->
            <div class="img {also.LABEL}">
                <a href="catalog/item/{also.ID}"><img src="images/product/s/{also.picture.SRC}" alt=""/></a>
            </div>
            <!-- END also.picture -->
            <div class="brief text"><p>{also.BRIEF}</p></div>
            <!-- BEGIN also.price_old --><div class="oldprice text">Старая цена: {also.PRICE_OLD} грн.</div><!-- END also.price_old -->
            <!-- BEGIN also.price --><div class="price">Цена: {also.PRICE}  грн.</div><!-- END also.price -->
            <div class="actions">
                <a href="catalog/item/{also.ID}" class="button gray view">Подробнее</a>
                <div class="button red cart" id="{also.ID}">Купить</div>
            </div>
        </div>
        <!-- END also -->
    </div>
</div>
<!-- END see_also -->
<!-- INCLUDE footer.tpl -->