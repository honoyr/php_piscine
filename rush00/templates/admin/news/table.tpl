<table>
    <thead><tr>
        <td colspan="2">Действия</td>
        <td>Новость</td>
        <td><span class="sortable">Дата</span><i class="sort down"><b>&nbsp;</b></i></td>
    </tr></thead>
    <tbody>
    <!-- BEGIN news -->
	<tr>
	    <td><div class="actions">
	        <a href="admin/news/edit/{news.ID}" class="edit" title="Редактировать"><i>Редактировать</i></a>
	        <a href="admin/news/disable/{news.ID}" class="show" title="Скрыть с сайта" <!-- BEGIN news.disabled -->style="display:none;"<!-- END news.disabled -->><i>Скрыть с сайта</i></a>
	        <a href="admin/news/enable/{news.ID}" class="hide" title="Показывать на сайте"<!-- BEGIN news.enabled -->style="display:none;"<!-- END news.enabled -->><i>Показывать на сайте</i></a>
	        <a href="admin/news/delete/{news.ID}" class="del" title="Удалить"><i>Удалить</i></a>
	    </div></td>
	    <td class="expand">
	        <div><i class="toOpen" title="Развернуть" rel="admin/news/expand/{news.ID}"><b>&nbsp;</b></i></div>
	    </td>
	    <td>{news.NAME}</td>
	    <td>{news.DATE}</td>
	</tr>
    <!-- END news -->
    </tbody>
</table>
<!-- BEGIN paginator -->
<div class="oExtPager">
    <div class="PrevNext" style="display:none">
        <!-- BEGIN paginator.prev --><a href="admin/news/page/{paginator.prev.NUM}" class="Prev">&larr; Назад</a><!-- END paginator.prev -->
        <!-- BEGIN paginator.prev_empty --><span class="Prev">&larr; Назад</span><!-- END paginator.prev_empty -->
        <!-- BEGIN paginator.next --><a href="admin/news/page/{paginator.next.NUM}" class="Next">Вперёд &rarr;</a><!-- END paginator.next -->
        <!-- BEGIN paginator.next_empty --><span class="Next">Вперёд &rarr;</span><!-- END paginator.next_empty -->
    </div>
    <div class="oPager">
        <!-- BEGIN paginator.first --><a href="admin/news/page/{paginator.first.NUM}">{paginator.first.NUM}</a><!-- END paginator.first -->
        <!-- BEGIN paginator.separator1 --><ins>…</ins><!-- END paginator.separator1 -->
        <!-- BEGIN paginator.middle1 --><a href="admin/news/page/{paginator.middle1.NUM}">{paginator.middle1.NUM}</a><!-- END paginator.middle1 -->
        <!-- BEGIN paginator.current --><i>{paginator.current.NUM}</i><!-- END paginator.current -->
        <!-- BEGIN paginator.middle2 --><a href="admin/news/page/{paginator.middle2.NUM}">{paginator.middle2.NUM}</a><!-- END paginator.middle2 -->
        <!-- BEGIN paginator.separator2 --><ins>…</ins><!-- END paginator.separator2 -->
        <!-- BEGIN paginator.last --><a href="admin/news/page/{paginator.last.NUM}">{paginator.last.NUM}</a><!-- END paginator.last -->
    </div>
</div>
<!-- END paginator -->
<input type="hidden" name="currentUrl" value="admin/news/page/{CURRENT_PAGE}"/>