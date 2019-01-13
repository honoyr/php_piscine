<form action="admin/stuff/logo/add" method="post">
<!-- BEGIN no_img -->
<div class="addImage">
    <span class="oFileLink add"><i>Прикрепить</i><input type="file" name="file" size="40" rel="admin/stuff/logo/add"/></span>
</div>
<!-- END no_img -->
<!-- BEGIN img -->
<div class="changeImage">
    <img src="images/logo/logo.png?rand={RAND}" alt="" title="" style="border:1px solid gray;padding:3px;" />
    <span class="oFileLink add"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/stuff/logo/add"/></span>
    <span class="oFileLink delete" rel="admin/stuff/logo/delete"><i>Удалить</i></span>
</div>
<!-- END img -->

<!-- BEGIN error_file --><div class="error">{error_file.MESSAGE}</div><!-- END error_file -->
</form>