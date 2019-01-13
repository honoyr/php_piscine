<!-- INCLUDE header.tpl -->
<div class="catalog w">
	<!-- BEGIN category -->
	<div class="head">
        <!-- BEGIN if_uppercats -->
        <div class="uppercats">
            <!-- BEGIN uppercat --><a href="catalog/{uppercat.KEY}">{uppercat.NAME}</a> &raquo; <!-- END uppercat -->
        </div>
        <!-- END if_uppercats -->
	    <h2>{category.NAME}</h2>
	    <div class="description wikitext">{category.DESCRIPTION}</div>
	</div>
	<!-- END category -->  
	<!-- BEGIN if_subcats -->
	<div class="cats"><ul>
	    <!-- BEGIN subcat -->
	    <li><span><a href="catalog/{subcat.KEY}">{subcat.NAME}</a> &nbsp;&nbsp;({subcat.COUNT})</span></li>
	    <!-- END subcat -->
	</ul></div>
	<!-- END if_subcats -->
    <!-- BEGIN products -->
    <div class="items">
        <!-- BEGIN product -->
        <div class="item">
            <h3><a href="catalog/item/{product.ID}">{product.NAME}</a></h3>
            <!-- BEGIN product.picture --><div class="img {product.LABEL}"><a href="catalog/item/{product.ID}"><img src="images/product/s/{product.picture.SRC}" alt="{product.NAME}"/></a></div><!-- END product.picture -->
            <div class="brief text"><p>{product.BRIEF}</p></div>
            <!-- BEGIN product.price_old --><div class="oldprice text">Старая цена: {product.PRICE_OLD} грн.</div><!-- END product.price_old -->
            <!-- BEGIN product.price --><div class="price">Цена: {product.PRICE} грн.</div><!-- END product.price -->
            <div class="actions">
                <a href="catalog/item/{product.ID}" class="button gray view">Подробнее</a>
                <div class="button red cart" id="{product.ID}">Купить</div>
            </div>
        </div>
        <!-- END product -->
	    <!-- BEGIN paginator -->
	    <div class="oPager"> 
	        <!-- BEGIN paginator.first --><a href="catalog/{CATEGORY_KEY}/page/{paginator.first.NUM}{URL_POSTFIX}">{paginator.first.NUM}</a><!-- END paginator.first -->
	        <!-- BEGIN paginator.separator1 --><ins>...</ins><!-- END paginator.separator1 -->
	        <!-- BEGIN paginator.middle1 --><a href="catalog/{CATEGORY_KEY}/page/{paginator.middle1.NUM}{URL_POSTFIX}">{paginator.middle1.NUM}</a><!-- END paginator.middle1 -->
	        <!-- BEGIN paginator.current --><i>{paginator.current.NUM}</i><!-- END paginator.current -->
	        <!-- BEGIN paginator.middle2 --><a href="catalog/{CATEGORY_KEY}/page/{paginator.middle2.NUM}{URL_POSTFIX}">{paginator.middle2.NUM}</a><!-- END paginator.middle2 -->
	        <!-- BEGIN paginator.separator2 --><ins>...</ins><!-- END paginator.separator2 -->
	        <!-- BEGIN paginator.last --><a href="catalog/{CATEGORY_KEY}/page/{paginator.last.NUM}{URL_POSTFIX}">{paginator.last.NUM}</a><!-- END paginator.last -->
	    </div>
	    <!-- END paginator -->
    </div>
    <!-- END products --> 
    <!-- BEGIN category --><!-- BEGIN category.seotext -->
    <div class="basement text">{category.SEOTEXT}</div>
    <!-- END category.seotext --><!-- END category -->  
</div> 
<!-- INCLUDE footer.tpl -->