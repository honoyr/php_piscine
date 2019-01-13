<div class="oEditItem">
    <form action="admin/page/add" method="post"><div class="oT2"><table><tbody>
    <tr>
        <td><span>Ключ:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="name"/></b></i></div>
            <div class="Example">Например: my_page, category/page</div>
            <!-- BEGIN error_name --><div class="error">{error_name.MESSAGE}</div><!-- END error_name -->
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
    <tr>
        <td><span>Содержимое:</span></td>
        <td>
            <div class="oWysTextarea">
                <textarea name="content" rows="10" cols="30" style="height:300px;" class="wiki"></textarea>
            </div>
            <!-- BEGIN error_content --><div class="error">{error_content.MESSAGE}</div><!-- END error_content -->
        </td>
    </tr>
    <tr>
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
            <a href="javascript:;" class="save">Добавить страницу</a>
            <a href="javascript:;" class="cancel">Отмена</a>
        </div></td>
    </tr>
    </tbody></table></div></form>
</div>