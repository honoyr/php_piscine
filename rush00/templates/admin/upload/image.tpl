<div class="uploadElem"><form enctype="multipart/form-data" method="post" action="admin/upload/image">
    <h2>Загрузка картинки</h2>
    <div class="chooseVar">
        <div class="item">
            <input type="radio" id="src_1" value="computer" name="source" checked="checked"/>
            <div class="info">
                <div class="name"><label for="src_1">Загрузить с компьютера</label></div>
                <div style="display:none;" class="options">
                    <div class="oT2"><table><tbody>
                        <tr>
                            <td><span>Файл:</span></td>
                            <td>
                                <input type="file" name="file"/>
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
                </div>
            </div>
        </div>
        <div class="item">
            <input type="radio" id="src_2" value="url" name="source"/>
            <div class="info">
                <div class="name"><label for="src_2">Загрузить по ссылке</label></div>
                <div style="display:none;" class="options">
                    <div class="oT2"><table><tbody>
                        <tr>
                            <td><span>Ссылка:</span></td>
                            <td>
                                <div class="inputText"><i><b><input type="text" default="http://" name="url"/></b></i></div>
                                <!-- BEGIN error_url --><div class="error">{error_url.MESSAGE}</div><!-- END error_url -->
                            </td>
                        </tr>
                    </tbody></table></div>
                </div>
            </div>
        </div>
        <!-- BEGIN error_source --><div class="error">{error_source.MESSAGE}</div><!-- END error_source -->
    </div>
    <div class="oActButtons"><a href="javascript:;" class="save">Загрузить</a><a href="javascript:;" class="cancel">Отмена</a></div>
</form></div>