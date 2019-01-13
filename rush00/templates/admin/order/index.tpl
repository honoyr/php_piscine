<!-- INCLUDE admin/header.tpl -->
<script type="text/javascript">
$(document).ready(function() {
    // Блок настроек
    initSettings();
    // Таблица
    initTable();
});
// Заготовки для изменения таблицы
var emptyRowForExpand = '<tr class="oneTD forExpand extraRow" style="display:none"><td colspan="10"><div class="letterText manual" style="display:none"></div></td></tr>';
// Таблица
var initTable = function(){
    // Инициализация строк таблицы
    $(".letters>table>tbody>tr").each(function(){ initRow($(this)); });
    // постраничная навигация
    $(".letters .oPager a").click(function(){
        ajaxloader.show();
        $.post($(this).attr('href'), {}, function(data){
            $(".letters").html(data);
            initTable();
            ajaxloader.hide();
        });
        return false;
    });
}
// Инициализация строки
var initRow = function(block){
    var name = $("td.iName",block).text();
    // Дополнительная инфа
    block.find(".expand i").click(function(){
        var button = $(this);
        var extraRow = block.next();
        var extraBlock = extraRow.find("div:eq(0)");
        // Если есть блок с инфой - скрываем/открываем при нажатии
        if (extraRow.is(".forExpand")){
            if (extraBlock.is(":hidden")){ 
                extraRow.show(); 
                extraBlock.slideDown(300); 
                arrowUp(button);
            }else{ 
                extraBlock.slideUp(300); 
                extraRow.hide(); 
                arrowDown(button);
            }
        }
        // Если нет - то удаляем другие блоки или вставляем его
        else {
            var loadInfo = true;
            if (extraRow.is(".extraRow")){
                if (extraBlock.is(":hidden")){ 
                    extraRow.remove();
                } else {
                    extraBlock.slideUp(300);
                    extraRow.hide();
                    arrowDown(button);
                    loadInfo = false;
                }
            }
            if (loadInfo){
                ajaxloader.show();
	            block.after(emptyRowForExpand).next().find("div:eq(0)").load(button.attr('rel'),function(){ 
	                button.click();
	                ajaxloader.hide();
	            });
	        }
        }
        return false;
    });
    // Удалить
    block.find(".actions a.del").click(function(){
        var button = $(this);
        // Подтверждение удаления
        confirmAction('Вы уверены что хотите удалить сообщение от "'+name+'"?',function(){
            ajaxloader.show();
            $.post(button.attr('href'),{},function(data){
                if (data=='ok'){
                    var extraRow = block.next();
                    if (extraRow.is(".extraRow")){
                        extraRow.remove();
                    }
                    block.remove();
                    notice('Сообщение от "'+name+'" удалено.');
                }
                ajaxloader.hide();
            });
            return false;
        });
        return false;
    });
    $(".show_cart",block).click(function(){ block.find(".expand i").click(); }); 
}
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
//Стрелка вверх
var arrowUp = function(button){
    button.removeClass('toOpen').addClass('toClose');
    button.attr('title','Свернуть');
}
// Стрелка вниз
var arrowDown = function(button){
    button.removeClass('toClose').addClass('toOpen');
    button.attr('title','Развернуть');
}
// Обновление таблицы
var reloadTable = function(){
    $(".letters").load('admin/order',function(){ 
        initTable();
        ajaxloader.hide();
    });
}
</script>
<div class="helpDescr">В данном разделе вы можете задать почтовый ящик для получения писем,<br/> а также просто просматривать полученные заказы.</div>
<div class="feedback oEditor">
    <form action="admin/order/settings" method="post">
	    <div class="oT2 oEditItem"><!-- INCLUDE admin/order/settings.tpl --></div>
	</form>
</div>
<div class="letters oEditor"><!-- INCLUDE admin/order/table.tpl --></div>
<!-- INCLUDE admin/footer.tpl -->