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