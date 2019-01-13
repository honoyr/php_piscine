<div class="oEditItem">
    <form action="admin/user/add" method="post" enctype="multipart/form-data"><div class="oT2"><table><tbody>
    <tr>
        <td><span>Имя:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="name"/></b></i></div>
            <!-- BEGIN error_name --><div class="error">{error_name.MESSAGE}</div><!-- END error_name -->
        </td>
    </tr>
    <tr>
        <td><span>Логин/email:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="email"/></b></i></div>
            <!-- BEGIN error_email --><div class="error">{error_email.MESSAGE}</div><!-- END error_email -->
        </td>
    </tr>
    <tr>
        <td><span>Пароль:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="passwd" autocomplete="off"/></b></i></div>
            <!-- BEGIN error_passwd --><div class="error">{error_passwd.MESSAGE}</div><!-- END error_passwd -->
        </td>
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
            <a href="javascript:;" class="save">Добавить</a>
            <a href="javascript:;" class="cancel">Отмена</a>
        </div></td>
    </tr>
    </tbody></table></div></form>
</div>