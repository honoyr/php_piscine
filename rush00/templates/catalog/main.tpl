<!-- INCLUDE header.tpl -->
<div class="catalog w">
    <!-- BEGIN page --><div class="text">{page.CONTENT}</div><!-- END page -->
    <div class="items">
        <!-- BEGIN product -->
        <div class="item">
            <h3><a href="catalog/item/{product.ID}">{product.NAME}</a></h3>
            <!-- BEGIN product.picture -->
            <div class="img {product.LABEL}">
                <a href="catalog/item/{product.ID}"><img src="images/product/s/{product.picture.SRC}" alt="{product.NAME}"/></a>
            </div>
            <!-- END product.picture -->
            <div class="brief text"><p>{product.BRIEF}</p></div>
            <!-- BEGIN product.price_old --><div class="oldprice text">Старая цена: {product.PRICE_OLD} грн.</div><!-- END product.price_old -->
            <!-- BEGIN product.price --><div class="price">Цена: {product.PRICE} грн.</div><!-- END product.price -->
            <div class="actions">
                <a href="catalog/item/{product.ID}" class="button gray view">Подробнее</a>
                <div class="button red cart" id="{product.ID}">В корзину</div>
            </div>
        </div>
        <!-- END product -->
    </div>
</div>
<!-- INCLUDE footer.tpl -->