<table>
    <thead><tr>
        <td colspan="2">Действия</td>
        <td><span class="sortable">Заголовок</span><i class="sort up"><b>&nbsp;</b></i></td>
        <td><span>Ссылка</span></td>
    </tr></thead>
    <tbody>
    <!-- BEGIN page -->
	<tr>
	    <td><div class="actions">
	        <a href="admin/page/edit/{page.ID}" class="edit" title="Редактировать страницу"><i>Редактировать страницу</i></a>
	        <a href="admin/page/delete/{page.ID}" class="del" title="Удалить страницу"><i>Удалить страницу</i></a>
	    </div></td>
	    <td class="expand">
	        <div><i class="toOpen" title="Развернуть" rel="admin/page/expand/{page.ID}"><b>&nbsp;</b></i></div>
	    </td>
	    <td class="iName">{page.TITLE}</td>
	    <td><a href="{page.NAME}">{page.NAME}</a></td>
	</tr>
	<!-- END page -->
	</tbody>
</table>