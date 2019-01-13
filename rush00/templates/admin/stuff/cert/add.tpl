<form action="admin/stuff/cert/add/{NUM}" method="post">
<!-- BEGIN no_img -->
<div class="addImage">
    <span class="oFileLink add"><i>Прикрепить</i><input type="file" name="file" size="40" rel="admin/stuff/cert/add/{NUM}"/></span>
</div>
<!-- END no_img -->
<!-- BEGIN img -->
<div class="changeImage">
    <img src="images/cert/s/{NUM}.jpg?rand={RAND}" alt="" title="" />
    <span class="oFileLink add"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/stuff/cert/add/{NUM}"/></span>
    <span class="oFileLink delete" rel="admin/stuff/cert/delete/{NUM}"><i>Удалить</i></span>
</div>
<!-- END img -->

<!-- BEGIN error_file --><div class="error">{error_file.MESSAGE}</div><!-- END error_file -->
</form>