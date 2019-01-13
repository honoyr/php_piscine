<form action="testimonial" method="post"> 
    <div class="Title">Оставить отзыв</div>
    <div class="oT2 successHide"><table><tbody> 
        <tr> 
            <td><span>ФИО: <font color="red">*</font></span></td> 
            <td> 
                <div class="inputText"><i><b><input type="text" name="name" /></b></i></div> 
                <!-- BEGIN error_name --><div class="error">{error_name.MESSAGE}</div><!-- END error_name -->
            </td> 
        </tr> 
        <tr> 
            <td><span>Телефон: </span></td> 
            <td><div class="inputText" style="width:150px;"><i><b><input type="text" name="phone" id="phone_number" /></b></i></div>
                <!-- BEGIN error_phone --><div class="error">{error_phone.MESSAGE}</div><!-- END error_phone -->
            </td> 
        </tr> 
        <tr> 
            <td><span>Город: <font color="red">*</font></span></td> 
            <td> 
                <div class="inputText" style="width:150px;"><i><b><input type="text" name="city" /></b></i></div> 
                <!-- BEGIN error_city --><div class="error">{error_city.MESSAGE}</div><!-- END error_city -->
            </td> 
        </tr>
        <tr> 
            <td><span>Должность: <font color="red">*</font></span></td> 
            <td> 
                <div class="inputText"><i><b><input type="text" name="duties" /></b></i></div> 
                <!-- BEGIN error_duties --><div class="error">{error_duties.MESSAGE}</div><!-- END error_duties -->
            </td> 
        </tr>
        <tr> 
            <td><span>Сайт:</span></td> 
            <td> 
                <div style="width:40px;float:left;line-height: 23px;">http://</div>
                <div class="inputText" style="width:250px;float:left;"><i><b><input type="text" name="website" /></b></i></div> 
                <!-- BEGIN error_website --><div class="error">{error_website.MESSAGE}</div><!-- END error_website -->
            </td> 
        </tr>
        <tr> 
            <td><span>Отзыв: <font color="red">*</font></span></td> 
            <td> 
                <div class="textarea"><i><b><textarea name="message" cols="30" rows="10" style="height:200px;"></textarea></b></i></div>
                <!-- BEGIN error_message --><div class="error">{error_message.MESSAGE}</div><!-- END error_message --> 
            </td> 
        </tr>
        <tr> 
            <td><span>Ваша фотография:</span></td> 
            <td> 
                <div><input type="file" name="file" /></div> 
                <!-- BEGIN error_file --><div class="error">{error_file.MESSAGE}</div><!-- END error_file -->
            </td> 
        </tr>
        <tr> 
            <td class="empty">&nbsp;</td> 
            <td><div class="Buttons"> 
                <div class="button red send"><i><b>Отправить</b></i></div> 
                <div class="button gray cancel"><i><b>Отмена</b></i></div> 
            </div></td> 
        </tr> 
    </tbody></table></div> 
    <div class="Descr successShow" style="display:none"><br/>Ваш отзыв добавлен. Спасибо! Нам очень важно ваше мнение.</div>
    <div class="Buttons successShow" style="display:none;text-align:center;"> 
        <div class="button gray cancel"><i><b>ОК</b></i></div> 
    </div> 
</form>