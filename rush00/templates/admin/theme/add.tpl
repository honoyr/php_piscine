<div class="oEditItem">
    <form action="admin/theme/add" method="post" enctype="multipart/form-data"><div class="oT2"><table><tbody>
    <tr>
        <td><span>Название:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="name"/></b></i></div>
            <!-- BEGIN error_name --><div class="error">{error_name.MESSAGE}</div><!-- END error_name -->
        </td>
    </tr>
    <tr>
        <td><span>Картинка:</span></td>
        <td>
            <div class="Picture">
                <!-- BEGIN no_picture -->
                <div class="addImage">
                    <span class="oFileLink"><i>Прикрепить</i><input type="file" name="file" size="40" rel="admin/theme/picture"/></span>
                </div>
                <!-- END no_picture -->
                <!-- BEGIN picture -->
                <div class="changeImage">
                    <img src="images/themes/temp/{picture.KEY}" alt="" title="" width="180" />
                    <span class="oFileLink"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/theme/picture"/></span>
                </div>
                <!-- END picture -->
                <input type="hidden" name="pictureKey" default=""/>
            </div>
        </td>
    </tr>
    <tr>
        <td><span>Описание:</span></td>
        <td><div class="textarea"><i><b><textarea name="description" cols="30" rows="10" style="height:100px;"></textarea></b></i></div>
            <!-- BEGIN error_description --><div class="error">{error_description.MESSAGE}</div><!-- END error_description -->
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