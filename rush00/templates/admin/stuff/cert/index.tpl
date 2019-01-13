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
    <span style="background:#ffffff;">Сертификаты</span>
    <a href="admin/stuff/logo">Логотип</a>
</div>
<div class="catExt settings oEditor">
    <div class="oT2 oEditItem">
    <table><tbody>
	    <tr><td colspan="2"><h3>&nbsp;</h3></td></tr>
	    <!-- BEGIN img -->
	    <tr>
	        <td><span>Сертификат {img.NUM}:</span></td>
	        <td class="pictureBlock"><form action="admin/stuff/cert/add/{img.NUM}" method="post">
	               <!-- BEGIN img.no -->
	               <div class="addImage">
	                   <span class="oFileLink add"><i>Прикрепить</i><input type="file" name="file" size="40" rel="admin/stuff/cert/add/{img.NUM}"/></span>
	               </div>
	               <!-- END img.no -->
	               <!-- BEGIN img.yes -->
	               <div class="changeImage">
	                   <img src="images/cert/s/{img.NUM}.jpg?rand={RAND}" alt="" title="" />
	                   <span class="oFileLink add"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/stuff/cert/add/{img.NUM}"/></span>
	                   <span class="oFileLink delete" rel="admin/stuff/cert/delete/{img.NUM}"><i>Удалить</i></span>
	               </div>
	               <!-- END img.yes -->
	        </form></td>
	    </tr>
	    <!-- END img -->
	</tbody></table>
    </div>
</div>
<!-- INCLUDE admin/footer.tpl -->