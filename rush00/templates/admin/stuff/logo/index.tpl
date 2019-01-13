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
});
</script>
<div class="helpDescr">В данном разделе вы можете задать различные мелкие параметры сайта.</div>
<div class="cats">
    <a href="admin/stuff">Параметры сайта</a>
    <a href="admin/stuff/cert">Сертификаты</a>
    <span style="background:#ffffff;">Логотип</span>
</div>
<div class="catExt settings oEditor">
    <div class="oT2 oEditItem">
    <table><tbody>
	    <tr><td colspan="2"><h3>&nbsp;</h3></td></tr>
        <tr>
            <td><span>Логотип:</span></td>
            <td class="pictureBlock"><form action="admin/stuff/logo/add" method="post">
			    <!-- BEGIN no_img -->
				<div class="addImage">
				    <span class="oFileLink add"><i>Прикрепить</i><input type="file" name="file" size="40" rel="admin/stuff/logo/add"/></span>
				</div>
				<!-- END no_img -->
				<!-- BEGIN img -->
				<div class="changeImage">
				    <img src="images/logo/logo.png?rand={RAND}" alt="" title="" style="border:1px solid gray;padding:3px;"/>
				    <span class="oFileLink add"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/stuff/logo/add"/></span>
				    <span class="oFileLink delete" rel="admin/stuff/logo/delete"><i>Удалить</i></span>
				</div>
				<!-- END img -->
            </form></td>
        </tr>
	</tbody></table>
    </div>
</div>
<!-- INCLUDE admin/footer.tpl -->