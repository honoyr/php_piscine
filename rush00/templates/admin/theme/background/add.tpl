<form action="admin/theme/background/add/{KEY}" method="post">
<!-- BEGIN no_img -->
<div class="addImage">
    <span class="oFileLink add"><i>Прикрепить</i><input type="file" name="file" size="40" rel="admin/theme/background/add/{KEY}"/></span>
</div>
<!-- END no_img -->
<!-- BEGIN img -->
<div class="changeImage">
    <img src="images/background/{KEY}.png?rand={RAND}" alt="" title="" style="border:1px solid gray;padding:3px;" />
    <span class="oFileLink add"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/theme/background/add/{KEY}"/></span>
    <span class="oFileLink delete" rel="admin/theme/background/delete/{KEY}"><i>Удалить</i></span>
</div>
<!-- END img -->

<!-- BEGIN error_file --><div class="error">{error_file.MESSAGE}</div><!-- END error_file -->
</form>