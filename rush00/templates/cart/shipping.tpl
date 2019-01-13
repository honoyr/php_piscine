<form action="cart/shipping/{ID}" method="post"> 
    <div class="Title">Заказать товар - Шаг 2: Доставка</div> 
    <div class="Descr successHide">Заполните пожалуйста поля ниже, чтобы мы смогли отправить Вам Ваш заказ</div> 
    <div class="oT2 successHide"><table><tbody> 
        <tr> 
            <td><span>Ф.И.О.: <font color="red">*</font></span></td> 
            <td> 
                <div class="inputText"><i><b><input type="text" name="name" /></b></i></div> 
                <div class="Example">Например: Иванов Иван Иванович</div>
                <!-- BEGIN error_name --><div class="error">{error_name.MESSAGE}</div><!-- END error_name -->
            </td> 
        </tr>
        <tr> 
            <td><span>Индекс: <font color="red">*</font></span></td> 
            <td><div class="inputText"><i><b><input type="text" name="zipcode" /></b></i></div>
                <div class="Example">Например: 450071</div>
                <!-- BEGIN error_zipcode --><div class="error">{error_zipcode.MESSAGE}</div><!-- END error_zipcode -->
            </td> 
        </tr>
        <tr> 
            <td><span>Cубъект федерации: <font color="red">*</font></span></td> 
            <td><div class="inputText"><i><b><input type="text" name="state" /></b></i></div>
                <div class="Example">Например: Башкортостан</div>
                <!-- BEGIN error_state --><div class="error">{error_state.MESSAGE}</div><!-- END error_state -->
            </td> 
        </tr>
        <tr> 
            <td><span>Город: <font color="red">*</font></span></td> 
            <td><div class="inputText"><i><b><input type="text" name="city" /></b></i></div>
                <div class="Example">Например: Уфа</div>
                <!-- BEGIN error_city --><div class="error">{error_city.MESSAGE}</div><!-- END error_city -->
            </td> 
        </tr>
        <tr> 
            <td><span>Адрес: <font color="red">*</font></span></td> 
            <td><div class="inputText"><i><b><input type="text" name="address" /></b></i></div>
                <div class="Example">Например: 3-я улица Строителей, дом 25, квартира 12</div>
                <!-- BEGIN error_address --><div class="error">{error_address.MESSAGE}</div><!-- END error_address -->
            </td> 
        </tr>
        <tr> 
            <td colspan="2"><div class="Buttons" style="text-align:center">  
                <div class="button red pay"><i><b>Оплатить ONLINE</b></i></div>
                <div class="button red send"><i><b>Оплатить наличными</b></i></div> 
                <div class="button gray cancel"><i><b>Отмена</b></i></div> 
            </div></td> 
        </tr> 
    </tbody></table></div> 
    <div class="Descr successShow" style="display:none"><br/>Ваше заказ принят! Наши менеджеры рассмотрят его в рабочие часы и свяжутся с вами.</div>
    <div class="Buttons successShow" style="display:none;text-align:center;"> 
        <div class="button red cancel"><i><b>ОК</b></i></div> 
    </div> 
</form>