<?php

/**
 * Константы
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
define('URL_HOME', 'http://'.$_SERVER['SERVER_NAME'].str_replace('index.php', '', $_SERVER['PHP_SELF']));
define('URL_THIS', 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
define('URL_APP', substr($_SERVER['REQUEST_URI'], strlen(str_replace('index.php', '', $_SERVER['PHP_SELF']))));
define('URL_REFERER', @$_SERVER['HTTP_REFERER']);