<form action="admin/user/edit/{ID}" method="post" enctype="multipart/form-data">
<div class="oT2">
<table><tbody>
    <tr><td colspan="2"><h3>Редактирование данных пользователя</h3></td></tr>
    <tr>
        <td><span>Имя:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="name"/></b></i></div>
            <!-- BEGIN error_name --><div class="error">{error_name.MESSAGE}</div><!-- END error_name -->
        </td>
    </tr>
    <tr>
        <td><span>Логин/email:</span></td>
        <td><span>{EMAIL}</span></td>
    </tr>
    <tr>
        <td><span>Пароль:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="passwd" autocomplete="off"/></b></i></div></td>
    </tr>
    <tr>
        <td><span>Роль:</span></td>
        <td><div class="select"><i><b><u><select name="role"><option value=""></option><option value="admin">admin</option></select></u></b></i></div>
            <!-- BEGIN error_role --><div class="error">{error_role.MESSAGE}</div><!-- END error_role -->
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