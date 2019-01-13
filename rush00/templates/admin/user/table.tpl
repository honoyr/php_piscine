<table>
    <thead><tr>
        <td>Действия</td>
        <td><span class="sortable">Имя</span><i class="sort up"><b>&nbsp;</b></i></td>
        <td><span class="sortable">Логин/email</span><i class="sort"><b>&nbsp;</b></i></td>
        <td>Роль</td>
    </tr></thead>
    <tbody><!-- BEGIN user -->
	<tr>
	    <td><div class="actions">
	        <a href="admin/user/edit/{user.ID}" class="edit" title="Редактировать"><i>Редактировать</i></a>
	        <a href="admin/user/delete/{user.ID}" class="del" title="Удалить пользователя"><i>Удалить пользователя</i></a>
	    </div></td>
	    <td class="iName">{user.NAME}</td>
	    <td>{user.EMAIL}</td>
	    <td>{user.ROLE}</td>
	</tr>
	<!-- END user -->
	</tbody>
</table>