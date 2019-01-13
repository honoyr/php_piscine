<form action="admin/testimonial/edit/{ID}" method="post" enctype="multipart/form-data"><div class="oT2"><table><tbody>
    <tr> 
        <td><span>ФИО:</span></td> 
        <td> 
            <div class="inputText"><i><b><input type="text" name="name" /></b></i></div> 
            <!-- BEGIN error_name --><div class="error">{error_name.MESSAGE}</div><!-- END error_name -->
        </td> 
    </tr> 
    <tr> 
        <td><span>Телефон:</span></td> 
        <td><div class="inputText"><i><b><input type="text" name="phone" /></b></i></div>
            <!-- BEGIN error_phone --><div class="error">{error_phone.MESSAGE}</div><!-- END error_phone -->
        </td> 
    </tr> 
    <tr> 
        <td><span>Город:</span></td> 
        <td> 
            <div class="inputText"><i><b><input type="text" name="city" /></b></i></div> 
            <!-- BEGIN error_city --><div class="error">{error_city.MESSAGE}</div><!-- END error_city -->
        </td> 
    </tr>
    <tr> 
        <td><span>Должность:</span></td> 
        <td> 
            <div class="inputText"><i><b><input type="text" name="duties" /></b></i></div> 
            <!-- BEGIN error_duties --><div class="error">{error_duties.MESSAGE}</div><!-- END error_duties -->
        </td> 
    </tr>
    <tr> 
        <td><span>Сайт:</span></td> 
        <td> 
            <div style="width:50px;float:left;line-height: 23px;">http://</div>
            <div class="inputText" style="width:250px;float:left;"><i><b><input type="text" name="website" /></b></i></div> 
            <!-- BEGIN error_website --><div class="error">{error_website.MESSAGE}</div><!-- END error_website -->
        </td> 
    </tr>
    <tr> 
        <td><span>Отзыв:</span></td> 
        <td> 
            <div class="textarea"><i><b><textarea name="message" cols="30" rows="10" style="height:200px;"></textarea></b></i></div>
            <!-- BEGIN error_message --><div class="error">{error_message.MESSAGE}</div><!-- END error_message --> 
        </td> 
    </tr>
    <tr>
        <td><span>Фотография:</span></td>
        <td>
            <div class="Picture">
                <!-- BEGIN no_picture -->
                <div class="addImage">
                    <span class="oFileLink"><i>Прикрепить</i><input type="file" name="file" size="40" rel="admin/testimonial/picture"/></span>
                </div>
                <!-- END no_picture -->
                <!-- BEGIN picture2 -->
                <div class="changeImage">
                    <img src="images/temp/{picture2.KEY}" alt="" title="" />
                    <span class="oFileLink"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/testimonial/picture"/></span>
                </div>
                <!-- END picture2 -->
                <!-- BEGIN picture -->
                <div class="changeImage">
                    <img src="images/people/s/{picture.FILE}" alt="" title="" />
                    <span class="oFileLink"><i>Поменять</i><input type="file" name="file" size="40" rel="admin/people/picture"/></span>
                </div>
                <!-- END picture -->
                <input type="hidden" name="pictureKey" default=""/>
            </div>
        </td>
    </tr>
    <tr>
        <td class="empty">&nbsp;</td>
        <td><div class="oActButtons">
            <a href="javascript:;" class="save">Сохранить изменения</a>
            <a href="javascript:;" class="cancel">Отмена</a>
        </div></td>
    </tr>
</tbody></table></div></form>