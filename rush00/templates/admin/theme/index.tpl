<!-- INCLUDE admin/header.tpl -->
<script type="text/javascript">
var tableCols = 5;
var pageKey  = "theme";
var pageClass = "theme";
var addButtonClass = "addNode";
var message = {
    notice : {
        deleted:'Тема оформления успешно удалена',
        added  :'Тема оформления добавлена',
        edited :'Тема оформления успешно отредактирована',
        launched:'Тема "%s" установлена на сайт'
    },
    confirm : {
        deleting:'Вы действительно хотите удалить эту тему оформления?'
    }
};
</script>
<script type="text/javascript" src="scripts/admin/table.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Блок добавления
    $(".theme>.actions .add").click(initAdd);
    // Таблица
    initTable();
    // Дополнительные возможности
    setFeatures(function(block){
        
    });
});
</script>
<div class="helpDescr">В данном разделе вы можете выбрать готовую тему оформления, либо создать свою собственную, задав цветовую гамму и фоновую картинку</div>
<div class="cats">
    <span style="background:#ffffff;">Готовые темы</span>
    <a href="admin/theme/color">Цветовая гамма</a>
    <a href="admin/theme/background">Фоновая картинка</a>
</div>
<div class="catExt theme oEditor">
    <div class="actions"><a href="javascript:;" class="add">Сохранить текущую тему оформления в каталог тем</a></div>
    <div class="addNode" style="display:none;"></div>
    <div class="list oEditor"><!-- INCLUDE admin/theme/table.tpl --></div>
</div>
<!-- INCLUDE admin/footer.tpl -->