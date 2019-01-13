<!-- INCLUDE admin/header.tpl -->
<link rel="stylesheet" href="styles/admin/farbtastic.css" type="text/css"/>
<script type="text/javascript" src="scripts/farbtastic.js"></script>
<style type="text/css" media="screen">
.colorwell {
  border: 2px solid #fff;
  width: 6em;
  text-align: center;
  cursor: pointer;
}
.colorwell-selected {
  border: 2px solid #000;
  font-weight: bold;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    // Блок настроек
    initSettings();
});
// Изменение настроек
var initSettings = function(){
    var block = $(".settings");
    // Farbtastic
    var f = $.farbtastic('#picker');
    var p = $('#picker').css('opacity', 0.25);
    var selected;
    $('.colorwell')
	    .each(function () { 
		    f.linkTo(this); $(this).css('opacity', 0.75); 
		    if ($(this).val()==''){ $(this).val(' ') }
		})
	    .focus(function() {
	       if (selected) {
	         $(selected).css('opacity', 0.75).removeClass('colorwell-selected');
	       }
	       f.linkTo(this);
	       p.css('opacity', 1);
	       $(selected = this).css('opacity', 1).addClass('colorwell-selected');
    });
    // Сохранение
    $("form .oActButtons a.save",block).click(function(){
        ajaxloader.show();
        $("form",block).submit(function(){
            $(this).ajaxSubmit({
                success: function(data) {
                    if (data=='ok') {
                        //block.find("form .oActButtons a.cancel").click();
                        // Уведомление о сохранении
                        notice('Цвета успешно изменены');
                    } else {
                        block.find("form>div.oT2").html(data);
                        initSettings();
                    }
                    ajaxloader.hide();
                }
            });
            return false;
        }).submit();
        return false;
    });
    // Отмена
    $("form .oActButtons a.cancel",block).click(function(){
        ajaxloader.show();
        block.find("form>div.oT2").load(block.find("form").attr('action'),{},function(data){
            initSettings();
            ajaxloader.hide();
        });
    });
}
</script>
<div class="helpDescr">В данном разделе вы можете задать цвета различных элементов сайта.</div>
<div class="cats">
    <a href="admin/theme">Готовые темы</a>
    <span style="background:#ffffff;">Цветовая гамма</span>
    <a href="admin/theme/background">Фоновая картинка</a>
</div>
<div class="catExt settings oEditor">
    <form action="admin/theme/color/settings" method="post">
        <div class="oT2 oEditItem"><!-- INCLUDE admin/theme/color/settings.tpl --></div>
    </form>
</div>
<!-- INCLUDE admin/footer.tpl -->