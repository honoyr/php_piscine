<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Обработчик URL
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package Url
 */
class Url extends Object implements iSingleton
{
	private static $instance;

    protected $parts = array();
    private $sUrl;

    function __construct($sUrl = '')
    {
        if (!empty($sUrl))
           $this->sUrl = $sUrl;
        else
           $this->sUrl = $_SERVER['REQUEST_URI'];
    }

    private function __clone() {}

    public static function getInstance()
    {
        if (self::$instance === null)
            self::$instance = new self;
        return self::$instance;
    }

    /**
     * Используем текущий URL для задания пути приложения
     *
     * @return string
     */
    private function getRelativePath()
    {
        $expr = '@(?:'.preg_quote(dirname($_SERVER['SCRIPT_NAME'])).')\/?(?P<path>[^?]+)(?:\/?\?.*)?@i';
        preg_match($expr, $this->sUrl, $matches);

        return (isset($matches['path'])) ? $matches['path'] : '';
    }

    /**
     * Разбить URL на части
     *
     * @return array
     */
    public function split()
    {
        $parts = explode('/', $this->getRelativePath());
        $this->parts = $this->cleanParts($parts);
        return $this;
    }

    /**
     * Почистить элементы URL
     *
     * @param array $parts
     * @return array
     */
    private function cleanParts($parts)
    {
        foreach ($parts as $i => $part)
            if (empty($part) && 0 !== $part && '0' !== $part) unset($parts[$i]);

        $parts = array_values(array_map('urldecode', $parts));
        $parts = array_values(array_map('trim', $parts));
        return $parts;
    }

    /**
     * Перенаправить к заданному URL
     *
     * @param string $url
     */
    public function redirectTo($url)
    {
        if (strpos($url, "http://") === false)
            $url = URL_HOME.$url;
        header("Location: ".$url);
        throw new Exception('Url: cannot redirect to '.$url);
    }

    /**
     * Перенаправить на URL, с которого пришел пользователь
     */
    public function redirectToReferer()
    {
        $this->redirectTo((null != URL_REFERER) ? URL_REFERER : URL_HOME);
    }

    /**
     * Перенаправить домой
     */
    public function redirectToHome()
    {
        $this->redirectTo(URL_HOME);
    }

    /**
     * Перенаправить на страницу 404
     */
    public function redirectTo404()
    {
        $this->redirectTo(PAGE_404);
    }

    /**
     * Перенаправить на страницу 403
     */
    public function redirectTo403()
    {
        $this->redirectTo(PAGE_403);
    }
}
