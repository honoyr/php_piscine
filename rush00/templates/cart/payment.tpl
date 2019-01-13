<form action="cart/payment/{ID}" method="post"> 
    <div class="Title">Заказать товар - Шаг 3: Оплата</div> 
    <div class="Descr successHide">Заполните пожалуйста поля ниже, чтобы выставить счет в системе QIWI Кошелек</div>    
    <div class="oT2 successHide"><table><tbody>
        <tr>
            <td rowspan="2"><img src="https://ishop.qiwi.ru/img/button/logo_31x50.jpg" style="padding:10px 20px 10px 0;"/></td>
        </tr>
        <tr align="center" style="font-size:20px">
            <td>
                <div style="float:left;width:280px;padding-top:20px">Номер вашего телефона: +7 </div>
                <div class="inputText" style="float:left;width:140px;padding-top:18px;"><i><b><input type="text" name="phone" style="font-size:20px;line-height:20px;"/></b></i></div>
                <!-- BEGIN error_phone --><div class="error">{error_phone.MESSAGE}</div><!-- END error_phone -->
            </td> 
        </tr>
        <tr> 
            <td class="empty">&nbsp;</td>
            <td><div class="Buttons">
                <div class="button red send"><i><b>Выставить счет</b></i></div> 
                <div class="button red pay"><i><b>Оплатить позже вручную</b></i></div> 
                <div class="button gray cancel"><i><b>Отмена</b></i></div> 
            </div></td> 
        </tr> 
    </tbody></table></div> 
    <div class="Descr successShow" style="display:none"><br/>Ваше заказ принят! Наши менеджеры рассмотрят его в рабочие часы и свяжутся с вами. У вас есть три для на оплату счета в системе QIWI. </div>
    <div class="Buttons successShow" style="display:none;text-align:center;"> 
        <div class="button red cancel"><i><b>ОК</b></i></div> 
    </div> 
</form>