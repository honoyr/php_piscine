<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- INCLUDE auth/head.tpl -->
<body>
<script type="text/javascript">
$(document).ready(function(){
    $("form").each(function(i,form){
        $("a.submit", form).live('click', function(){
            form.submit();
            return false;
        });
    });
});
</script>
<div class="main">
	<div class="logo"></div>
	<div class="login"><form action="auth/login" method="post"><table>
        <tr>
            <td>E-mail/логин:</td>
            <td><div class="inputText"><i><input type="text" name="email" tabindex="1"/></i></div></td>
            <td rowspan="2"><div class="oSave"><a href="javascript:;" class="submit"><i>&rarr;</i></a></div></td>
        </tr>
        <tr>
            <td>Пароль:</td>
            <td><div class="inputText"><i><input type="password" name="passwd" tabindex="2"/></i></div></td>
        </tr>
	    <tr>
	        <td class="empty">&nbsp;</td>
	        <td>
	            <div class="rememberMe">
	                <input type="checkbox" name="remember_me" id="rememberMe"/><label for="rememberMe">Запомнить меня на данном компьютере</label>
	            </div>
	        </td>
	        <td class="empty">&nbsp;</td>
	    </tr>
	    <!-- BEGIN if_captcha -->
	    <tr>
		    <td class="empty">&nbsp;</td>
		    <td>
		        <div class="captcha">
		            <img src="captcha?rand={RAND}" id="captcha" class="captchaImg"/><br/>
		            <a href="javascript:void(0);" onclick="document.getElementById('captcha').src='captcha/?rand='+Math.random()">обновить</a>
		        </div>
		    </td>
		</tr>
		<tr>
		    <td>Защитный код:</td>
		    <td><div class="inputText"><i><input type="text" name="captcha"/></i></div></td>
		</tr>
	    <!-- END if_captcha -->
	    <!-- BEGIN error_login -->
	    <tr class="error">
	        <td class="empty">&nbsp;</td>
	        <td><div class="error">{error_login.MESSAGE}</div></td>
	        <td class="empty">&nbsp;</td>
	    </tr>
	    <!-- END error_login -->
	</table></form></div>
</div>
<!-- INCLUDE admin/foot.tpl -->