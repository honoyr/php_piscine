<!-- INCLUDE admin/header.tpl -->
<script type="text/javascript">
var tableCols = 4;
var pageKey  = "blog";
var pageClass = "blog";
var addButtonClass = "addNode";
var message = {
    notice : {
        deleted:'Запись успешно удалена',
        added  :'Запись успешно добавлена',
        edited :'Запись успешно отредактирована'
    },
    confirm : {
        deleting:'Вы действительно хотите удалить эту запись?'
    }
};
</script>
<script type="text/javascript" src="scripts/admin/table.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Блок добавления
    $(".blog>.actions .add").click(initAdd);
    // Таблица
    initTable();
    // Дополнительные возможности
    setFeatures(function(block){
        $('.datepicker',block).datepicker({
            dateFormat: "dd.mm.yy",
            changeMonth: true
        });
    });
});
</script>
<div class="helpDescr">В данном разделе вы можете управлять записями в блоге</div>
<div class="blog oEditor">
    <div class="actions"><a href="javascript:;" class="e add">Добавить запись</a></div>
    <div class="addNode" style="display:none;"></div>
    <div class="list oEditor"><!-- INCLUDE admin/blog/table.tpl --></div>
</div>
<!-- INCLUDE admin/footer.tpl -->