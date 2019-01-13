$(document).ready(function(){
    $("form").each(function(i,form){
        $("a.submit", form).live('click', function(){
            form.submit();
            return false;
        });
    });
    ajaxloader = $(".ajaxLoading");
});
var ajaxloader;
// Всплывающие уведомления
var notice = function(message){
    var popup = $("#notice");
    popup.find(".textMessage").text(message);
    popup.fadeIn(300);
    setTimeout(function(){popup.fadeOut(300);},2000);
}
// Окошко подтверждения какого-либо действия
var confirmAction = function(question,callbackYes,callbackNo){
    // Подтверждение
    var confirmBlock = $("#confirm");
    confirmBlock.find(".question").text(question);
    confirmBlock.fadeIn(300);
    // Удаление
    $(".oActButtons a.save",confirmBlock).unbind().click(function(){
        confirmBlock.fadeOut(300);
        if (callbackYes){
            callbackYes();
        }
        return false;
    });
    // Отмена
    $(".oActButtons a.cancel",confirmBlock).unbind().click(function(){
        confirmBlock.fadeOut(300);
        if (callbackNo){
            callbackNo();
        }
        return false;
    });
    return false;
}
// Стрелка вверх
var arrowUp = function(button){
    button.removeClass('toOpen').addClass('toClose');
    button.attr('title','Свернуть');
}
// Стрелка вниз
var arrowDown = function(button){
    button.removeClass('toClose').addClass('toOpen');
    button.attr('title','Развернуть');
}
// Активировать редактор
var initEditor = function(textarea,block) {
    textarea.markItUp(myWikiSettings);
    textarea.wrap("<div class='textarea'><i><b></b></i></div>");
    var button = block.find(".oActButtons a.preview");
    var preview = block.find(".previewRow");
    var previewLoad = function() {
        var text = $(textarea).attr('value');
        if (text){
            ajaxloader.show();
            $.post("admin/parser/wiki",{data:text},function(data){
                preview.find(".oPreview").html(data);
                button.unbind().click(previewHide);
                ajaxloader.hide();
                previewShow();
            });
        }
    }
    var previewHide = function() {
        block.find(".oActButtons").removeClass("withPreview");
        preview.hide();
        button.unbind().click(previewShow);
    }
    var previewShow = function() {
        block.find(".oActButtons").addClass("withPreview");
        preview.show();
        button.unbind().click(previewHide);
    }
    textarea.change(function(){
        button.unbind().click(previewLoad);
    });
    textarea.parent().find(".markItUpHeader ul li").click(function(){
        button.unbind().click(previewLoad);
    });
    button.click(previewLoad);
}