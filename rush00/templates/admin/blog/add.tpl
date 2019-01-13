<div class="oEditItem">
    <form action="admin/blog/add" method="post" enctype="multipart/form-data"><div class="oT2"><table><tbody>
    <tr>
        <td><span>Заголовок:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="name"/></b></i></div>
            <!-- BEGIN error_name --><div class="error">{error_name.MESSAGE}</div><!-- END error_name -->
        </td>
    </tr>
    <tr>
        <td><span>Ключ:</span></td>
        <td>
            <div class="inputText"><i><b><input type="text" name="key" rel="name"/></b></i></div>
            <div class="Example">Например: newyear (заполняется автоматически из названия)</div>
            <!-- BEGIN error_key --><div class="error">{error_key.MESSAGE}</div><!-- END error_key -->
        </td>
    </tr>
    <tr>
        <td><span>Краткий текст новости:</span></td>
        <td>
            <textarea name="brief_wiki" rows="5" cols="100" style="height:100px;" class="wiki"></textarea>
            <!-- BEGIN error_brief_wiki --><div class="error">{error_brief_wiki.MESSAGE}</div><!-- END error_brief_wiki -->
        </td>
    </tr>
    <tr>
        <td class="empty">&nbsp;</td>
        <td><div class="oActButtons">
            <a href="javascript:;" class="preview" for="brief_wiki">Предпросмотр</a>
            <a href="admin/upload/image" class="upload">Загрузить картинку</a>
            <a href="admin/upload/file" class="upload">Загрузить файл</a>
        </div></td>
    </tr>
    <tr class="previewRow" for="brief_wiki" style="display:none">
         <td><span>Предпросмотр:</span></td>
         <td>
              <div class="oPreview manual"></div>
         </td>
    </tr>
    <tr>
        <td><span>Полный текст новости:</span></td>
        <td><textarea name="content_wiki" rows="5" cols="100" style="height:200px;" class="wiki"></textarea>
            <!-- BEGIN error_content_wiki --><div class="error">{error_content_wiki.MESSAGE}</div><!-- END error_content_wiki -->
        </td>
    </tr>
    <tr>
        <td class="empty">&nbsp;</td>
        <td><div class="oActButtons">
            <a href="javascript:;" class="preview" for="content_wiki">Предпросмотр</a>
            <a href="admin/upload/image" class="upload">Загрузить картинку</a>
            <a href="admin/upload/file" class="upload">Загрузить файл</a>
        </div></td>
    </tr>
    <tr class="previewRow" for="content_wiki" style="display:none">
         <td><span>Предпросмотр:</span></td>
         <td>
              <div class="oPreview manual"></div>
         </td>
    </tr>
    <tr><td class="empty">&nbsp;</td><td><h3>Параметры для поисковых систем</h3></td></tr>
    <tr>
        <td><span>Заголовок:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="title"/></b></i></div></td>
    </tr>
    <tr>
        <td><span>Ключевые слова:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="keywords"/></b></i></div>
            <div class="Example">5-10 слов, разделенных запятыми</div></td>
    </tr>
    <tr>
        <td><span>Описание:</span></td>
        <td>
            <div class="textarea"><i><b><textarea name="description" rows="5" cols="100" style="height:50px;"></textarea></b></i></div>
            <div class="Example">Одно-два предложения, кратко представляющие информацию на странице</div>
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