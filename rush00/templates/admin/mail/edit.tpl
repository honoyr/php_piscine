<form action="admin/mail/edit/{ID}" method="post" enctype="multipart/form-data">
<div class="oT2">
<table><tbody>
    <tr>
        <td><span>Пароль:</span></td>
        <td><div class="inputText" style="width:200px"><i><b><input type="text" name="password"/></b></i></div>
            <!-- BEGIN error_password --><div class="error">{error_password.MESSAGE}</div><!-- END error_password -->
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