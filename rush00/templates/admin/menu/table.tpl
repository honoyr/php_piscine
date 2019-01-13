<table id="list">
    <thead><tr class="nodrop nodrag">
        <td colspan="2">Действия</td>
        <td>Название</td>
        <td>Ссылка</td>
    </tr></thead>
    <tbody>
    <!-- BEGIN menu -->
	<tr id="{menu.ID}">
	    <td class="move" title="Передвинуть"><i>&nbsp;</i></td>
	    <td><div class="actions">
	        <a href="admin/menu/edit/{menu.ID}" class="edit" title="Редактировать пункт меню"><i>Редактировать пункт меню</i></a>
	        <a href="admin/menu/disable/{menu.ID}" class="show" title="Скрыть" <!-- BEGIN menu.disabled -->style="display:none;"<!-- END menu.disabled -->><i>Скрыть</i></a>
	        <a href="admin/menu/enable/{menu.ID}" class="hide" title="Показывать на сайте"<!-- BEGIN menu.enabled -->style="display:none;"<!-- END menu.enabled -->><i>Показать</i></a>
	        <a href="admin/menu/delete/{menu.ID}" class="del" title="Удалить пункт меню"><i>Удалить пункт меню</i></a>
	    </div></td>
	    <td class="iName">{menu.TITLE}</td>
	    <td><a href="{menu.LINK}">{menu.LINK}</a></td>
	</tr>
	<!-- END menu -->
	</tbody>
</table>