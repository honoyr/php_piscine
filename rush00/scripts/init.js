$(document).ready(function(){
    bg = $(".DarkBg");
	popup = $(".Popup");
    var block = $(".PopupBlock",popup);
    // Форма заказа звонка
    $(".button.call,.topbutton.needhelp").click(function(){
    	hideFlash();
    	var msg = $(this).attr('rel');
    	block.load('call',{},function(){
    	    initOrderForm(block);
        	block.find("textarea[name='message']").val(msg);
            bg.fadeIn(300);
            popup.css({'top':(getBodyScrollTop()+50)+'px'});
            popup.show();
            $(".CloseButton",popup).add(bg).unbind().click(function(){
                bg.fadeOut(300);
                popup.hide();
            	showFlash();
            });
    	});
    });
    // Форма заказа
    $(".button.order").click(function(){
    	hideFlash();
    	var msg = $(this).attr('rel');
    	block.load('order/'+$(this).attr('id'),{},function(){
    	    initOrderForm(block);
        	block.find("textarea[name='message']").val(msg);
            bg.fadeIn(300);
            popup.css({'top':(getBodyScrollTop()+50)+'px'});
            popup.show();
            $(".CloseButton",popup).add(bg).unbind().click(function(){
                bg.fadeOut(300);
                popup.hide();
            	showFlash();
            });
    	});
    });
    // Форма отзыва
    $(".button.write").click(function(){
    	hideFlash();
    	block.load('testimonial',{},function(){
    	    initOrderForm(block);        	
            bg.fadeIn(300);
            popup.css({'top':(getBodyScrollTop()+50)+'px'});
            popup.show();
            $(".CloseButton",popup).add(bg).unbind().click(function(){
                bg.fadeOut(300);
                popup.hide();
            	showFlash();
            });
    	});
    });
    var hideFlash = function(){
    	$("iframe,object,embed").hide();
    }
    var showFlash = function(){
    	$("iframe,object,embed").show();
    }
    // Fancybox
    $("a.fancybox").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false,
		'hideOnOverlayClick':	true
	});
    // Cycle
    $(".cycle").cycle({
		fx: 'fade', 
	    pause: 1
	});
    // Подсветка пунктов меню
    $(".menu a").each(function(i,item){
        var url = $(item).attr('href');
        if (location.href.lastIndexOf(url)>0 || (url=='./' && !location.href.replace("http://","").split("/")[1])){
            $(item).parent().addClass('active');
        }
    });
    // Сертификаты
    var certblock = $(".cert");
    var certs = $(".items",certblock);
    $(".arrow.R",certblock).click(function(){
    	$(".item:first",certs).appendTo(certs);
    });
    $(".arrow.L",certblock).click(function(){
    	$(".item:last",certs).prependTo(certs);
    });
    // Читать далее, отзывы
    $(".testimonials .text>a.go-on").click(function(){
    	$(this).parent().find(".bullshit").show();
    	$(this).prev().remove();
    	$(this).remove();
    });
    // Корзина
    cart = new Cart('cart');
    var cartButton = $(".topbutton.cart");
    $(".button.cart").click(function(){
    	cart.add($(this).attr('id'),1);
    	var img = $(this).parents(".item").find(".img img:eq(0)");
    	var imgOffset = img.offset();
    	var cartOffset = cartButton.offset();
    	img = img.clone().addClass('toCart').css({
    		'top': imgOffset.top+'px',
    		'left':imgOffset.left+'px'
    	}).appendTo("body").animate({
    		'top': (cartOffset.top+8)+'px',
    		'left':(cartOffset.left+50)+'px',
    		'height':'25px'
    	},600,function(){
    		img.remove();
        	cartButton.addClass('active').unbind('hover').hover(function(){
        		$(this).removeClass('active');
        	});
cartButton.click();
    	});
    });
    cartButton.click(function(){
    	hideFlash();
    	block.load('cart',{},function(){
    	    initCart(block);        	
            bg.fadeIn(300);
            popup.css({'top':(getBodyScrollTop()+50)+'px'});
            popup.show();
            $(".CloseButton",popup).add(bg).unbind().click(function(){
                bg.fadeOut(300);
                popup.hide();
            	showFlash();
            });
    	});
    });
});
var bg,popup,cart;
function Cart(name) {
	this.name = name;
	var counter = $("#cartCounter");
	
	this._init = function(){
		var cookie = $.cookie(this.name);
		this.items = cookie ? $.parseJSON(cookie) : {};
		if (!this.items) {
			$.cookie(this.name, null);
		}
		counter.text(this.count());
	}
	
	this.count = function(){
		var i = 0;
		$.each(this.items,function(j,item){ i++; });
		return i;
	}
	
	this.add = function(val,count) {
        this.items[val] = this.items[val] ? parseInt(this.items[val])+parseInt(count) : count;
        this._refresh();
    }
	
	this.edit = function(val,count) {
        this.items[val] = count;
        this._refresh();
    }
	
	this.del = function(val) {
        delete this.items[val];
        this._refresh();
    }
	
	this._refresh = function() {
        $.cookie(this.name, $.toJSON(this.items), {expires:30,path:'/'});
        counter.text(this.count());
    }
	
	this.clear = function() {
		this.items = {};
        $.cookie(this.name, null);
        counter.text(0);
    }
	
	this._init();
} 
var initCart = function(block){
	// Сохранение
    $("form .Buttons .send",block).click(function(){
        $(this).unbind();
        $("form",block).submit(function(){
            $(this).ajaxSubmit({
                success: function(data) {
                    if (data=='ok') {
                        $(".successHide",block).hide();
                        $(".successShow",block).show();
                    } else {
                        block.html(data);
                        initOrderForm(block);
                    }
                }
            });
            return false;
        }).submit();
        return false;
    });
    // Отмена
    $("form .Buttons .cancel",block).click(function(){
        bg.click();
        return false;
    });
    // Очистить
    $("form .Buttons .clear",block).click(function(){
    	bg.click();
    	cart.clear();
        return false;
    });
    // Удалить
    $("form .button.delete",block).click(function(){
        cart.del($(this).parents("tr").attr('rel'));
        $(this).parents("tr").remove();
        $("#cartTotalPrice").load('cart/total');
        return false;
    });
    // Кол-во
    $("form input[name^='count']",block).change(function(){
        cart.edit($(this).parents("tr").attr('rel'),$(this).val());
        $("#cartTotalPrice").load('cart/total');
    });
}
var initOrderForm = function(block){
    // Сохранение
    $("form .Buttons .send",block).click(function(){
        $(this).unbind();
        $("form",block).submit(function(){
            $(this).ajaxSubmit({
                success: function(data) {
                    if (data=='ok') {
                        $(".successHide",block).hide();
                        $(".successShow",block).show();
                        cart.clear();
                    } else {
                        block.html(data);
                        initOrderForm(block);
                    }
                }
            });
            return false;
        }).submit();
        return false;
    });
    // Отмена
    $("form .Buttons .cancel",block).click(function(){
        $(".DarkBg").click();
        block.load($("form",block).attr('action'),{},function(data){
            block.html(data);
            initOrderForm(block);
        });
        return false;
    });
    // Оплата
    $("form .Buttons .pay",block).click(function(){
        //$(this).unbind();
        $("form",block).attr('action',$("form",block).attr('action')+'/pay');
        $("form .Buttons .send",block).click();
        return false;
    });
    // mask
    if (!$.browser.msie && !parseInt($.browser.version)<7) {
    	$('#phone_number').mask("+38 (099) 999-9999");
    }
    // Реквизиты для оплаты
    $(".paymethods label",block).click(function(){
    	$(".paymethod",block).hide();
    	$(this).next().show();
    });
}
function getBodyScrollTop(){
    return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
}