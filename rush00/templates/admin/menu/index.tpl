<!-- INCLUDE admin/header.tpl -->
<script type="text/javascript">
var tableCols = 4;
var pageKey  = "menu"; 
var pageClass  = "menu";
var addButtonClass  = "addItem";
var message = {
    notice : {
        deleted:'Пункт "%s" успешно удален из меню',
        added  :'В меню добавлен новый пункт',
        edited :'Пункт меню успешно отредактирован'
    },
    confirm : {
        deleting:'Вы действительно хотите удалить пункт "%s" из меню?'
    }
};
</script>
<script type="text/javascript" src="scripts/admin/table.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Блок добавления
    $(".menu>.actions .add").click(initAdd);
    // Таблица
    initTable();
});
</script>
<div class="helpDescr">В данном разделе вы можете управлять пунктами меню: добавлять, изменять, менять их местами.</div>
<div class="menu oEditor">
    <div class="actions"><a href="javascript:;" class="add">Добавить пункт меню</a></div>
    <div class="addItem" style="display:none;"></div>
    <div class="list oEditor"><!-- INCLUDE admin/menu/table.tpl --></div>
</div>
<!-- INCLUDE admin/footer.tpl -->