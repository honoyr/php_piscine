<!-- INCLUDE admin/header.tpl -->
<script type="text/javascript">
var tableCols = 9;
var pageKey  = "testimonial"; 
var pageClass = "tst";
var addButtonClass = "addNode";
var message = {
    notice : {
        deleted:'Отзыв успешно удален из списка',
        added  :'В список добавлен новый отзыв',
        edited :'Отзыв успешно отредактирован'
    },
    confirm : {
        deleting:'Вы действительно хотите удалить отзыв из списка?'
    }
};
</script>
<script type="text/javascript" src="scripts/admin/table.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Блок добавления
    $(".tst>.actions .add").click(initAdd);
    // Блок настроек
    initSettings();
    // Таблица
    initTable();
});

// Изменение настроек
var initSettings = function(){
    var block = $(".feedback");
    // Сохранение
    $("form .oActButtons a.save",block).live('click',function(){
        ajaxloader.show();
        $("form",block).submit(function(){
            $(this).ajaxSubmit({
                success: function(data) {
                    if (data=='ok') {
                        block.find("form .oActButtons a.cancel").click();
                        // Уведомление о сохранении
                        notice('Настройки обратной связи успешно изменены');
                    } else {
                        block.find("form>div.oT2").html(data);
                        ajaxloader.hide();
                    }
                }
            });
            return false;
        }).submit();
        return false;
    });
    // Отмена
    $("form .oActButtons a.cancel",block).live('click',function(){
        ajaxloader.show();
        block.find("form>div.oT2").load(block.find("form").attr('action'),{},function(data){
            ajaxloader.hide();
        });
    });
}
</script>
<div class="helpDescr">В данном разделе вы можете просматривать полученные отзывы от покупателей</div>
<div class="feedback oEditor">
    <form action="admin/testimonial/settings" method="post">
	    <div class="oT2 oEditItem"><!-- INCLUDE admin/testimonial/settings.tpl --></div>
	</form>
</div>
<div class="tst oEditor">
    <div class="actions"><a href="javascript:;" class="add">Добавить отзыв</a></div>
    <div class="addNode" style="display:none;"></div>
    <div class="list oEditor"><!-- INCLUDE admin/testimonial/table.tpl --></div>
</div>
<!-- INCLUDE admin/footer.tpl -->