<!-- INCLUDE admin/header.tpl -->
<script type="text/javascript">
$(document).ready(function() {
	$(".pictureBlock").each(function(i,item){
		var block = $(item);
	    // Форма загрузки файла
	    $("form .oFileLink.add",block).live('click',function(){
	        var form = $("form",block);
	        form.unbind().submit(function(){
	            ajaxloader.show();
	            $(this).ajaxSubmit({
	                success: function(data) {
	                    block.html(data);
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
	    // Удалить
	    $("form .oFileLink.delete",block).live('click',function(){
	    	ajaxloader.show();
	        block.load($(this).attr('rel'),{},function(){ ajaxloader.hide(); });
        });
	});
    // Блок настроек
    initSettings();
});
// Изменение настроек
var initSettings = function(){
    var block = $(".settings");
    // Сохранение
    $("form .oActButtons a.save",block).live('click',function(){
        ajaxloader.show();
        $("form",block).submit(function(){
            $(this).ajaxSubmit({
                success: function(data) {
                    if (data=='ok') {
                        // Уведомление о сохранении
                        notice('Настройки блока скидки успешно изменены');
                    } else {
                        block.find("form>div.oT2").html(data);
                    }
                    ajaxloader.hide();
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

    initEditor($(".wiki",block));
}
</script>
<div class="helpDescr">В данном разделе вы можете редактировать такие блоки как гарантия, акция и скидка.</div>
<div class="cats">
    <a href="admin/block/guarantee">Гарантия</a>
    <a href="admin/block/promo">Акция</a>
    <span style="background:#ffffff;">Скидка</span>
    <a href="admin/block/justbuy">Только что купили</a>
</div>
<div class="catExt oEditor">
    <div class="oT2 oEditItem">
    <table><tbody>
	    <tr><td colspan="2"><h3>&nbsp;</h3></td></tr>
        <tr>
            <td><span>Картинка:</span></td>
            <td class="pictureBlock"><form action="admin/block/discount/add" method="post">
			    <!-- BEGIN no_img -->
				<div class="addImage">
				    <span class="oFileLink add"><i>Прикрепить</i><input type="file" name="file" size="40" rel="admin/block/discount/add"/></span>
				</div>
				<!-- END no_img -->
				<!-- BEGIN img -->
				<div class="changeImage">
				    <img src="images/stuff/discount.png?rand={RAND}" alt="" title="" style="border:1px solid gray;padding:3px;"/>
				    <span class="oFileLink add"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/block/discount/add"/></span>
				    <span class="oFileLink delete" rel="admin/block/discount/delete"><i>Удалить</i></span>
				</div>
				<!-- END img -->
            </form></td>
        </tr>
	</tbody></table>
    </div>
    <div class="settings"><form action="admin/block/discount/settings" method="post">
        <div class="oT2 oEditItem"><!-- INCLUDE admin/block/discount/settings.tpl --></div>
    </form></div>
</div>
<!-- INCLUDE admin/footer.tpl -->