<form action="admin/news/banner/add" method="post" id="fillData">
    <div class="typPopTitle">Шаг 2. Задание текста и ссылки для баннера.</div>
    <div class="TopNew" style="margin-bottom:15px">
	    <div class="Images"><table><tbody><tr>
		    <td><img src="images/news/b/temp/{KEY}?{RAND}" alt="" title="" /></td>
		</tr></tbody></table></div>
		<div class="Text">
		    <big></big>
		    <small></small>
		    <div class="in">
		        <big></big>
		        <small></small>
		    </div>
		</div>
    </div>
    <div class="oT2 typAlbumEdit"><table><tbody>
        <tr>
            <td><span>Надпись 1:</span></td>
            <td>
                <div class="inputText"><i><b><input type="text" name="text1"/></b></i></div>
            </td>
        </tr>
        <tr>
            <td><span>Надпись 2:</span></td>
            <td>
                <div class="textarea"><i><b><textarea name="text2" cols="30" rows="10" style="height:50px;"></textarea></b></i></div>
            </td>
        </tr>
        <tr>
            <td><span>Ссылка:</span></td>
            <td>
                <div class="inputText"><i><b><input type="text" name="link"/></b></i></div>
                <div class="Example">Внешняя: http://google.com<br/>Внутренняя: news/21</div>
            </td>
        </tr>
        <tr>
            <td class="empty">&nbsp;</td>
            <td><div class="Buttons">
                <div class="oBut Big green save"><input type="submit" value="Создать баннер"/></div>
                <div class="oBut Big cancel"><input type="submit" value="Отмена"/></div>
            </div></td>
        </tr>
    </tbody></table></div>
</form>