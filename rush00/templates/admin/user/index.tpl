<!-- INCLUDE admin/header.tpl -->
<script type="text/javascript">
var tableCols = 4;
var pageKey  = "user"; 
var pageClass  = "users";
var addButtonClass  = "addUser";
var message = {
    notice : {
        deleted:'Пользователь "%s" успешно удален',
        added  :'Новый пользователь успешно добавлен',
        edited :'Пользователь успешно отредактирован'
    },
    confirm : {
        deleting:'Вы действительно хотите удалить пользователя "%s"?'
    }
};
</script>
<script type="text/javascript" src="scripts/admin/table.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Блок добавления
    $(".users>.actions .add").click(initAdd);
    // Таблица
    initTable();
});
</script>
<div class="helpDescr">В данном разделе вы можете управлять списком пользователей, которые имеют доступ к административному интерфейсу сайта.</div>
<div class="users oEditor">
    <div class="actions"><a href="javascript:;" class="add">Добавить пользователя</a></div>
    <div class="addUser" style="display:none;"></div>
    <div class="list oEditor"><!-- INCLUDE admin/user/table.tpl --></div>
</div>
<!-- INCLUDE admin/footer.tpl -->