<div class="oEditItem">
    <form action="admin/menu/add" method="post"><div class="oT2"><table><tbody>
    <tr>
        <td><span>Название:</span></td>
        <td><div class="inputText"><i><b><input type="text" name="title"/></b></i></div>
            <!-- BEGIN error_title --><div class="error">{error_title.MESSAGE}</div><!-- END error_title -->
        </td>
    </tr>
    <tr>
        <td><span>Ссылка:</span></td>
        <td>
            <div class="inputText"><i><b><input type="text" name="link"/></b></i></div>
            <!-- BEGIN error_link --><div class="error">{error_link.MESSAGE}</div><!-- END error_link -->
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