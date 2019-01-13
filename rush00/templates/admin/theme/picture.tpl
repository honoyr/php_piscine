<!-- BEGIN success -->
<div class="changeImage">
    <img src="images/themes/temp/{KEY}" alt="" title=""  />
    <input type="hidden" name="pictureKey" value="{KEY}"/>
    <span class="oFileLink"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/theme/picture"/></span>
</div>
<!-- END success -->
<!-- BEGIN fail -->
<div class="addImage">
    <span class="oFileLink"><i>Добавить</i><input type="file" name="file" size="40" rel="admin/theme/picture"/></span>
    <!-- BEGIN error_file -->
    <div class="error">{error_file.MESSAGE}</div>
    <!-- END error_file -->
    <input type="hidden" name="pictureKey" value=""/>
</div>
<!-- END fail -->