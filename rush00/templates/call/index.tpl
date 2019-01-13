<form action="call" method="post"> 
    <div class="Title">Заказать звонок/консультацию</div> 
    <div class="Descr successHide">Заполните пожалуйста поля ниже, чтобы мы могли связаться с вами</div> 
    <div class="oT2 successHide"><table><tbody> 
        <tr> 
            <td><span>Имя: <font color="red">*</font></span></td> 
            <td> 
                <div class="inputText"><i><b><input type="text" name="name" /></b></i></div> 
                <!-- BEGIN error_name --><div class="error">{error_name.MESSAGE}</div><!-- END error_name -->
            </td> 
        </tr>
        <tr> 
            <td><span>Телефон: <font color="red">*</font></span></td> 
            <td><div class="inputText"><i><b><input type="text" name="phone" id="phone_number" /></b></i></div>
                <!-- BEGIN error_phone --><div class="error">{error_phone.MESSAGE}</div><!-- END error_phone -->
            </td> 
        </tr>
        <tr> 
            <td><span>E-mail:</span></td> 
            <td><div class="inputText"><i><b><input type="text" name="email" /></b></i></div>
                <!-- BEGIN error_email --><div class="error">{error_email.MESSAGE}</div><!-- END error_email -->
            </td> 
        </tr>  
        <tr> 
            <td><span>Комментарий:</span></td> 
            <td> 
                <div class="textarea"><i><b><textarea name="message" cols="30" rows="10" style="height:100px;"></textarea></b></i></div>
                <!-- BEGIN error_message --><div class="error">{error_message.MESSAGE}</div><!-- END error_message --> 
            </td> 
        </tr> 
        <tr> 
            <td class="empty">&nbsp;</td> 
            <td><div class="Buttons"> 
                <div class="button red send"><i><b>Позвоните мне</b></i></div> 
                <div class="button gray cancel"><i><b>Отмена</b></i></div> 
            </div></td> 
        </tr> 
    </tbody></table></div> 
    <div class="Descr successShow" style="display:none"><br/>Ваше сообщение отправлено! Наши менеджеры рассмотрят его в рабочие часы и свяжутся с вами.</div>
    <div class="Buttons successShow" style="display:none;text-align:center;"> 
        <div class="button red cancel"><i><b>ОК</b></i></div> 
    </div> 
</form>