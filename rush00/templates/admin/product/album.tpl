<div class="e InAlbum">
    <div class="Els"><div class="in sortable" rel="admin/product/reorderalbum/{PRODUCT_ID}">
        <!-- BEGIN photo -->
        <div class="e" id="{photo.SRC}"><div class="in">
            <table><tbody><tr><td><img src="images/product/s/{photo.SRC}" alt="" /></td></tr></tbody></table>
            <div class="Actions"><div class="in">
                <div><div class="oBut red del"><input type="submit" value="Удалить" href="admin/product/deletephoto/{PRODUCT_ID}/{photo.SRC}"/></div></div>
            </div></div>
            <div class="MoveHelper"><div class="in"></div></div> 
        </div></div>
        <!-- END photo -->
    </div></div>
</div>
<div class="e Upload2">
    <div class="Title">Выберите фотографии для загрузки в альбом</div>
    <div class="Block">
        <div class="fileUpload" id="uploader{PRODUCT_ID}" rel="{PRODUCT_ID}"></div> 
        <div class="Buttons" style="margin-top:15px;display:none;">
            <div class="e"><div class="oBut green upload"><input type="submit" value="Загрузить выбранные файлы"/></div></div>
            <div class="e"><div class="oBut white cancel"><input type="submit" value="Отмена"/></div></div>
        </div><br style="clear:both"/>
    </div>
</div>