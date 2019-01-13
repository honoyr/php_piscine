<form action="admin/product/category/add/{ID}" method="post">
    <div class="typPopTitle">Добавление категории</div>
    <div class="addNewCat">
        <div class="oT2"><table><tbody>
            <tr>
                <td><span>Название:</span></td>
                <td>
                    <div class="inputText"><i><b><input type="text" name="name"/></b></i></div>
                    <!-- BEGIN error_name --><div class="error">{error_name.MESSAGE}</div><!-- END error_name -->
                </td>
            </tr>
            <tr>
                <td><span>Ключ:</span></td>
                <td>
                    <div class="inputText"><i><b><input type="text" name="key"/></b></i></div>
                    <div class="Example">Например: stuff (заполняется автоматически из названия)</div>
                    <!-- BEGIN error_key --><div class="error">{error_key.MESSAGE}</div><!-- END error_key -->
                </td>
            </tr>
            <tr>
                <td><span>Вложить в:</span></td>
                <td>
                    <div class="select"><i><b><u><select name="parent_id"><option value="0"></option>$categories</select></u></b></i></div>
                    <!-- BEGIN error_parent_id --><div class="error">{error_parent_id.MESSAGE}</div><!-- END error_parent_id -->
                </td>
            </tr>
		    <tr>
		        <td><span>Описание:</span></td>
		        <td>
		            <div class="oWysTextarea">
		                <textarea name="description_wiki" rows="10" cols="30" style="height:200px;" class="wiki"></textarea>
		            </div>
		            <!-- BEGIN error_description_wiki --><div class="error">{error_description_wiki.MESSAGE}</div><!-- END error_description_wiki -->
		        </td>
		    </tr>
	        <tr style="display:none;">
	            <td><span>SEO текст:</span></td>
	            <td>
                    <div class="oWysTextarea">
                        <textarea name="seotext_wiki" rows="10" cols="30" style="height:200px;" class="wiki"></textarea>
                    </div>
                </td>
	        </tr>
            <tr style="display:none;">
                <td><span>Блок сбоку (html):</span></td>
                <td><div class="textarea"><i><b><textarea name="block" cols="30" rows="10" style="height:100px;"></textarea></b></i></div></td>
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
                <td><div class="Buttons">
                    <div class="oBut Big green save"><input type="submit" value="Добавить"/></div>
                    <div class="oBut Big cancel"><input type="submit" value="Отмена"/></div>
                </div></td>
            </tr>
        </tbody></table></div>
    </div>
</form>