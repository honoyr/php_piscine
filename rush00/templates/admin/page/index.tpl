<!-- INCLUDE admin/header.tpl -->
<script type="text/javascript">
var tableCols = 4;
var pageKey  = "page"; 
var pageClass  = "pages";
var addButtonClass  = "addPage";
var message = {
    notice : {
        deleted:'Страница "%s" успешно удалена',
        added  :'Новая страница успешно добавлена',
        edited :'Страница успешно отредактирована'
    },
    confirm : {
        deleting:'Вы действительно хотите удалить страницу "%s"?'
    }
};
</script>
<script type="text/javascript" src="scripts/admin/table.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Блок добавления
    $(".pages>.actions .add").click(initAdd);
    // Таблица
    initTable();
});
</script>
<div class="helpDescr">В данном разделе вы можете создавать и редактировать статические страницы сайта.</div>
<div class="pages oEditor">
    <div class="actions"><a href="javascript:;" class="add">Добавить страницу</a></div>
    <div class="addPage" style="display:none;"></div>
    <div class="list oEditor"><!-- INCLUDE admin/page/table.tpl --></div>
</div>
<!-- INCLUDE admin/footer.tpl -->