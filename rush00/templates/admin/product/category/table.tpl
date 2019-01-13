<table class="list" id="list" rel="main"><tbody>
    <!-- BEGIN category -->
    <tr id="{category.ID}">
        <td class="move move_main" title="Переместить"><i>&nbsp;</i></td>
        <td><div class="actions">
            <a href="admin/product/category/edit/{category.ID}" class="edit" title="Редактировать"><i>Редактировать</i></a>
            <a href="admin/product/category/disable/{category.ID}" class="show" title="Скрыть с сайта" <!-- BEGIN category.disabled -->style="display:none;"<!-- END category.disabled -->><i>Скрыть с сайта</i></a>
            <a href="admin/product/category/enable/{category.ID}" class="hide" title="Показывать на сайте"<!-- BEGIN category.enabled -->style="display:none;"<!-- END category.enabled -->><i>Показывать на сайте</i></a>
            <a href="admin/product/category/delete/{category.ID}" class="del" title="Удалить"><i>Удалить</i></a>
        </div></td>
        <td>
            <div class="parent">
                <div class="name iName"><a href="admin/product/{category.ID}">{category.NAME}</a></div>
            </div>
            <!-- BEGIN category.has_child -->
            <div class="slaves">
                <div class="master oEditor">
                    <table class="list" id="list" rel="sub"><tbody>
                        <!-- BEGIN category.sub -->
                        <tr id="{category.sub.ID}">
                            <td class="move move_sub" title="Переместить"><i>&nbsp;</i></td>
                            <td><div class="actions">
                                <a href="admin/product/category/edit/{category.sub.ID}" class="edit" title="Редактировать"><i>Редактировать</i></a>
                                <a href="admin/product/category/disable/{category.sub.ID}" class="show" title="Скрыть с сайта" <!-- BEGIN category.sub.disabled -->style="display:none;"<!-- END category.sub.disabled -->><i>Скрыть с сайта</i></a>
                                <a href="admin/product/category/enable/{category.sub.ID}" class="hide" title="Показывать на сайте"<!-- BEGIN category.sub.enabled -->style="display:none;"<!-- END category.sub.enabled -->><i>Показывать на сайте</i></a>
                                <a href="admin/product/category/delete/{category.sub.ID}" class="del" title="Удалить"><i>Удалить</i></a>
                            </div></td>
                            <td>
                                <div class="parent">
                                    <div class="name iName"><a href="admin/product/{category.sub.ID}">{category.sub.NAME}</a></div>
                                </div>
                                <!-- BEGIN category.sub.has_child -->
                                <div class="slaves">
                                    <div class="master oEditor">
                                        <table class="list" id="list" rel="subsub"><tbody>
                                            <!-- BEGIN category.sub.far -->
                                            <tr id="{category.sub.far.ID}">
                                                <td class="move move_subsub" title="Переместить"><i>&nbsp;</i></td>
                                                <td><div class="actions">
                                                    <a href="admin/product/category/edit/{category.sub.far.ID}" class="edit" title="Редактировать"><i>Редактировать</i></a>
                                                    <a href="admin/product/category/disable/{category.sub.far.ID}" class="show" title="Скрыть с сайта" <!-- BEGIN category.sub.far.disabled -->style="display:none;"<!-- END category.sub.far.disabled -->><i>Скрыть с сайта</i></a>
                                                    <a href="admin/product/category/enable/{category.sub.far.ID}" class="hide" title="Показывать на сайте"<!-- BEGIN category.sub.far.enabled -->style="display:none;"<!-- END category.sub.far.enabled -->><i>Показывать на сайте</i></a>
                                                    <a href="admin/product/category/delete/{category.sub.far.ID}" class="del" title="Удалить"><i>Удалить</i></a>
                                                </div></td>
                                                <td>
                                                    <div class="parent">
                                                        <div class="name iName"><a href="admin/product/{category.sub.far.ID}">{category.sub.far.NAME}</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- END category.sub.far -->
                                        </tbody></table>
                                    </div>
                                </div>
                                <!-- END category.sub.has_child -->
                                <div class="oActButtons"><a href="admin/product/category/add/{category.sub.ID}" class="add">Добавить подкатегорию</a></div>
                            </td>
                        </tr>
                        <!-- END category.sub -->
                    </tbody></table>
                </div>
            </div>
            <!-- END category.has_child -->
            <div class="oActButtons"><a href="admin/product/category/add/{category.ID}" class="add">Добавить подкатегорию</a></div>
        </td>
    </tr>
    <!-- END category -->
</tbody></table>