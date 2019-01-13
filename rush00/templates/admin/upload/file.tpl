<div class="uploadElem"><form enctype="multipart/form-data" method="post" action="admin/upload/file">
    <h2>Загрузка файла</h2>
    <div class="oT2"><table><tbody>
        <tr>
            <td><span>Файл:</span></td>
            <td>
                <input type="file" name="file"/><input type="hidden" name="indicator"/>
                <!-- BEGIN error_file --><div class="error">{error_file.MESSAGE}</div><!-- END error_file -->
            </td>
        </tr>
        <tr>
            <td class="empty">&nbsp;</td>
            <td>
                <div class="oCheckboxes">
                    <ins><input type="checkbox" id="rewrite" name="rewrite"/><label for="rewrite">Перезаписать, если файл с таким названием уже есть на сервере</label></ins>
                </div>
            </td>
        </tr>
    </tbody></table></div>
    <div class="oActButtons"><a href="javascript:;" class="save">Загрузить</a><a href="javascript:;" class="cancel">Отмена</a></div>
</form></div>