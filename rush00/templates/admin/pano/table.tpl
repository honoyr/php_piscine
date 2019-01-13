<table id="list">
    <thead><tr class="nodrop nodrag">
        <td colspan="2">Действия</td>
        <td>Баннер</td>
    </tr></thead>
    <tbody>
    <!-- BEGIN pano -->
    <tr id="{pano.ID}">
        <td class="move" title="Передвинуть"><i>&nbsp;</i></td>
        <td><div class="actions">
            <a href="admin/pano/edit/{pano.ID}" class="edit" title="Редактировать"><i>Редактировать</i></a>
            <a href="admin/pano/disable/{pano.ID}" class="show" title="Скрыть" <!-- BEGIN pano.disabled -->style="display:none;"<!-- END pano.disabled -->><i>Скрыть</i></a>
            <a href="admin/pano/enable/{pano.ID}" class="hide" title="Показывать на сайте"<!-- BEGIN pano.enabled -->style="display:none;"<!-- END pano.enabled -->><i>Показать</i></a>
            <a href="admin/pano/delete/{pano.ID}" class="del" title="Удалить"><i>Удалить</i></a>
        </div></td>
        <td>
            <div class="TopNew">
		        <div class="Images"><table><tbody><tr>
		            <td><img src="images/pano/{pano.FILE}" alt="" title="" /></td>
		        </tr></tbody></table></div>
		        <div class="Text">
		            <big>{pano.TEXT1}</big>
		            <small>{pano.TEXT2}</small>
		            <div class="in">
		                <big>{pano.TEXT1}</big>
		                <small>{pano.TEXT2}</small>
		            </div>
		        </div>
		        <!-- BEGIN pano.link --><div class="Link"><a href="{pano.LINK}">&nbsp;</a></div><!-- END pano.link -->
		    </div>
        </td>
    </tr>
    <!-- END pano -->
    </tbody>
</table>
<!-- BEGIN paginator -->
<div class="oExtPager">
    <div class="PrevNext">
        <!-- BEGIN paginator.prev --><a href="admin/pano/page/{paginator.prev.NUM}" class="Prev">&larr; Назад</a><!-- END paginator.prev -->
        <!-- BEGIN paginator.prev_empty --><span class="Prev">&larr; Назад</span><!-- END paginator.prev_empty -->
        <!-- BEGIN paginator.next --><a href="admin/pano/page/{paginator.next.NUM}" class="Next">Вперёд &rarr;</a><!-- END paginator.next -->
        <!-- BEGIN paginator.next_empty --><span class="Next">Вперёд &rarr;</span><!-- END paginator.next_empty -->
    </div>
    <div class="oPager">
        <!-- BEGIN paginator.first --><a href="admin/pano/page/{paginator.first.NUM}">{paginator.first.NUM}</a><!-- END paginator.first -->
        <!-- BEGIN paginator.separator1 --><ins>…</ins><!-- END paginator.separator1 -->
        <!-- BEGIN paginator.middle1 --><a href="admin/pano/page/{paginator.middle1.NUM}">{paginator.middle1.NUM}</a><!-- END paginator.middle1 -->
        <!-- BEGIN paginator.current --><i>{paginator.current.NUM}</i><!-- END paginator.current -->
        <!-- BEGIN paginator.middle2 --><a href="admin/pano/page/{paginator.middle2.NUM}">{paginator.middle2.NUM}</a><!-- END paginator.middle2 -->
        <!-- BEGIN paginator.separator2 --><ins>…</ins><!-- END paginator.separator2 -->
        <!-- BEGIN paginator.last --><a href="admin/pano/page/{paginator.last.NUM}">{paginator.last.NUM}</a><!-- END paginator.last -->
    </div>
</div>
<!-- END paginator -->
<input type="hidden" name="currentUrl" value="admin/pano/table/page/{CURRENT_PAGE}"/>