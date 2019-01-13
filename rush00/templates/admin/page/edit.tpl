<form action="admin/page/edit/{ID}" method="post">
<div class="oT2">
<table><tbody>
    <tr><td colspan="2"><h3>Редактирование страницы</h3></td></tr>
    <tr>
        <td><span>Ключ:</span></td>
        <td><div class="value">{PAGE_NAME}</div>
        </td>
    </tr>
    <tr>
        <td><span>Заголовок:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="title"/></b></i></div>
            <!-- BEGIN error_title --><div class="error">{error_title.MESSAGE}</div><!-- END error_title -->
        </td>
    </tr>
    <tr<!-- BEGIN production --> style="display:none"<!-- END production -->>
        <td colspan="2">
            <label><input type="checkbox" name="dynamic"/> Динамическая</label>
        </td>
    </tr>
    <tr<!-- BEGIN dynamic --> style="display:none"<!-- END dynamic -->>
        <td><span>Содержимое:</span></td>
        <td>
            <div class="oWysTextarea">
                <textarea name="content" rows="15" cols="250" style="height:300px;" class="wiki"></textarea>
            </div>
            <!-- BEGIN error_content --><div class="error">{error_content.MESSAGE}</div><!-- END error_content -->
        </td>
    </tr>
    <tr<!-- BEGIN dynamic --> style="display:none"<!-- END dynamic -->>
        <td class="empty">&nbsp;</td>
        <td><div class="oActButtons">
            <a href="javascript:;" for="content" class="preview">Предпросмотр</a>
            <a href="admin/upload/image" class="upload">Загрузить картинку</a>
            <a href="admin/upload/file" class="upload">Загрузить файл</a>
        </div></td>
    </tr>
    <tr class="previewRow" for="content" style="display:none">
         <td><span>Предпросмотр:</span></td>
         <td>
              <div class="oPreview manual wikitext"></div>
         </td>
    </tr>
    <!-- BEGIN static -->
    <tr><td class="empty">&nbsp;</td><td><h3>Параметры для поисковых систем</h3></td></tr>
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
            <a href="javascript:;" class="save">Сохранить изменения</a>
            <a href="javascript:;" class="cancel">Отмена</a>
        </div></td>
    </tr>
</tbody></table>
</div>
</form>