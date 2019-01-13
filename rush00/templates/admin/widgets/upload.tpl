<script type="text/javascript" >
$(document).ready(function(){
    $(".uploadWindow #ajax_form").submit(function(){
        $(this).ajaxSubmit({
            success: function(data) {
                data = $.trim(data);
                $(".uploadWindow .notice").html(data);
            }
        });
        return false;
    });
});
</script>
<div class="uploadWindow">
    <h3>Загрузка файлов</h3>
    <div class="notice">
        Форма работает без перезагрузки.
    </div>
    <form action="admin/upload/image" method="POST" enctype="multipart/form-data" id="ajax_form">
        Файл:<br />
        <input type="file" name="image"/><br />
        <input type="checkbox" name="rewrite"/> Перезаписать? &nbsp;&nbsp;&nbsp;&nbsp;<br/>
        <input type="submit" class="submit" value="Загрузить"/>
    </form>
</div>