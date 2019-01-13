<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Пути
 * @author dandelion <web.dandelion@gmail.com>
 */
define('DIR_APP',       DIR_ROOT.'/app');
define('DIR_CACHE',     DIR_ROOT.'/cache');
define('DIR_CONFIG',    DIR_ROOT.'/config');
define('DIR_ENGINE',   'engine');
define('DIR_IMAGES',    DIR_ROOT.'/images');
define('DIR_LIB',      'lib');
define('DIR_SCRIPTS',   DIR_ROOT.'/scripts');
define('DIR_STYLES',    DIR_ROOT.'/styles');
define('DIR_TEMPLATES', DIR_ROOT.'/templates');

define('DIR_CONTROLLERS', DIR_APP.'/controllers');
define('DIR_MODELS',      DIR_APP.'/models');
define('DIR_WIDGETS',     DIR_APP.'/widgets');
define('DIR_FORMS',       DIR_APP.'/forms');

define('EXT_PHP', '.php');
define('EXT_TPL', '.tpl');
define('EXT_JS',  '.js');
define('EXT_CSS', '.css');
define('EXT_GZ',  '.gz');