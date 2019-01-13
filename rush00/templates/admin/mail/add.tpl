<div class="oEditItem">
    <form action="admin/mail/add" method="post" enctype="multipart/form-data"><div class="oT2"><table><tbody>
    <tr>
        <td><span>Логин:</span></td>
        <td><div class="inputText" style="float:left;width:200px"><i><b><input type="text" name="login"/></b></i></div>
            <div style="float:left">@{MAIL_DOMAIN}</div>
            <!-- BEGIN error_login --><div class="error">{error_login.MESSAGE}</div><!-- END error_login -->
        </td>
    </tr>
    <tr>
        <td><span>Пароль:</span></td>
        <td><div class="inputText" style="width:200px"><i><b><input type="text" name="password"/></b></i></div>
            <!-- BEGIN error_password --><div class="error">{error_password.MESSAGE}</div><!-- END error_password -->
        </td>
    </tr>
    <tr>
        <td class="empty">&nbsp;</td>
        <td><div class="oActButtons">
            <a href="javascript:;" class="save">Создать ящик</a>
            <a href="javascript:;" class="cancel">Отмена</a>
        </div></td>
    </tr>
    </tbody></table></div></form>
</div>