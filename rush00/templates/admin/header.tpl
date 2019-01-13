<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- INCLUDE admin/head.tpl -->
<body>
<div class="main">
    <div class="cfx">
        <div class="siteLogo">
            <span><big>{SITE_NAME}</big><small>панель управления</small></span>
        </div>
	    <div class="mainActions">
	        <a href="./">&larr; На сайт</a>
            <a href="admin/howto/wiki">Инструкции</a>
	        <a href="admin/user">Пользователи</a>
	        <a href="auth/logout">Выход</a>
	    </div>
    </div>
    <script type="text/javascript">
	$(document).ready(function() {
	    // Подсветка пунктов меню
	    $(".main>.tabs a").each(function(i,item){
	        var url = $(item).attr('href');
	        if (location.href.lastIndexOf(url)>0){
	           $(item).addClass('active');
	        }
	    });
	});
    </script>
    <div class="tabs"><div class="in">
        <a href="admin/menu">Меню</a>
        <a href="admin/page">Страницы</a>
        <a href="admin/blog">Новости</a>
        <a href="admin/product/all">Каталог</a>
        <a href="admin/order">Заказы</a>
        <a href="admin/testimonial">Отзывы</a>
        <a href="admin/block">Блоки</a>
        <a href="admin/theme">Оформление</a>
        <a href="admin/mail">Почта</a>
        <a href="admin/stuff">Настройки</a>
    </div></div>
    <div class="content">