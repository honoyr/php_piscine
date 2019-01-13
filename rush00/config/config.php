<?php

/**
 * Всякие константы конфигурации
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
define('PRODUCTION', true);
//define('PHP_DEBUG', isset($_COOKIE['debug'])&&$_COOKIE['debug']&&!PRODUCTION);
define('DEBUG_HACKER_CONSOLE', false);
define('STATS', isset($_GET['debug'])&&$_GET['debug']);

define('CACHE_USE', true);
define('CACHE_TYPE', 'file'); // file|memory
define('CACHE_PREFIX', 'wtf');  // [-a-z0-9_]

define('MINIFY', false);
define('MINIFY_HTML', true);
define('MINIFY_JS', true);
define('MINIFY_CSS', true);

define('PAGE_403', 'access/forbidden');
define('PAGE_404', 'page/not/found');

define('COOKIE_PATH', '/');
define('COOKIE_LIVE_TIME', 60*60*24*365);

define('PREFIX_TABLE_NAME', '_');

define('PAGINATOR_COUNT_OF_FIRST_PAGES', 5);
define('PAGINATOR_COUNT_OF_LAST_PAGES', 5);
define('PAGINATOR_COUNT_OF_MIDDLE_PAGES', 4);
