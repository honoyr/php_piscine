<!-- INCLUDE admin/header.tpl -->
<script type="text/javascript" src="scripts/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="styles/admin/jquery.Jcrop.css" type="text/css" />
<script type="text/javascript">
var tableCols = 4;
var pageKey  = "news/banner"; 
var pageClass  = ".NutManage";
var message = {
    notice : {
	    added  :'Добавлен новый баннер',
	    edited :'Баннер успешно отредактирован',
        deleted:'Баннер успешно удален'
    },
    confirm : {
        deleting:'Вы действительно хотите удалить этот баннер?'
    }
};
</script>
<script type="text/javascript" src="scripts/admin/table.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Таблица
    initTable();
    // Добавить баннер
    $("."+pageClass+" .oAddList a.add").click(function(){
        ajaxloader.show();
        var button = $(this);
        var actionBlock = $("#action").css({
            'position' : 'absolute',
            'top':(getBodyScrollTop()+100)+'px'
        });
        $(".container",actionBlock).load(button.attr('href'),{},function(){
            actionBlock.fadeIn(300);
            initImageForm(actionBlock);
            ajaxloader.hide();
        });
        return false;
    });
});
// Сабмит формы добавления
var initImageForm = function(actionBlock){
    var container = $(".container",actionBlock);
    var width = 990;
    actionBlock.css({
        'width':(width+44)+'px',
        'margin-left':-parseInt(width/2)
    });
    /*var innerImg = $('.Img img',actionBlock);
    if (innerImg.length>0){
        var popupImg = new Image();
        popupImg.src = innerImg.attr('src');
        var width = popupImg.width;
        if (width) {
            actionBlock.css({
                'width':'990px',
                'margin-left':-parseInt(width/2)
            });
        }
    }*/
    
    // Предпросмотр баннера
    $("form#fillData input[name='text1']",actionBlock).keyup(function(){
        $(".TopNew .Text big",actionBlock).text($(this).attr('value'));
    });
    $("form#fillData textarea[name='text2']",actionBlock).keyup(function(){
        $(".TopNew .Text small",actionBlock).html($(this).attr('value').split("\n").join("<br/>"));
    });
    // Сохранение формы
    $("form .Buttons .save input",actionBlock).unbind().click(function(){
        ajaxloader.show();
        $("form",actionBlock).submit(function(){
            $(this).ajaxSubmit({
                success: function(data) {
                    if (data=='ok') {
                        container.html('');
                        actionBlock.fadeOut(300);
                        reloadTable();
                    } else {
                        container.html(data);
                        initImageForm(actionBlock);
                    }
                    ajaxloader.hide();
                }
            });
            return false;
        }).submit();
        return false;
    });
    // Отмена
    $("form .Buttons .cancel input",actionBlock).unbind().click(function(){
        $.post("admin/"+pageKey+"/cancel");
        container.html('');
        actionBlock.fadeOut(300);
        return false;
    });
    // Загрузка
    $("form .Buttons .upload input",actionBlock).unbind().change(function(){
        ajaxloader.show();
        var button = $(this);
        var action = $("form",actionBlock).attr('action');
        $("form",actionBlock).attr('action',button.attr('href'));
        $("form",actionBlock).submit(function(){
            $(this).ajaxSubmit({
                success: function(data) {
	                container.html(data);
	                initImageForm(actionBlock);
	                ajaxloader.hide();
                }
            });
            return false;
        }).submit();
        return false;
    });
    // Обрезка изображений
    $('#cropbox',actionBlock).Jcrop({
        bgColor:     'black',
        bgOpacity:   0.4,
        setSelect:   [ 0, 0, 990, 217 ],
        aspectRatio: 990 / 217,
        onSelect: updateCoords,
        onChange: updateCoords
    });
    function updateCoords(c){
        $('#x').attr('value',c.x);
        $('#y').attr('value',c.y);
        $('#w').attr('value',c.w);
        $('#h').attr('value',c.h);
    };
}
</script>
<div class="helpDescr">Здесь можно создавать баннеры и управлять уже созданными. Одновременно может быть активным только один баннер из списка.</div>
<div class="cats">
    <a href="admin/news">Лента новостей</a>
    <a href="admin/mininews">Главные события</a>
    <span style="background:#ffffff;">Новостной баннер</span>
    <a href="admin/afisha">Афиша</a>
</div>
<div class="catExt oEditor">
	<div class="NutManage">
        <div class="oAddList"><a href="admin/news/banner/resize" class="e add">Добавить баннер</a></div>
        <div class="list oEditor"><!-- INCLUDE admin/news/banner/table.tpl --></div>
	</div>
</div>
<!-- INCLUDE admin/footer.tpl -->
