<!-- BEGIN order -->
<h3>Корзина</h3>
<div class="cart"><table>
<thead>
    <tr>
        <td>Наименование</td>
        <td>Кол.</td>
        <td>Стоимость</td>
    </tr>
</thead>
<tbody> 
    <!-- BEGIN product -->
    <tr rel="{product.ID}"> 
        <td>{product.NAME}</td> 
        <td>{product.COUNT}</td> 
        <td>{product.PRICE} грн.</td>
    </tr>
    <!-- END product -->
    <tr>
        <td colspan="2" align="right">Итого</td>
        <td><span id="cartTotalPrice">{PRICE_TOTAL}</span> грн.</td>
    </tr>
</tbody></table></div>
<p>Адрес: {order.ADDRESS}</p>
<p>Комментарий: {order.MESSAGE}</p>
<!-- END order -->