<table id="list">
    <thead><tr class="nodrop nodrag">
        <td colspan="3">Действия</td>
        <td>Имя</td>
        <td width="100">Фото</td>
        <td>Телефон</td>
        <td>Город</td>
        <td>Должность</td>
        <td>Сайт</td>
        <td><span class="sortable">Дата</span><i class="sort down"><b>&nbsp;</b></i></td>
    </tr></thead>
    <tbody>
    <!-- BEGIN testimonial -->
    <tr id="{testimonial.ID}">
        <td class="move" title="Передвинуть"><i>&nbsp;</i></td>
        <td><div class="actions">
            <a href="admin/testimonial/edit/{testimonial.ID}" class="edit" title="Редактировать"><i>Редактировать</i></a>
            <a href="admin/testimonial/disable/{testimonial.ID}" class="show" title="Скрыть с сайта" <!-- BEGIN testimonial.disabled -->style="display:none;"<!-- END testimonial.disabled -->><i>Скрыть с сайта</i></a>
            <a href="admin/testimonial/enable/{testimonial.ID}" class="hide" title="Показывать на сайте"<!-- BEGIN testimonial.enabled -->style="display:none;"<!-- END testimonial.enabled -->><i>Показывать на сайте</i></a>
	        <a href="admin/testimonial/delete/{testimonial.ID}" class="del" title="Удалить сообщение"><i>Удалить сообщение</i></a>
	    </div></td>
	    <td class="expand">
	        <div><i class="toOpen" title="Развернуть" rel="admin/testimonial/expand/{testimonial.ID}"><b>&nbsp;</b></i></div>
	    </td>
	    <td><!-- BEGIN testimonial.picture --><img src="images/people/s/{testimonial.picture.SRC}" alt=""/><!-- END testimonial.picture --></td>
        <td class="iName date"><ins>{testimonial.NAME}</ins></td>
        <td class="nowrap">{testimonial.PHONE}</td>
        <td>{testimonial.CITY}</td>
        <td class="nowrap">{testimonial.DUTIES}</td>
        <td><!-- BEGIN testimonial.website --><a href="http://{testimonial.WEBSITE}" target="_blank">{testimonial.WEBSITE}</a><!-- END testimonial.website --></td>
	    <td class="date"><ins>{testimonial.DATE}</ins></td>
	</tr>
	<!-- END testimonial -->
    </tbody>
</table>
<!-- BEGIN paginator -->
<div class="oPager">
    <!-- BEGIN paginator.first --><a href="admin/testimonial/page/{paginator.first.NUM}">{paginator.first.NUM}</a><!-- END paginator.first -->
    <!-- BEGIN paginator.separator1 --><ins>...</ins><!-- END paginator.separator1 -->
    <!-- BEGIN paginator.middle1 --><a href="admin/testimonial/page/{paginator.middle1.NUM}">{paginator.middle1.NUM}</a><!-- END paginator.middle1 -->
    <!-- BEGIN paginator.current --><i>{paginator.current.NUM}</i><!-- END paginator.current -->
    <!-- BEGIN paginator.middle2 --><a href="admin/testimonial/page/{paginator.middle2.NUM}">{paginator.middle2.NUM}</a><!-- END paginator.middle2 -->
    <!-- BEGIN paginator.separator2 --><ins>...</ins><!-- END paginator.separator2 -->
    <!-- BEGIN paginator.last --><a href="admin/testimonial/page/{paginator.last.NUM}">{paginator.last.NUM}</a><!-- END paginator.last -->
</div>
<!-- END paginator -->