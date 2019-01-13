<table>
    <thead><tr>
        <td colspan="2">Действия</td>
        <td>Картинка</td>
        <td>Название</td>
        <td>Описание</td>
    </tr></thead>
    <tbody>
    <!-- BEGIN theme -->
	<tr>
	    <td><div class="actions">
            <a href="admin/theme/set/{theme.ID}" class="launch" title="Установить"><i>Установить</i></a>
	        <a href="admin/theme/edit/{theme.ID}" class="edit" title="Редактировать"><i>Редактировать</i></a>
	        <a href="admin/theme/delete/{theme.ID}" class="del" title="Удалить"><i>Удалить</i></a>
	    </div></td>
	    <td class="expand">
	        <div><i class="toOpen" title="Развернуть" rel="admin/theme/expand/{theme.ID}"><b>&nbsp;</b></i></div>
	    </td>
        <td><!-- BEGIN theme.picture --><img src="images/themes/{theme.picture.SRC}" alt="" /></div><!-- END theme.picture --></td>
        <td class="iName">{theme.NAME}</td>
	    <td>{theme.DESCRIPTION}</td>
	</tr>
    <!-- END theme -->
    </tbody>
</table>
<!-- BEGIN paginator -->
<div class="oExtPager">
    <div class="PrevNext" style="display:none">
        <!-- BEGIN paginator.prev --><a href="admin/theme/page/{paginator.prev.NUM}" class="Prev">&larr; Назад</a><!-- END paginator.prev -->
        <!-- BEGIN paginator.prev_empty --><span class="Prev">&larr; Назад</span><!-- END paginator.prev_empty -->
        <!-- BEGIN paginator.next --><a href="admin/theme/page/{paginator.next.NUM}" class="Next">Вперёд &rarr;</a><!-- END paginator.next -->
        <!-- BEGIN paginator.next_empty --><span class="Next">Вперёд &rarr;</span><!-- END paginator.next_empty -->
    </div>
    <div class="oPager">
        <!-- BEGIN paginator.first --><a href="admin/theme/page/{paginator.first.NUM}">{paginator.first.NUM}</a><!-- END paginator.first -->
        <!-- BEGIN paginator.separator1 --><ins>…</ins><!-- END paginator.separator1 -->
        <!-- BEGIN paginator.middle1 --><a href="admin/theme/page/{paginator.middle1.NUM}">{paginator.middle1.NUM}</a><!-- END paginator.middle1 -->
        <!-- BEGIN paginator.current --><i>{paginator.current.NUM}</i><!-- END paginator.current -->
        <!-- BEGIN paginator.middle2 --><a href="admin/theme/page/{paginator.middle2.NUM}">{paginator.middle2.NUM}</a><!-- END paginator.middle2 -->
        <!-- BEGIN paginator.separator2 --><ins>…</ins><!-- END paginator.separator2 -->
        <!-- BEGIN paginator.last --><a href="admin/theme/page/{paginator.last.NUM}">{paginator.last.NUM}</a><!-- END paginator.last -->
    </div>
</div>
<!-- END paginator -->
<input type="hidden" name="currentUrl" value="admin/theme/page/{CURRENT_PAGE}"/>