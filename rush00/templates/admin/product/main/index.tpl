<!-- INCLUDE admin/header.tpl -->
<script:no-cache type="text/javascript">
var tableCols = 8;
var pageKey  = "product/main"; 
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
    // Таблица
    initTable();
    // Выбор категории
    $(".catSelect select").change(function(){
        location.href = 'admin/product/'+$(this).val();
    });
});
</script>
<div class="helpDescr">В данном разделе вы можете управлять списком продукции на главной странице</div>
<div class="cats">
    <div class="catSelect">
        Категория: <select name="category"><option value="all">--все--</option><option value="main">--на главной--</option>$cats</select>
    </div>
    <span style="background:#ffffff;">Главная страница</span>
    <a href="admin/product/category">Категории</a>
    <a href="admin/product/all">Вся продукция</a>
</div>
<div class="product oEditor catExt">
    <div class="addNode"></div>
    <div class="list oEditor"><!-- INCLUDE admin/product/main/table.tpl --></div>
</div>
<!-- INCLUDE admin/footer.tpl -->