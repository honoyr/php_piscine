<table>
    <thead><tr>
        <td colspan="1">Действия</td>
        <td>Название</td>
    </tr></thead>
    <tbody>
    <!-- BEGIN mail -->
	<tr>
	    <td><div class="actions">
            <a href="http://mail.yandex.ru/for/{MAIL_DOMAIN}" target="_blank" class="enter" title="Войти в почту"><i>Войти в почту</i></a>
	        <a href="admin/mail/edit/{mail.ID}" class="edit" title="Редактировать"><i>Редактировать</i></a>
	        <a href="admin/mail/delete/{mail.ID}" class="del" title="Удалить"><i>Удалить</i></a>
	    </div></td>
        <td class="iName">{mail.NAME}@{MAIL_DOMAIN}</td>
	</tr>
    <!-- END mail -->
    </tbody>
</table>
<!-- BEGIN paginator -->
<div class="oExtPager">
    <div class="PrevNext" style="display:none">
        <!-- BEGIN paginator.prev --><a href="admin/mail/page/{paginator.prev.NUM}" class="Prev">&larr; Назад</a><!-- END paginator.prev -->
        <!-- BEGIN paginator.prev_empty --><span class="Prev">&larr; Назад</span><!-- END paginator.prev_empty -->
        <!-- BEGIN paginator.next --><a href="admin/mail/page/{paginator.next.NUM}" class="Next">Вперёд &rarr;</a><!-- END paginator.next -->
        <!-- BEGIN paginator.next_empty --><span class="Next">Вперёд &rarr;</span><!-- END paginator.next_empty -->
    </div>
    <div class="oPager">
        <!-- BEGIN paginator.first --><a href="admin/mail/page/{paginator.first.NUM}">{paginator.first.NUM}</a><!-- END paginator.first -->
        <!-- BEGIN paginator.separator1 --><ins>…</ins><!-- END paginator.separator1 -->
        <!-- BEGIN paginator.middle1 --><a href="admin/mail/page/{paginator.middle1.NUM}">{paginator.middle1.NUM}</a><!-- END paginator.middle1 -->
        <!-- BEGIN paginator.current --><i>{paginator.current.NUM}</i><!-- END paginator.current -->
        <!-- BEGIN paginator.middle2 --><a href="admin/mail/page/{paginator.middle2.NUM}">{paginator.middle2.NUM}</a><!-- END paginator.middle2 -->
        <!-- BEGIN paginator.separator2 --><ins>…</ins><!-- END paginator.separator2 -->
        <!-- BEGIN paginator.last --><a href="admin/mail/page/{paginator.last.NUM}">{paginator.last.NUM}</a><!-- END paginator.last -->
    </div>
</div>
<!-- END paginator -->
<input type="hidden" name="currentUrl" value="admin/mail/page/{CURRENT_PAGE}"/>