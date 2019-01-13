<?php
/**
 * Created by IntelliJ IDEA.
 * User: ilazarev
 * Date: 14.04.2010
 * Time: 16:46:08
 * To change this template use File | Settings | File Templates.
 */

class Yandex_Mail_Api_RegistrarApi extends Yandex_Mail_Api_Base {

    private $_registrar_id;
    private $_password;

    /**
     * @param int $registrar_id
     * @param string $password
     * @param handler $curl
     * @param bool $debug
     * @return void
     */
    public function __construct($registrar_id, $password, $curl = null, $debug = false)
    {
        $this->_registrar_id = $registrar_id;
        $this->_password = $password;
        parent::__construct($curl, $debug);
    }


    protected function invokeHandler($handler_name, array $params, $method = 'get', $base_url = self::API_BASE_URL)
    {
        if (!in_array('registrar_id', $params)) {
              $params['registrar_id'] = $this->_registrar_id;
        }
        if (!in_array('password', $params)) {
              $params['password'] = $this->_password;
        }
        return parent::invokeHandler($handler_name, $params, $method, $base_url);
    }

    /**
     * @param string $payed_url
     * @param string $added_init_url
     * @param string $added_url
     * @param string $delete_url
     * @param string $transfer_succeed
     * @return SimpleXMLElement
     */
    public function setRegistrarUrls($payed_url, $added_init_url, $added_url, $delete_url, $transfer_succeed)
    {
        return $this->invokeHandler('save_registrar', array(
            'payed_url' => $payed_url,
            'added_init' => $added_init_url,
            'added' => $added_url,
            'delete_url' => $delete_url,
            'transfer_succeed' => $transfer_succeed
        ));
    }

    /**
     * @param string $domain
     * @param string $mail_protocol
     * @param bool $use_ssl
     * @param string $mail_server
     * @param string $mail_port
     * @param array $emails = array('email' => 'password', ...)
     * @return SimpleXMLElement
     */
    public function importDomain($domain, $mail_protocol, $use_ssl, $mail_server, $mail_port, array $emails)
    {
        $emailsXml = '<emails>';
        foreach ($emails as $email => $password) {
            $emailsXml .= '<email><name>' . $email . '</name><password>' . $password . '</password></email>';
        }
        $emailsXml .= '</emails>';
        return $this->invokeHandler('import_registrar_domain',
            array(
                'domain' => $domain,
                'mail_proto' => $mail_protocol,
                'use_ssl' => $use_ssl,
                'mail_server' => $mail_server,
                'mail_port' => $mail_port,
                'emails' => $emailsXml,
            ),
            'post'
        );

    }

    /**
     * @param string $domain
     * @return SimpleXMLElement
     */
    public function checkDomain($domain)
    {
        return $this->invokeHandler('registrar_check_domain',
            array(
                'domain' => $domain,
            )
        );
    }

    /**
     * @param string $domain
     * @return SimpleXMLElement
     */
    public function checkImport($domain)
    {
        return $this->invokeHandler('registrar_check_import',
            array(
                'domain' => $domain,
            )
        );
    }

}
