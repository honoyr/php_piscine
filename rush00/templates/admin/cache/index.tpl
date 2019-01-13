<!-- INCLUDE admin/header.tpl -->
<script type="text/javascript">
$(document).ready(function() {
    // Удалить кеш
    $(".actions a.delete").click(function(){
        ajaxloader.show();
        $.post($(this).attr('href'),{},function(data){
            notice('Кеш удален');
            ajaxloader.hide();
            location.reload();
        });
        return false;
    });
});
</script>
<div class="helpDescr">В данном разделе содержится информация по кешируемым данным.</div>
<div class="settings oEditor">
    <div class="actions"><a href="admin/cache/delete" class="delete">Очистить кеш</a></div>
    <table cellspacing="1" cellpadding="5" border="0" width="500" class="grid">
    <tr>
        <th>Path</th>
        <th>Files</th>
        <th>Size</th>
    </tr>
    <!-- BEGIN cache -->
    <tr>
        <td>{cache.PATH}</td>
        <td>{cache.FILES}</td>
        <td>{cache.SIZE}</td>
    </tr>
    <!-- END cache -->
</table>
</div>
<!-- INCLUDE admin/footer.tpl -->