<form action="admin/news/banner/resize" method="post" enctype="multipart/form-data">
    <div class="typPopTitle">Шаг 1. Загрузка картинок для баннера.</div>
    <!-- BEGIN img_exists -->
    <div class="Img" style="margin-bottom:10px">
        <img src="images/news/b/temp/{KEY}?{RAND}" alt="" id="cropbox"/>
    </div>
    <!-- END img_exists -->
    <input type="hidden" id="x" name="x" />
    <input type="hidden" id="y" name="y" />
    <input type="hidden" id="w" name="w" />
    <input type="hidden" id="h" name="h" />
    <input type="hidden" id="rand" name="rand" value="{RAND}" />
    <!-- BEGIN error_x --><div class="error">{error_x.MESSAGE}</div><!-- END error_x -->
    <!-- BEGIN error_file --><div class="error">{error_file.MESSAGE}</div><!-- END error_file -->
    <div class="Buttons">
        <span class="oFileLink upload"><i>Добавить картинку</i><input type="file" name="file" size="70" href="admin/news/banner/upload"/></span>
        <!-- BEGIN img_exists -->
        <div class="oBut green save"><input type="submit" value="Готово, далее"/></div>
        <!-- END img_exists -->
        <div class="oBut cancel"><input type="submit" value="Отмена"/></div>
    </div>
</form>