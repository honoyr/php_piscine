<?php
/**
 * QIWI
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Qiwi extends Controller
{
    function indexAction(array $params)
    {
    	
    }
    
    function updateAction(array $params)
    {
        $s = new SoapServer(DIR_HOME.'/IShopClientWS.wsdl', array('classmap' => array('tns:updateBill' => 'Entity', 'tns:updateBillResponse' => 'Entity')));
        $s->setClass('App_Qiwi');
        //var_dump($s);
        $s->handle();
    }
    
    function updateBill($param) 
    {
    	$this->model->order->edit(array(
    	    'status' => $param->status
    	),$param->txn);
    	
    	$response = new Entity();
	    $response->updateBillResult = 0;
	    return $response;
    }
}