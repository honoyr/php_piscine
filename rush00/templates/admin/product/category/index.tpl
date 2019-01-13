<!-- INCLUDE admin/header.tpl -->
<script type="text/javascript">
var tableCols = 4;
var pageKey = "product/category";
var pageClass  = "masterCats";
var message = {
    notice : {
        deleted:'Категория "%s" успешно удалена',
        added  :'Категория успешно добавлена',
        edited :'Категория успешно отредактирована'
    },
    confirm : {
        deleting:'Вы действительно хотите удалить категорию "%s"?'
    }
};
$(document).ready(function() {
    // Таблица
    initTable($("."+pageClass+">.oEditor"));
    // Добавление категорий
    $("."+pageClass+">.oActButtons a.add").click(function(){
        ajaxloader.show();
        var button = $(this);
        var actionBlock = $("#action").css({
            'position' : 'absolute',
            'top':(getBodyScrollTop()+100)+'px'
        });
        $(".container",actionBlock).load(button.attr('href'),{},function(){
            actionBlock.fadeIn(300);
            initAddForm(actionBlock);
            ajaxloader.hide();
        });
        return false;
    });
});
//Заготовки для изменения таблицы
var emptyRowForEdit = '<tr class="oneTD forEdit extraRow" style="display:none"><td colspan="'+tableCols+'"><div class="oEditElement oT2 projectInside" style="display:none"></div></td></tr>';
var emptyRowForExpand = '<tr class="oneTD forExpand extraRow" style="display:none"><td colspan="'+tableCols+'"><div class="showView" style="display:none"></div></td></tr>';
// Таблица
var initTable = function(block){
    // Инициализация строк таблицы
    block.children("table").children("tbody").children("tr").each(function(){ initRow($(this)); });
    // постраничная навигация
    block.children(".oPager a").click(function(){
        ajaxloader.show();
        $.post($(this).attr('href'), {}, function(data){
        	block.html(data);
            initTable();
            ajaxloader.hide();
        });
        return false;
    });
    // Перемещение строк таблицы
    block.children("table.list").each(function(){
        $(this).tableDnD({
            onDragClass: "dragRow",
            onDragStart: function(table, row) {
                $(table).find(".extraRow").each(function(){
                    arrowDown($(this).prev().find(".expand i"));
                    $(this).remove();
                });
            },
            onDrop: function(table, row) {
                ajaxloader.show();
                $.post('admin/'+pageKey+'/reorder/?'+$.tableDnD.serialize(),{},function(){
                    ajaxloader.hide();
                });
            },
            dragHandle: "move_"+$(this).attr('rel'),
            scrollAmount: 100
        });
    });
}
// Инициализация строки
var initRow = function(block){
    var object = $(".iName",block).text();
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
    // Добавление подкатегорий
    block.find(".oActButtons a.add").click(function(){
        ajaxloader.show();
        var button = $(this);
        var actionBlock = $("#action").css({
            'position' : 'absolute',
            'top':(getBodyScrollTop()+100)+'px'
        });
        $(".container",actionBlock).load(button.attr('href'),{},function(){
            actionBlock.fadeIn(300);
            initAddForm(actionBlock);
            ajaxloader.hide();
        });
        return false;
    });
    // Редактировать
    block.find(".actions a.edit").click(function(){
        ajaxloader.show();
    	var button = $(this);
    	var actionBlock = $("#action").css({
            'position' : 'absolute',
            'top':(getBodyScrollTop()+100)+'px'
        });
        var container = $(".container",actionBlock);
        container.load(button.attr('href'),{},function(){
        	actionBlock.fadeIn(300);
            initEditForm(actionBlock);
            ajaxloader.hide();
        });
        return false;
    });
    // Удалить
    block.find(".actions a.del").click(function(){
        var button = $(this);
        // Подтверждение удаления
        confirmAction(sprintf(message.confirm.deleting,object),function(){
            ajaxloader.show();
            $.post(button.attr('href'),{},function(data){
                if (data=='ok'){
                    var extraRow = block.next();
                    if (extraRow.is(".extraRow")){
                        extraRow.remove();
                    }
                    block.remove();
                    notice(sprintf(message.notice.deleted,object));
                }
                ajaxloader.hide();
            });
            return false;
        });
        return false;
    });
    // Включить
    block.find(".actions a.hide").click(function(){
        var button = $(this);
        ajaxloader.show();
        $.post(button.attr('href'),{},function(data){
            if (data=='ok'){
                button.hide().parent().find(".show").show();
            }
            ajaxloader.hide();
        });
        return false;
    });
    // Выключить
    block.find(".actions a.show").click(function(){
        var button = $(this);
        ajaxloader.show();
        $.post(button.attr('href'),{},function(data){
            if (data=='ok'){
                button.hide().parent().find(".hide").show();
            }
            ajaxloader.hide();
        });
        return false;
    });
    // Активируем вложенные таблицы
    if ($(".slaves .oEditor",block).length)
        initTable($(".slaves .oEditor",block));
}
// Сабмит формы добавления
var initAddForm = function(actionBlock){
    var container = $(".container",actionBlock);
    $("form .Buttons .save input",actionBlock).unbind().click(function(){
        ajaxloader.show();
        $("form",actionBlock).unbind().submit(function(){
            $(this).ajaxSubmit({
                success: function(data) {
                    if (data=='ok') {
                       container.html();
                       actionBlock.fadeOut(300);
                       // Обновление таблицы
                       reloadTable();
                       // Уведомление о добавлении
                       notice(message.notice.added);
                    } else {
                       container.html(data);
                       initAddForm(actionBlock);
                       ajaxloader.hide();
                    }
                }
            });
            return false;
        }).submit();
        return false;
    });
    // Отмена редактирования
    $("form .Buttons .cancel input",actionBlock).unbind().click(function(){
       container.html();
       actionBlock.fadeOut(300);
       return false;
    });
    // Форма загрузки файла
    $("form .Picture .oFileLink",actionBlock).live('click',function(){
        var form = $("form",actionBlock);
        var pictireBlock = $(".Picture",form);
        form.unbind().submit(function(){
            ajaxloader.show();
            $(this).ajaxSubmit({
                success: function(data) {
                    pictireBlock.html(data);
                    ajaxloader.hide();
                }
            });
            return false;
        }).find("input[type='file']").change(function(){
            var oldAction = form.attr('action');
            form.attr('action',$(this).attr('rel'))
                .submit()
                .attr('action',oldAction);
        });
    });
    // ошибки
    $("form .error",actionBlock).each(function(i,item){
        $(item).prev().addClass('errored');
    });
    // генерация ключа
    $("form input[name='name']",actionBlock).focusout(function(){
        var keyField = $("form input[name='key']",actionBlock);
        if (!keyField.attr('value')){
            $.post('admin/tools/makeKey',{query:$(this).attr('value')},function(data){
                keyField.attr('value',data);
            });
        }
        // и подстановка заголовка
        var titleField = $("form input[name='title']",actionBlock);
        if (!titleField.attr('value')){
            titleField.attr('value',$(this).attr('value'));
        }
    });
    // Редактор
    initEditor($("form textarea.wiki",actionBlock),$("form",actionBlock));
}
// Сабмит формы редактирования
var initEditForm = function(actionBlock){
    var container = $(".container",actionBlock);
    $("form .Buttons .save input",actionBlock).unbind().click(function(){
        ajaxloader.show();
        $("form",actionBlock).unbind().submit(function(){
            $(this).ajaxSubmit({
                success: function(data) {
                    if (data=='ok') {
                       container.html();
                       actionBlock.fadeOut(300);
                       // Обновление таблицы
                       reloadTable();
                       // Уведомление о редактировании
                       notice(message.notice.edited);
                    } else {
                       container.html(data);
                       initEditForm(actionBlock);
                       ajaxloader.hide();
                    }
                }
            });
            return false;
        }).submit();
        return false;
    });
    // Отмена редактирования
    $("form .Buttons .cancel input",actionBlock).unbind().click(function(){
       container.html();
       actionBlock.fadeOut(300);
       return false;
    });
    var initPictureLoader = function(){
        // Форма загрузки файла
        $("form .Picture .oFileLink",actionBlock).unbind().click(function(){
            var form = $("form",actionBlock);
            form.find("input[type='file']").change(function(){
                var oldAction = form.attr('action');
                form.attr('action',$(this).attr('rel'))
                    .submit()
                    .attr('action',oldAction);
            });
            form.unbind().submit(function(){
                ajaxloader.show();
                $(this).ajaxSubmit({
                    success: function(data) {
                        $(".Picture",form).html(data);
                        initPictureLoader();
                        ajaxloader.hide();
                    }
                });
                return false;
            });
        });
    }
    initPictureLoader();
    // ошибки
    $("form .error",actionBlock).each(function(i,item){
        $(item).prev().addClass('errored');
    });
    // Редактор
    initEditor($("form textarea.wiki",actionBlock),$("form",actionBlock));
}
// Загрузка 
var initUploadForm = function(actionBlock){
    var container = $(".container",actionBlock);
    // выбор источника
    $("form input[name='source']:checked").next().find(".options").show();
    $("form input[name='source']",actionBlock).click(function(){
         var hiddenBlock = $(this).next().find(".options");
         if (hiddenBlock.is(":hidden")) {
             $(".info .options",actionBlock).slideUp(300);
             hiddenBlock.slideDown(300);
         }
    });
    // загрузка
    $("form .oActButtons a.save",actionBlock).unbind().click(function(){
        ajaxloader.show();
        $("form",actionBlock).submit(function(){
            $(this).ajaxSubmit({
                success: function(data) {
                    container.html(data);
                    initUploadForm(actionBlock);
                    ajaxloader.hide();
                }
            });
            return false;
        }).submit();
        return false;
    });
    // Отмена редактирования
    $(".oActButtons a.cancel",actionBlock).unbind().click(function(){
       container.html();
       actionBlock.fadeOut(300);
       return false;
    });
    // ошибки
    $("form .error",actionBlock).each(function(i,item){
        $(item).prev().addClass('errored');
    });
}
// Обновление таблицы
var reloadTable = function(){
    var currentUrl = $("."+pageClass+" input[name='currentUrl']").attr('value');
    if (!currentUrl){
        currentUrl = 'admin/'+pageKey;
    }
    $("."+pageClass+">.oEditor").load(currentUrl,function(){ 
    	initTable($("."+pageClass+">.oEditor"));
        ajaxloader.hide();
    });
}
</script>
<div class="helpDescr">
    Здесь можно управлять категориями каталога. Для добавления продукции выберите одну из категорий.
</div>
<div class="cats">
    <a href="admin/product/main">Главная страница</a>
    <span>Категории</span>
    <a href="admin/product/all">Вся продукция</a>
</div>
<div class="catExt">
    <div class="masterCats">
        <div class="master oEditor"><!-- INCLUDE admin/product/category/table.tpl --></div>
        <div class="oActButtons"><a href="admin/product/category/add" class="add">Добавить категорию</a></div>
    </div>
</div>
<!-- INCLUDE admin/footer.tpl -->