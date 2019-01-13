<!-- BEGIN widget.menu -->
<script type="text/javascript">
$(document).ready(function() {
    // Подсветка пунктов меню
    $(".Menu a").each(function(i,item){
        var url = $(item).attr('href');
        if (location.href.lastIndexOf(url)>0){
           $(item).addClass('active');
        }
    });
});
</script>
<div class="Menu"><div class="in"><table><tbody><tr>
    <!-- BEGIN widget.menu.item -->
    <td><a href="{widget.menu.item.LINK}">{widget.menu.item.TITLE}</a></td>
    <!-- END widget.menu.item -->
</tr></tbody></table></div></div>
<!-- END widget.menu -->