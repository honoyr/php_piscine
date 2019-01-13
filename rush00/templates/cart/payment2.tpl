<form action="cart/payment2/{ID}" method="post"> 
    <div class="Title">Заказать товар - Шаг 3: Оплата</div> 
    <div class="Descr successHide">Выберите наиболее подходящий Вам вариант оплаты из предложенных ниже</div>    
    <div class="oT2 successHide"><table><tbody>
        <tr>
            <td colspan="2" class="paymethods">
                <label><input type="radio" name="paymethod" value="alfabank"/> Оплата через Альфабанк</label>
                <div class="paymethod" style="display:none">{PAY_ALFABANK}</div>
                <label><input type="radio" name="paymethod" value="sberbank"/> Оплата через Сбербанк</label>
                <div class="paymethod" style="display:none">{PAY_SBERBANK}</div>
                <label><input type="radio" name="paymethod" value="contact"/> Оплата через платежные системы Contact, Migom, Золотая Корона</label>
                <div class="paymethod" style="display:none">{PAY_CONTACT}</div>
                <!-- BEGIN error_paymethod --><div class="error">{error_paymethod.MESSAGE}</div><!-- END error_paymethod -->
            </td> 
        </tr>
        <tr> 
            <td class="empty">&nbsp;</td>
            <td><div class="Buttons">
                <div class="button red send"><i><b>ОК</b></i></div> 
                <div class="button red pay"><i><b>Оплатить ONLINE</b></i></div>
                <div class="button gray cancel"><i><b>Отмена</b></i></div> 
            </div></td> 
        </tr> 
    </tbody></table></div> 
    <div class="Descr successShow" style="display:none"><br/>Ваше заказ принят! Наши менеджеры рассмотрят его в рабочие часы и свяжутся с вами.</div>
    <div class="Buttons successShow" style="display:none;text-align:center;"> 
        <div class="button red cancel"><i><b>ОК</b></i></div> 
    </div> 
</form>