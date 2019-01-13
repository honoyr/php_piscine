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
    $(".fixedBlock").each(function(i,item){
        var block = $(item);
        // Форма загрузки файла
        $("form input",block).click(function(){
            var form = $("form",block);
            form.unbind().submit(function(){
                ajaxloader.show();
                $(this).ajaxSubmit({
                    success: function(data) {
                        ajaxloader.hide();
                    }
                });
                return false;
            }).submit();
        });
    });
});
</script>
<div class="helpDescr">В данном разделе вы можете поставить фоновую картинку и паттерн на сайт.
<ol style="list-style-type:inner;">Таким образом, фон состоит из трех слоев:
<li>нижний - цвет фона</li>
<li>средний - паттерн, повторяется по оси X и Y</li>
<li>верхний - картинка, прижимается к верху и выравнивается по центру экрана</li>
</ol>
</div>
<div class="cats">
    <a href="admin/theme">Готовые темы</a>
    <a href="admin/theme/color">Цветовая гамма</a>
    <span style="background:#ffffff;">Фоновая картинка</span>
</div>
<div class="catExt settings oEditor">
    <div class="oT2 oEditItem">
    <table><tbody>
	    <tr><td colspan="2"><h3>&nbsp;</h3></td></tr>
        <tr>
            <td><span>Фоновая картинка:</span></td>
            <td class="pictureBlock"><form action="admin/theme/background/add/bg" method="post" enctype="multipart/form-data">
			    <!-- BEGIN no_img_bg -->
				<div class="addImage">
				    <span class="oFileLink add"><i>Загрузить</i><input type="file" name="file" size="40" rel="admin/theme/background/add/bg"/></span>
				</div>
				<!-- END no_img_bg -->
				<!-- BEGIN img_bg -->
				<div class="changeImage">
				    <img src="images/background/bg.png?rand={RAND}" alt="" title="" style="border:1px solid gray;padding:3px;"/>
				    <span class="oFileLink add"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/theme/background/add/bg"/></span>
				    <span class="oFileLink delete" rel="admin/theme/background/delete/bg"><i>Удалить</i></span>
				</div>
				<!-- END img_bg -->
            </form></td>
        </tr>
        <tr>
            <td><span>&nbsp;</span></td>
            <td class="fixedBlock"><form action="admin/theme/background/fixed/bg" method="post" enctype="multipart/form-data">
                <input name="fixed" type="checkbox" {BG_FIXED}/> Прикрепить
            </form></td>
        </tr>
        <tr>
            <td><span>Паттерн:</span></td>
            <td class="pictureBlock"><form action="admin/theme/background/add/pattern" method="post" enctype="multipart/form-data">
                <!-- BEGIN no_img_pattern -->
                <div class="addImage">
                    <span class="oFileLink add"><i>Загрузить</i><input type="file" name="file" size="40" rel="admin/theme/background/add/pattern"/></span>
                </div>
                <!-- END no_img_pattern -->
                <!-- BEGIN img_pattern -->
                <div class="changeImage">
                    <img src="images/background/pattern.png?rand={RAND}" alt="" title="" style="border:1px solid gray;padding:3px;"/>
                    <span class="oFileLink add"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/theme/background/add/pattern"/></span>
                    <span class="oFileLink delete" rel="admin/theme/background/delete/pattern"><i>Удалить</i></span>
                </div>
                <!-- END img_pattern -->
            </form></td>
        </tr>
        <tr>
            <td><span>&nbsp;</span></td>
            <td class="fixedBlock"><form action="admin/theme/background/fixed/pattern" method="post" enctype="multipart/form-data">
                <input name="fixed" type="checkbox" {PATTERN_FIXED}/> Прикрепить
            </form></td>
        </tr>
	</tbody></table>
    </div>
</div>
<!-- INCLUDE admin/footer.tpl -->