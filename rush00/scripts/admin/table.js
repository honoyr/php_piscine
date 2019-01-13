// Заготовки для изменения таблицы
var emptyRow = '<tr class="oneTD extraRow" style="display:none"><td colspan="'+tableCols+'"><div class="oEditItem oT2" style="display:none"></div></td></tr>';
var extraFeatures;
var setFeatures = function(callback){
	if (callback) {
		extraFeatures = callback;
	}
}
// Таблица
var initTable = function(){
    // Инициализация строк таблицы
    $("."+pageClass+">.list>table>tbody>tr").each(function(){ initRow($(this)); });
    // постраничная навигация
    $("."+pageClass+".list>.oPager a").click(function(){
        ajaxloader.show();
        $.post($(this).attr('href'), {}, function(data){
            $("."+pageClass+">.list").html(data);
            initTable();
            ajaxloader.hide();
        });
        return false;
    });
    // Перемещение строк таблицы
    $("."+pageClass+">.list>table#list").each(function(){
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
                	reloadTable();
                    ajaxloader.hide();
                });
            },
            dragHandle: "move",
            scrollAmount: 100
        });
    });
}
// Инициализация строки
var initRow = function(block){
    var object = $("td[class='iName']",block).text();
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
	            block.after(emptyRow).next().addClass("forExpand").find("div:eq(0)").load(button.attr('rel'),function(){ 
	                button.click();
	                ajaxloader.hide();
	            });
	        }
        }
        return false;
    });
    // Редактировать
    block.find(".actions a.edit").click(function(){
        var button = $(this);
        var extraRow = block.next();
        // Если есть блок редактирования - скрываем/открываем при нажатии
        if (extraRow.is(".forEdit")){
            var extraBlock = extraRow.find("div:eq(0)");
            var button2 = block.find(".expand i");
            if (extraBlock.is(":visible")){ 
                extraBlock.slideUp(300); 
                extraRow.hide(); 
                arrowDown(button2);
            }else{ 
                extraRow.show(); 
                extraBlock.slideDown(300); 
                arrowUp(button2);
            }
        }
        // Если нет - то удаляем другие блоки и вставляем его
        else {
            if (extraRow.is(".extraRow")){
                extraRow.remove();
            }
            ajaxloader.show();
	        block.after(emptyRow).next().addClass("forEdit").find("div:eq(0)").load(button.attr('href'),function(){ 
	            extraRow = block.next();
	            var extraBlock = extraRow.find("div:eq(0)");
	            button.click();
                initEditForm(extraRow);
	            ajaxloader.hide();
	        });
        }
        return false;
    });
    // Альбом
    block.find(".actions a.album").click(function(){
        var button = $(this);
        var extraRow = block.next();
        // Если есть блок редактирования - скрываем/открываем при нажатии
        if (extraRow.is(".forAlbum")){
            var extraBlock = extraRow.find("div:eq(0)");
            var button2 = block.find(".expand i");
            if (extraBlock.is(":visible")){ 
                extraBlock.slideUp(300); 
                extraRow.hide(); 
                arrowDown(button2);
            }else{ 
                extraRow.show(); 
                extraBlock.slideDown(300); 
                arrowUp(button2);
            }
        }
        // Если нет - то удаляем другие блоки и вставляем его
        else {
            if (extraRow.is(".extraRow")){
                extraRow.remove();
            }
            ajaxloader.show();
	        block.after(emptyRow).next().addClass("forAlbum").find("div:eq(0)").load(button.attr('href'),function(){ 
	            extraRow = block.next();
	            var extraBlock = extraRow.find("div:eq(0)");
	            button.click();
                initAlbum(extraRow,button);
	            ajaxloader.hide();
	        });
        }
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
                if (button.hasClass('reload')){reloadTable();}
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
    // Пометить
    block.find(".actions a.mark").click(function(){
        var button = $(this);
        ajaxloader.show();
        $.post(button.attr('href'),{},function(data){
            if (data=='ok'){
                button.hide().parent().find(".unmark").show();
            }
            ajaxloader.hide();
        });
        return false;
    });
    // Снять пометку
    block.find(".actions a.unmark").click(function(){
        var button = $(this);
        ajaxloader.show();
        $.post(button.attr('href'),{},function(data){
            if (data=='ok'){
                button.hide().parent().find(".mark").show();
            }
            ajaxloader.hide();
        });
        return false;
    });
    // Запустить / сделать текущим
    block.find(".actions a.launch").click(function(){
        var button = $(this);
        ajaxloader.show();
        $.post(button.attr('href'),{},function(data){
            if (data=='ok'){
                // Обновление таблицы
                reloadTable();
                // Уведомление о добавлении
                notice(sprintf(message.notice.launched,object));
            }
            ajaxloader.hide();
        });
        return false;
    });
}
// Инициализация блока добавления
var initAdd = function(){
    var button = $(this);
    ajaxloader.show();
    var block = $("."+pageClass+">."+addButtonClass);
    block.load('admin/'+pageKey+'/add',function(){
        // Закрытие/открытие блока добавления
        button.unbind().click(function(){
            if (block.is(":hidden")){ 
                block.slideDown(300); 
            }else{ 
                block.slideUp(300);
            }
        }).click();
        if (!block.attr('live')){
		    // Добавление
		    $("form .oActButtons a.save",block).live('click',function(){
	        	$(this).die();
		        ajaxloader.show();
		        $("form",block).unbind().submit(function(){
		            $(this).ajaxSubmit({
		                success: function(data) {
		                    if (data=='ok') {
		                       block.slideUp(300);
		        		       $.scrollTo(block.prev(),800);
		                       $("."+pageClass+">.actions .add").unbind().click(initAdd);
		                       // Обновление таблицы
		                       reloadTable();
		                       // Уведомление о добавлении
		                       notice(message.notice.added);
		                    } else {
		                       block.html(data);
			        		   $.scrollTo(block.find(".error:eq(0)"),800);
		                       initAddForm();
                               ajaxloader.hide();
		                    }
		                }
		            });
		            return false;
		        }).submit();
		        return false;
		    });
		    // Отмена добавления
		    $("form .oActButtons a.cancel",block).live('click',function(){ 
		       ajaxloader.show();
		       $.scrollTo(block.prev(),800);
		       button.click();
		       $.post('admin/'+pageKey+'/cancel/add',function(){ajaxloader.hide();});
		    });
	        block.attr('live',1);
	    }
        var initAddForm = function(){
	        var initPictureLoader = function(){
	    	    // Форма загрузки файла
	        	var form = $("form",block);
	        	form.find(".Picture").each(function(i,item){
	        		var uploadBlock = $(item);
	        		$(".oFileLink",uploadBlock).unbind().click(function(){
	        			uploadBlock.find("input[type='file']").change(function(){
	        	            var oldAction = form.attr('action');
	        	            form.attr('action',$(this).attr('rel'))
	        	                .submit()
	        	                .attr('action',oldAction);
	        	        });
	        	        form.unbind().submit(function(){
	        	            ajaxloader.show();
	        	            $(this).ajaxSubmit({
	        	                success: function(data) {
	        	            		uploadBlock.html(data);
	        	                    initPictureLoader();
	        	                    ajaxloader.hide();
	        	                }
	        	            });
	        	            return false;
	        	        });
	        	    });
	        	});
	        }
	        initPictureLoader();
		    // редактор
		    initEditor($("form textarea.wiki",block),$("form",block));
		    // загрузка
		    block.find(".oActButtons a.upload").click(function(){
		        ajaxloader.show();
		    	var button = $(this);
		    	var actionBlock = $("#action").css({
		            'position' : 'absolute',
		            'top':(getBodyScrollTop()+100)+'px'
		        });
		        var container = $(".container",actionBlock);
		        container.load(button.attr('href'),{},function(){
		        	actionBlock.fadeIn(300);
		            initUploadForm(actionBlock);
		            ajaxloader.hide();
		        });
		        return false;
		    });
	        // генерация ключа
	        if ( $("form input[name='key']",block).length){
	        	var rel = $("form input[name='key']",block).attr('rel');
	        	if (!rel) { rel = 'name';}
		        $("form input[name='"+rel+"']",block).live('focusout',function(){
		            var keyField = $("form input[name='key']",block);
		            if (!keyField.attr('value')){
		                $.post('admin/tools/makeKey',{query:$(this).attr('value'),maxlength:keyField.attr('maxlength')},function(data){
		                    keyField.attr('value',data);
		                });
		            }
		        });
	        }
	        // Custom features
	        if (extraFeatures) {
	        	extraFeatures(block);
	        }
        }
        initAddForm();
        ajaxloader.hide();
    });
}
// Сабмит формы редактирования
var initEditForm = function(extraRow){
    var extraBlock = extraRow.find("td:eq(0)>div");
    $("form .oActButtons a.save",extraBlock).unbind().click(function(){
        ajaxloader.show();
        $("form",extraBlock).submit(function(){
            $(this).ajaxSubmit({
                success: function(data) {
                    if (data=='ok') {
                       extraBlock.slideUp(300);
                       extraRow.hide(); 
                       $.scrollTo(extraRow.prev(),800);
                       // Обновление таблицы
                       reloadTable();
                       // Уведомление о редактировании
                       notice(message.notice.edited);
                    } else {
                       extraBlock.html(data);
                       initEditForm(extraRow);
                       ajaxloader.hide();
                    }
                }
            });
            return false;
        }).submit();
        return false;
    });
    // Отмена редактирования
    $("form .oActButtons a.cancel",extraBlock).unbind().click(function(){
       ajaxloader.show();
       extraRow.prev().find(".actions a.edit").click();
       extraBlock.load($("form",extraBlock).attr('action'),{},function(){
           initEditForm(extraRow);
           ajaxloader.hide();
       });
       $.scrollTo(extraRow.prev(),800);
       return false;
    });
    var initPictureLoader = function(){
	    // Форма загрузки файла
    	var form = $("form",extraBlock);
    	form.find(".Picture").each(function(i,item){
    		var uploadBlock = $(item);
    		$(".oFileLink",uploadBlock).unbind().click(function(){
    			uploadBlock.find("input[type='file']").change(function(){
    	            var oldAction = form.attr('action');
    	            form.attr('action',$(this).attr('rel'))
    	                .submit()
    	                .attr('action',oldAction);
    	        });
    	        form.unbind().submit(function(){
    	            ajaxloader.show();
    	            $(this).ajaxSubmit({
    	                success: function(data) {
    	            		uploadBlock.html(data);
    	                    initPictureLoader();
    	                    ajaxloader.hide();
    	                }
    	            });
    	            return false;
    	        });
    	    });
    	});
    }
    initPictureLoader();
    // редактор
    initEditor($("form textarea.wiki",extraBlock),$("form",extraBlock));
    // загрузка
    extraBlock.find(".oActButtons a.upload").click(function(){
        ajaxloader.show();
    	var button = $(this);
    	var actionBlock = $("#action").css({
            'position' : 'absolute',
            'top':(getBodyScrollTop()+100)+'px'
        });
        var container = $(".container",actionBlock);
        container.load(button.attr('href'),{},function(){
        	actionBlock.fadeIn(300);
            initUploadForm(actionBlock);
            ajaxloader.hide();
        });
        return false;
    });
    // Выбрать из списка
    $(".Example .choose",extraBlock).each(function(i,item){
        var textarea = extraBlock.find("textarea[name='"+$(item).attr('rel')+"']");
        $("a",item).click(function(){
            textarea.val(textarea.val()+$(this).text()+', ');
        });
    });
    // Custom features
    if (extraFeatures) {
    	extraFeatures(extraBlock);
    }
}
// Альбом
var initAlbum = function(extraRow,button){
    var extraBlock = extraRow.find("td:eq(0)>div");
    // Загрузка файлов
    var uploader = $(".Upload2 .fileUpload",extraBlock);
    uploader.uploadify({
        'uploader'  : '/flash/uploader.swf',
        'script'    : $(button).attr('rel'),
        'cancelImg' : 'images/admin/cancel.png',
        'multi': true,
        'fileExt': '*.jpg;*.jpeg;*.gif;*.png',
        'scriptData': {'id':uploader.attr('rel')},
        'onOpen'      : function(event,ID,fileObj) {
            ajaxloader.show();
        },
        'onAllComplete' : function(event,data) {
        	extraBlock.load($(button).attr('href'),{},function(){
        		initAlbum(extraRow,button);
	            ajaxloader.hide();
        	});
        	extraBlock.find(".Upload2 .Buttons").hide();
        },
        'onSelectOnce' : function(event,data) {
        	extraBlock.find(".Upload2 .Buttons").show(); 
        }
    });
    $(".Upload2 .Buttons .upload input",extraBlock).unbind().click(function(){
    	uploader.uploadifyUpload();
    	return false;
    });
    $(".Upload2 .Buttons .cancel input",extraBlock).unbind().click(function(){
    	uploader.uploadifyClearQueue();
    	extraBlock.find(".Upload2 .Buttons").hide();
    	return false;
    });
    
    // Сортировка
    var album = $(".sortable",extraBlock);
    album.sortable({
		revert:true,
		handle:".MoveHelper",
		update:function(event,ui){
    		$.post(album.attr('rel')+'/'+album.sortable('toArray').join('|'),{},function(data){ });
    	}
	});
    
    var block = $(".InAlbum");
	block.find(".Els>.in>.e").each(function(i,item){
		var block = $(item);
		// Сделать обложкой
	    block.find(".Actions .cover input").click(function(){
	        ajaxloader.show();
	        var button = $(this);
	        $.post(button.attr('href'),{},function(data){
                if (data=='ok'){
		            var src = button.parent().parent().parent().parent().parent().find("table img").attr('src');
		            $(".InAlbum .MainInfo .Img img").attr('src',src);
                    notice('Обложка альбома заменена');
                }
                ajaxloader.hide();
	        });
	        return false;
	    });
	    // Удалить
	    block.find(".Actions .del input").click(function(){
	        var button = $(this);
	        // Подтверждение удаления
	        confirmAction('Вы действительно хотите удалить эту фотографию?',function(){
	            ajaxloader.show();
	            $.post(button.attr('href'),{},function(data){
	                if (data=='ok'){
	                    block.remove();
	                    notice('Фотография успешно удалена');
	                }
	                ajaxloader.hide();
	            });
	            return false;
	        });
	        return false;
	    });
	    block.find("table img").click(function(){
	        var popup = $(".popEvent.photo");
	        var photoblock = $(".BigPhoto",popup);
	        var bg = $(".DarkBg");
	        bg.fadeIn(300);
	        var nextButton = $(".Controls .R",popup);
	        var prevButton = $(".Controls .L",popup);
	        var showPhoto = function(image){
	        	prevButton.add(nextButton).unbind();
	        	if (block.next().length>0) {
		        	nextButton.click(function(){
	        			block = block.next();
	        			showPhoto(block.find("table img")); 
		            }).removeClass('disabled');
	        	} else {
	        		nextButton.addClass('disabled');
	        	}
	        	if (block.prev().length>0) {
	        		prevButton.click(function(){
	        			block = block.prev();
	        			showPhoto(block.find("table img")); 
		            }).removeClass('disabled');
	        	} else {
	        		prevButton.addClass('disabled');
	        	}
		        // действия над фотографией
		        $(".Buttons .cover input",photoblock).unbind().click(function(){ 
		            ajaxloader.show();
		            $.post($(".Actions .cover input",block).attr('href'),{},function(response){
		                if (response=='ok'){
		                    notice('Обложка альбома заменена');
		                }
		                ajaxloader.hide();
		            });
		        });
		        $(".Buttons .del input",photoblock).unbind().click(function(){ 
		            ajaxloader.show();
		            $.post($(".Actions .del input",block).attr('href'),{},function(response){
		                if (response=='ok'){
		                    block.remove();
		                    bg.click();
		                    notice('Фотография успешно удалена');
		                }
		                ajaxloader.hide();
		            });
		        });
		        $(".PhotoDescr .Button .oBut input",photoblock).unbind().click(function(){ 
		            ajaxloader.show();
		            var newDescr = $(this).parent().parent().parent().find('textarea').attr('value');
		            $.post($(".Actions .descr input",block).attr('href'),{text:newDescr},function(response){
		                if (response=='ok'){
		                    notice('Описание фотографии изменено');
		                }
		                ajaxloader.hide();
		            });
		        });
		        // показываем фото
		        var img = new Image();
		        img.src = $(image).attr('src').split('/s/').join('/l/');
		        img.onload = function(){
			        popup.css({
			            'width':(img.width)+'px',
			            'margin-left':-parseInt(img.width/2)
			        });
		        }
		        $(".Img img",photoblock).attr('src',img.src);
	        }
	        showPhoto(this);
	        popup.css({
	            'width':(650+42)+'px',
	            'margin-left':-325+'px',
	            'top':(getBodyScrollTop()+50)+'px'
	        }).show();
	        $(".CloseButton",popup).add(bg).unbind().click(function(){
	            bg.fadeOut(300);
	            popup.hide();
	        });
        });
	});
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
    var currentUrl = $("."+pageClass+">.list input[name='currentUrl']").attr('value');
    if (!currentUrl){
        currentUrl = 'admin/'+pageKey+'/table';
    }
    $("."+pageClass+">.list").load(currentUrl,function(){ 
        initTable();
        ajaxloader.hide();
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
// Поиск
var initSearch = function(){
    var form = $(".search form");
    form.submit(function(){
        var query = form.find("input[name='query']").attr('value');
        $("."+pageClass+">.list").load('admin/'+pageKey+'/table/search/'+query,function(){ 
            initTable();
            ajaxloader.hide();
        });
        return false;
    });
    $(".oActButtons a.save",form).click(function(){
        form.submit();
        initTable();
        return false;
    });
}