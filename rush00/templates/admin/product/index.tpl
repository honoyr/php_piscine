<!-- INCLUDE admin/header.tpl -->
<script:no-cache type="text/javascript">
var tableCols = 8;
var pageKey  = "product/{CATEGORY_ID}"; 
var pageClass = "product";
var addButtonClass = "addNode";
var message = {
    notice : {
        deleted:'Продукт "%s" успешно удален из списка',
        added  :'В список добавлен новый продукт',
        edited :'Данные продукта успешно отредактированы'
    },
    confirm : {
        deleting:'Вы действительно хотите удалить продукт "%s" из списка?'
    }
};
</script>
<script:no-cache type="text/javascript" src="scripts/admin/table.js"></script>
<script:no-cache type="text/javascript">
$(document).ready(function() {
    // Блок добавления
    $(".product>.actions .add").click(initAdd);
    // Таблица
    initTable();
    // Выбор категории
    $(".catSelect select").change(function(){
        location.href = 'admin/product/'+$(this).val();
    });
});
</script>
<div class="helpDescr">В данном разделе вы можете управлять списком продукции отдельной категории</div>
<div class="cats">
    <div class="catSelect">
        Категория: <select name="category"><option value="all">--все--</option><option value="main">--на главной--</option>$cats</select>
    </div>
    <a href="admin/product/main">Главная страница</a>
    <a href="admin/product/category">Категории</a>
    <!-- BEGIN tab_all -->
    <span style="background:#ffffff;">Вся продукция</span>
    <!-- END tab_all -->
    <!-- BEGIN tab_cat -->
    <a href="admin/product/all">Вся продукция</a>
    <span style="background:#ffffff;">{CATEGORY_NAME}</span>
    <!-- END tab_cat -->
</div>
<div class="product oEditor catExt">
    <div class="actions"><a href="javascript:;" class="add">Добавить продукцию</a></div>
    <div class="addNode" style="display:none;"></div>
    <div class="list oEditor"><!-- INCLUDE admin/product/table.tpl --></div>
</div>
<!-- INCLUDE admin/footer.tpl -->