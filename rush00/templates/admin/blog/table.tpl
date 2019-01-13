<table>
    <thead><tr>
        <td colspan="2">Действия</td>
        <td>Заголовок</td>
        <td><span class="sortable">Дата</span><i class="sort down"><b>&nbsp;</b></i></td>
    </tr></thead>
    <tbody>
    <!-- BEGIN blog -->
	<tr>
	    <td><div class="actions">
	        <a href="admin/blog/edit/{blog.ID}" class="edit" title="Редактировать"><i>Редактировать</i></a>
	        <a href="admin/blog/disable/{blog.ID}" class="show" title="Скрыть с сайта" <!-- BEGIN blog.disabled -->style="display:none;"<!-- END blog.disabled -->><i>Скрыть с сайта</i></a>
	        <a href="admin/blog/enable/{blog.ID}" class="hide" title="Показывать на сайте"<!-- BEGIN blog.enabled -->style="display:none;"<!-- END blog.enabled -->><i>Показывать на сайте</i></a>
	        <a href="admin/blog/delete/{blog.ID}" class="del" title="Удалить"><i>Удалить</i></a>
	    </div></td>
	    <td class="expand">
	        <div><i class="toOpen" title="Развернуть" rel="admin/blog/expand/{blog.ID}"><b>&nbsp;</b></i></div>
	    </td>
        <td>{blog.NAME}</td>
	    <td class="date">{blog.DATE}</td>
	</tr>
    <!-- END blog -->
    </tbody>
</table>
<!-- BEGIN paginator -->
<div class="oExtPager">
    <div class="PrevNext" style="display:none">
        <!-- BEGIN paginator.prev --><a href="admin/blog/page/{paginator.prev.NUM}" class="Prev">&larr; Назад</a><!-- END paginator.prev -->
        <!-- BEGIN paginator.prev_empty --><span class="Prev">&larr; Назад</span><!-- END paginator.prev_empty -->
        <!-- BEGIN paginator.next --><a href="admin/blog/page/{paginator.next.NUM}" class="Next">Вперёд &rarr;</a><!-- END paginator.next -->
        <!-- BEGIN paginator.next_empty --><span class="Next">Вперёд &rarr;</span><!-- END paginator.next_empty -->
    </div>
    <div class="oPager">
        <!-- BEGIN paginator.first --><a href="admin/blog/page/{paginator.first.NUM}">{paginator.first.NUM}</a><!-- END paginator.first -->
        <!-- BEGIN paginator.separator1 --><ins>…</ins><!-- END paginator.separator1 -->
        <!-- BEGIN paginator.middle1 --><a href="admin/blog/page/{paginator.middle1.NUM}">{paginator.middle1.NUM}</a><!-- END paginator.middle1 -->
        <!-- BEGIN paginator.current --><i>{paginator.current.NUM}</i><!-- END paginator.current -->
        <!-- BEGIN paginator.middle2 --><a href="admin/blog/page/{paginator.middle2.NUM}">{paginator.middle2.NUM}</a><!-- END paginator.middle2 -->
        <!-- BEGIN paginator.separator2 --><ins>…</ins><!-- END paginator.separator2 -->
        <!-- BEGIN paginator.last --><a href="admin/blog/page/{paginator.last.NUM}">{paginator.last.NUM}</a><!-- END paginator.last -->
    </div>
</div>
<!-- END paginator -->
<input type="hidden" name="currentUrl" value="admin/blog/page/{CURRENT_PAGE}"/>