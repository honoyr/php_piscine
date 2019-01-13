<!-- INCLUDE admin/header.tpl -->
<link rel="stylesheet" href="styles/admin/jquery-ui.css" type="text/css"/>
<script type="text/javascript" src="scripts/jquery-ui.js"></script>
<script type="text/javascript" src="scripts/jquery.ui.datepicker-ru.js"></script>
<script type="text/javascript">
var tableCols = 5;
var pageKey  = "news";
var pageClass = "news";
var addButtonClass = "addNode";
var message = {
    notice : {
        deleted:'Новость успешно удалена',
        added  :'Новость успешно добавлена',
        edited :'Новость успешно отредактирована'
    },
    confirm : {
        deleting:'Вы действительно хотите удалить эту новость?'
    }
};
</script>
<script type="text/javascript" src="scripts/admin/table.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Блок добавления
    $(".news>.actions .add").click(initAdd);
    // Таблица
    initTable();
});
var initDatePicker = function(block){
    $('.datepicker',block).datepicker({
        dateFormat: "dd.mm.yy",
        changeMonth: true
    });
}
</script>
<div class="helpDescr">В данном разделе вы можете управлять новостями</div>
<div class="cats">
    <span style="background:#ffffff;">Лента новостей</span>
    <a href="admin/mininews">Главные события</a>
    <a href="admin/news/banner">Новостной баннер</a>
    <a href="admin/afisha">Афиша</a>
</div>
<div class="catExt news oEditor">
    <div class="actions"><a href="javascript:;" class="e add">Добавить новость</a></div>
    <div class="addNode" style="display:none;"></div>
    <div class="list oEditor"><!-- INCLUDE admin/news/table.tpl --></div>
</div>
<!-- INCLUDE admin/footer.tpl -->