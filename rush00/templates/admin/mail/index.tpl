<!-- INCLUDE admin/header.tpl -->
<script type="text/javascript">
var tableCols = 3;
var pageKey  = "mail";
var pageClass = "mail";
var addButtonClass = "addNode";
var message = {
    notice : {
        deleted:'Почтовый ящик успешно удален',
        added  :'Почтовый ящик добавлен',
        edited :'Почтовый ящик успешно отредактирован'
    },
    confirm : {
        deleting:'Вы действительно хотите удалить этот почтовый ящик?'
    }
};
</script>
<script type="text/javascript" src="scripts/admin/table.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Блок добавления
    $(".mail>.actions .add").click(initAdd);
    // Таблица
    initTable();
    // Дополнительные возможности
    setFeatures(function(block){
        
    });
});
</script>
<div class="helpDescr">В данном разделе вы можете создавать почтовые ящики для вашего домена</div>
<div class="mail oEditor">
    <!-- BEGIN mail_is_connected -->
    <div class="actions"><a href="javascript:;" class="add">Создать почтовый ящик</a></div>
    <div class="addNode" style="display:none;"></div>
    <div class="list oEditor"><!-- INCLUDE admin/mail/table.tpl --></div>
    <!-- END mail_is_connected -->
    <!-- BEGIN mail_is_not_connected -->
    <div><p>Для настройки почты для вашего домена свяжитесь с администратором (<a href="mailto:info@bmshop5.ru">info@bmshop5.ru</a>)</p></div>
    <!-- END mail_is_not_connected -->
</div>
<!-- INCLUDE admin/footer.tpl -->