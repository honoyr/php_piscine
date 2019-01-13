<table id="list">
    <thead><tr class="nodrop nodrag">
        <td colspan="3">Действия</td>
        <td>Картинка</td>
        <td>Наименование</td>
        <td>Краткое описание</td>
        <td>Старая цена</td>
        <td>Цена</td>
    </tr></thead>
    <tbody>
    <!-- BEGIN product -->
	<tr id="{product.ID}">
        <!-- BEGIN tab_cat --><td class="move" title="Передвинуть"><i>&nbsp;</i></td><!-- END tab_cat -->
        <!-- BEGIN tab_all --><td style="width:0px;border:0"></td><!-- END tab_all -->
	    <td><div class="actions">
	        <a href="admin/product/edit/{product.ID}" class="edit" title="Редактировать"><i>Редактировать</i></a>
            <a href="admin/product/album/{product.ID}" class="album" title="Фотоальбом" rel="/admin/product/upload"><i>Фотоальбом</i></a>
            <a href="admin/product/mark/{product.ID}" class="unmark" title="Поместить на главную" <!-- BEGIN product.mark -->style="display:none;"<!-- END product.mark -->><i>Поместить на главную</i></a>
            <a href="admin/product/unmark/{product.ID}" class="mark" title="Убрать с главной"<!-- BEGIN product.unmark -->style="display:none;"<!-- END product.unmark -->><i>Убрать с главной</i></a>
	        <a href="admin/product/disable/{product.ID}" class="show" title="Скрыть с сайта" <!-- BEGIN product.disabled -->style="display:none;"<!-- END product.disabled -->><i>Скрыть с сайта</i></a>
	        <a href="admin/product/enable/{product.ID}" class="hide" title="Показывать на сайте"<!-- BEGIN product.enabled -->style="display:none;"<!-- END product.enabled -->><i>Показывать на сайте</i></a>
	        <a href="admin/product/delete/{product.ID}" class="del" title="Удалить"><i>Удалить</i></a>
	    </div></td>
	    <td class="expand">
	        <div><i class="toOpen" title="Развернуть" rel="admin/product/expand/{product.ID}"><b>&nbsp;</b></i></div>
	    </td>
	    <td><!-- BEGIN product.picture --><div class="img {product.LABEL}"></div><img src="images/product/s/{product.picture.SRC}" alt="" width="100" /></div><!-- END product.picture --></td>
	    <td class="iName">{product.NAME}</td>
        <td>{product.BRIEF}</td>
        <td width="100"><s>{product.PRICE_OLD}</s></td>
	    <td width="100">{product.PRICE}</td>
	</tr>
    <!-- END product -->
    </tbody>
</table>
<!-- BEGIN paginator -->
<div class="oPager">
    <!-- BEGIN paginator.first --><a href="admin/product/{CATEGORY_ID}/page/{paginator.first.NUM}{URL_POSTFIX}">{paginator.first.NUM}</a><!-- END paginator.first -->
    <!-- BEGIN paginator.separator1 --><ins>...</ins><!-- END paginator.separator1 -->
    <!-- BEGIN paginator.middle1 --><a href="admin/product/{CATEGORY_ID}/page/{paginator.middle1.NUM}{URL_POSTFIX}">{paginator.middle1.NUM}</a><!-- END paginator.middle1 -->
    <!-- BEGIN paginator.current --><i>{paginator.current.NUM}</i><!-- END paginator.current -->
    <!-- BEGIN paginator.middle2 --><a href="admin/product/{CATEGORY_ID}/page/{paginator.middle2.NUM}{URL_POSTFIX}">{paginator.middle2.NUM}</a><!-- END paginator.middle2 -->
    <!-- BEGIN paginator.separator2 --><ins>...</ins><!-- END paginator.separator2 -->
    <!-- BEGIN paginator.last --><a href="admin/product/{CATEGORY_ID}/page/{paginator.last.NUM}{URL_POSTFIX}">{paginator.last.NUM}</a><!-- END paginator.last -->
</div>
<!-- END paginator -->
<input type="hidden" name="currentUrl" value="admin/product/{CATEGORY_ID}/page/{CURRENT_PAGE}"/>