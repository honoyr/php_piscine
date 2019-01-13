<div class="oEditItem">
    <form action="admin/news/add" method="post" enctype="multipart/form-data"><div class="oT2"><table><tbody>
    <tr>
        <td><span>Заголовок:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="title"/></b></i></div>
            <!-- BEGIN error_title --><div class="error">{error_title.MESSAGE}</div><!-- END error_title -->
        </td>
    </tr>
    <tr>
        <td><span>Краткий текст новости:</span></td>
        <td>
            <textarea name="brief" rows="5" cols="100" style="height:100px;" class="wiki"></textarea>
            <!-- BEGIN error_brief --><div class="error">{error_brief.MESSAGE}</div><!-- END error_brief -->
        </td>
    </tr>
    <tr>
        <td class="empty">&nbsp;</td>
        <td><div class="oActButtons">
            <a href="javascript:;" class="preview" for="brief">Предпросмотр</a>
            <a href="admin/upload/image" class="upload">Загрузить картинку</a>
            <a href="admin/upload/file" class="upload">Загрузить файл</a>
        </div></td>
    </tr>
    <tr class="previewRow" for="brief" style="display:none">
         <td><span>Предпросмотр:</span></td>
         <td>
              <div class="oPreview manual"></div>
         </td>
    </tr>
    <tr>
        <td><span>Полный текст новости:</span></td>
        <td><textarea name="content" rows="5" cols="100" style="height:200px;" class="wiki"></textarea>
            <!-- BEGIN error_content --><div class="error">{error_content.MESSAGE}</div><!-- END error_content -->
        </td>
    </tr>
    <tr>
        <td class="empty">&nbsp;</td>
        <td><div class="oActButtons">
            <a href="javascript:;" class="preview" for="content">Предпросмотр</a>
            <a href="admin/upload/image" class="upload">Загрузить картинку</a>
            <a href="admin/upload/file" class="upload">Загрузить файл</a>
        </div></td>
    </tr>
    <tr class="previewRow" for="content" style="display:none">
         <td><span>Предпросмотр:</span></td>
         <td>
              <div class="oPreview manual"></div>
         </td>
    </tr>
    <tr>
        <td class="empty">&nbsp;</td>
        <td><div class="oCheckboxes">
            <ins><input type="checkbox" name="enable" id="showBroker" default="checked"/><label for="showBroker">Сразу же показать новость на сайте</label></ins>
        </div></td>
    </tr>
    <tr style="display:none"><td class="empty">&nbsp;</td><td><h3>Параметры для поисковых систем</h3></td></tr>
    <tr style="display:none">
        <td><span>Ключевые слова:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="keywords"/></b></i></div></td>
    </tr>
    <tr style="display:none">
        <td><span>Описание:</span></td>
        <td>
            <div class="textarea"><i><b><textarea name="description" rows="5" cols="100" style="height:50px;"></textarea></b></i></div>
        </td>
    </tr>
    <tr>
        <td class="empty">&nbsp;</td>
        <td><div class="oActButtons">
            <a href="javascript:;" class="save">Добавить</a>
            <a href="javascript:;" class="cancel">Отмена</a>
        </div></td>
    </tr>
    </tbody></table></div></form>
</div>