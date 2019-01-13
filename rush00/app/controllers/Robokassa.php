<?php
/**
 * Robokassa
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Robokassa extends Controller
{
    function indexAction(array $params)
    {
        die();
    }
    
    function resultAction(array $params)
    {
        $mrh_pass2 = ROBOKASSA_PASS2;
        
        // чтение параметров
        $out_summ = $_REQUEST["OutSum"];
        $inv_id = $id = $_REQUEST["InvId"];
        $crc = strtoupper($_REQUEST["SignatureValue"]);
        
        $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));
        
        // проверка корректности подписи
        if ($my_crc !=$crc)
        {
            echo "bad sign\n";
            die();
        }
        /**
         * Сохраняем статус заказа
         */
        $this->model->order->edit(array(
            'step' => 4,
        ),$id);
        // признак успешно проведенной операции
        echo "OK$inv_id\n";
        die();
    }
}