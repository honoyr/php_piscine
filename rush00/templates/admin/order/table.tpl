<table>
    <thead><tr>
        <td colspan="2">Действия</td>
        <td>Имя</td>
        <td>Телефон</td>
        <td>E-mail</td>
        <td>Товар</td>
        <td style="display:none;">Статус</td>
        <td><span class="sortable">Дата</span><i class="sort down"><b>&nbsp;</b></i></td>
    </tr></thead>
    <tbody>
    <!-- BEGIN order -->
	<tr>
	    <td><div class="actions">
	        <a href="admin/order/delete/{order.ID}" class="del" title="Удалить сообщение"><i>Удалить сообщение</i></a>
	    </div></td>
	    <td class="expand">
	        <div><i class="toOpen" title="Развернуть" rel="admin/order/expand/{order.ID}"><b>&nbsp;</b></i></div>
	    </td>
	    <td class="iName date"><ins>{order.NAME}</ins></td>
        <td>{order.PHONE}</td>
        <td>{order.EMAIL}</td>
        <td>{order.PRODUCT}</td>
        <td style="display:none;">{order.STEP}<br/>{order.STATUS}</td>
	    <td class="date"><ins>{order.DATE}</ins></td>
	</tr>
	<!-- END order -->
    </tbody>
</table>
<!-- BEGIN paginator -->
<div class="oPager">
    <!-- BEGIN paginator.first --><a href="admin/order/page/{paginator.first.NUM}">{paginator.first.NUM}</a><!-- END paginator.first -->
    <!-- BEGIN paginator.separator1 --><ins>...</ins><!-- END paginator.separator1 -->
    <!-- BEGIN paginator.middle1 --><a href="admin/order/page/{paginator.middle1.NUM}">{paginator.middle1.NUM}</a><!-- END paginator.middle1 -->
    <!-- BEGIN paginator.current --><i>{paginator.current.NUM}</i><!-- END paginator.current -->
    <!-- BEGIN paginator.middle2 --><a href="admin/order/page/{paginator.middle2.NUM}">{paginator.middle2.NUM}</a><!-- END paginator.middle2 -->
    <!-- BEGIN paginator.separator2 --><ins>...</ins><!-- END paginator.separator2 -->
    <!-- BEGIN paginator.last --><a href="admin/order/page/{paginator.last.NUM}">{paginator.last.NUM}</a><!-- END paginator.last -->
</div>
<!-- END paginator -->