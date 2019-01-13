<form action="cart/order" method="post"> 
    <div class="Title">Корзина</div> 
    <div class="Descr successHide"></div> 
    <div class="successHide cart"><table>
    <thead>
        <tr>
            <td>Наименование</td>
            <td>Кол.</td>
            <td>Стоимость</td>
            <td>&nbsp;</td>
        </tr>
    </thead>
    <tbody> 
        <!-- BEGIN product -->
        <tr rel="{product.ID}"> 
            <td>{product.NAME}</td> 
            <td> 
                <div class="inputText"><i><b><input type="text" name="count[{product.ID}]" value="{product.COUNT}" /></b></i></div> 
            </td> 
            <td>{product.PRICE} грн.</td> 
            <td>
                <div class="button gray delete">✖</div> 
            </td>
        </tr>
        <!-- END product -->
        <tr>
            <td colspan="2" align="right">Итого</td>
            <td><span id="cartTotalPrice">{PRICE_TOTAL}</span> грн.</td>
            <td></td>
        </tr>
    </tbody></table></div>
    <div class="Buttons"> 
         <div class="button red send">Оформить заказ</div> 
         <div class="button gray cancel">Купить еще</div> 
         <div class="button gray clear">Очистить</div> 
    </div>
</form>