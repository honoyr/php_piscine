<form action="admin/product/edit/{ID}" method="post" enctype="multipart/form-data"><div class="oT2"><table><tbody>
    <tr><td colspan="2"><h3>Редактирование продукта</h3></td></tr>
    <tr>
        <td><span>Название:</span></td>
        <td>
            <div class="inputText"><i><b><input type="text" name="name"/></b></i></div>
            <!-- BEGIN error_name --><div class="error">{error_name.MESSAGE}</div><!-- END error_name -->
        </td>
    </tr>
    <tr>
        <td><span>Категории:</span></td>
        <td>
            <div class="select"><i><b><u><select name="category_id" multiple="multiple" size="5">$categories</select></u></b></i></div>
            <div class="Example">Удерживайте Ctrl<br/>для выбора<br/>нескольких категорий</div>
            <!-- BEGIN error_category_id --><div class="error">{error_category_id.MESSAGE}</div><!-- END error_category_id -->
        </td>
    </tr>
    <tr>
        <td><span>Картинка:</span></td>
        <td>
            <div class="Picture">
                <!-- BEGIN no_picture -->
                <div class="addImage">
                    <span class="oFileLink"><i>Прикрепить</i><input type="file" name="file" size="40" rel="admin/product/picture"/></span>
                </div>
                <!-- END no_picture -->
                <!-- BEGIN picture2 -->
                <div class="changeImage">
                    <img src="images/product/temp/{picture2.KEY}" alt="" title=""  width="180" />
                    <span class="oFileLink"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/product/picture"/></span>
                </div>
                <!-- END picture2 -->
                <!-- BEGIN picture -->
                <div class="changeImage">
                    <img src="images/product/s/{picture.FILE}" alt="" title="" width="180" />
                    <span class="oFileLink"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/product/picture"/></span>
                </div>
                <!-- END picture -->
                <input type="hidden" name="pictureKey" default=""/>
            </div>
        </td>
    </tr>
    <tr>
        <td><span>Краткое описание:</span></td>
        <td><div class="textarea"><i><b><textarea name="brief" cols="30" rows="10" style="height:50px;"></textarea></b></i></div></td>
    </tr>
    <tr>
        <td><span>Подробное описание:</span></td>
        <td><textarea name="description_wiki" cols="30" rows="10" style="height:300px;" class="wiki"></textarea></td>
    </tr>
    <tr>
        <td class="empty">&nbsp;</td>
        <td><div class="oActButtons">
            <a href="javascript:;" class="preview" for="description_wiki">Предпросмотр</a>
            <a href="admin/upload/image" class="upload">Загрузить картинку</a>
            <a href="admin/upload/file" class="upload">Загрузить файл</a>
        </div></td>
    </tr>
    <tr class="previewRow" for="description_wiki" style="display:none">
         <td><span>Предпросмотр:</span></td>
         <td>
              <div class="oPreview manual wikitext"></div>
         </td>
    </tr>
    <tr style="display:none;">
        <td><span>SEO Текст:</span></td>
        <td><textarea name="seotext_wiki" cols="30" rows="10" style="height:200px;" class="wiki"></textarea></td>
    </tr>
    <tr>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr>
        <td><span><s>Старая цена (руб)</s>:</span></td>
        <td>
            <div class="inputText"><i><b><input type="text" name="price_old"/></b></i></div>
            <!-- BEGIN error_price_old --><div class="error">{error_price_old.MESSAGE}</div><!-- END error_price_old -->
        </td>
    </tr>
    <tr>
        <td><span>Цена (руб):</span></td>
        <td>
            <div class="inputText"><i><b><input type="text" name="price"/></b></i></div>
            <!-- BEGIN error_price --><div class="error">{error_price.MESSAGE}</div><!-- END error_price -->
        </td>
    </tr>
    <tr>
        <td><span>Ярлык:</span></td>
        <td>
            <label><input type="radio" name="label" value=""/> нет</label>
            <label><input type="radio" name="label" value="new"/> Новый</label>
            <label><input type="radio" name="label" value="hit"/> Хит</label>
            <label><input type="radio" name="label" value="discount"/> Скидка</label>
            <label><input type="radio" name="label" value="promo"/> Акция</label>
        </td>
    </tr>
    <tr style="display:none;">
        <td><span>С этим товаром также покупают:</span></td>
        <td>
            <div class="select"><i><b><u><select name="also" multiple="multiple" size="10">$products</select></u></b></i></div>
            <div class="Example">Удерживайте Ctrl<br/>для выбора<br/>нескольких позиций</div>
            <!-- BEGIN error_also --><div class="error">{error_also.MESSAGE}</div><!-- END error_also -->
        </td>
    </tr>
    <tr>
        <td><span></span></td>
        <td>
            <label><input type="checkbox" name="main"/> Показывать товар на главной странице</label>
        </td>
    </tr>
    <tr><td class="empty">&nbsp;</td><td><h3>Параметры для поисковых систем</h3></td></tr>
    <tr style="display:none;">
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
           <a href="javascript:;" class="save">Сохранить изменения</a>
           <a href="javascript:;" class="cancel">Отмена</a>
       </div></td>
    </tr>
</tbody></table></div></form>