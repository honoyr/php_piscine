<?php
/**
 * Created by IntelliJ IDEA.
 * User: ilazarev
 * Date: 14.04.2010
 * Time: 16:46:23
 * To change this template use File | Settings | File Templates.
 */

abstract class Yandex_Mail_Api_Base {

    private $_curl;
    private $_debug;

    const API_BASE_URL = 'https://pddimp.yandex.ru/';

    public function __construct($curl = null, $debug = false)
    {
        if ($curl) {
            $this->_curl = $curl;
        } else {
            $this->_curl = curl_init();
        }
        $this->_debug = $debug;
    }

    protected function invokeHandler($handler_name, array $params, $method = 'get', $base_url = self::API_BASE_URL)
    {
        foreach($params as $k => $v) {
            if (is_null($v)) {
                unset($params[$k]);
            }
        }
        $url = $base_url . $handler_name . '.xml';
        if (strtolower($method) == 'post') {
            curl_setopt($this->_curl, CURLOPT_POST, true);
            curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $params);
        } else {
            $url .= '?' . http_build_query($params);
            curl_setopt($this->_curl, CURLOPT_HTTPGET, true);
        }

        @curl_setopt_array($this->_curl, array(
            CURLOPT_URL             => $url,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_FOLLOWLOCATION  => true,
        ));

        $this->log('Preform request at url: ', $url);

        if (($result = curl_exec($this->_curl)) === false) {
            $error = curl_error($this->_curl);
            throw new Yandex_Exception($error, $url);
        }
        $this->log('Request result: ', $result);

        if ($result) {
            $response = new SimpleXMLElement($result);
            if ($error = $response->error) {
               throw new Yandex_Exception('API error message: "' . $error['reason'] .'"', $url);
            }
            return $response;
        }

    }

    private function log()
    {
        if (!$this->_debug) {
            return;
        }
        $args = func_get_args();
        echo implode(' ', $args) . "\n";
    }

}

class Yandex_Exception extends Exception
{
    public function __construct($message, $request = null)
    {
        if ($request) {
            $message .= ' Request: ' . $request;
        }
        parent::__construct($message);
    }
}