<?php

/**
 * Блок PHP_Debug
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
function _obRenderPHPDebug($code)
{
	global $phpDebug;
	
	$insert = '
<script type="text/javascript" src="'.$phpDebug->getOption('HTML_DIV_js_path').'/html_div.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="'.$phpDebug->getOption('HTML_DIV_css_path').'/html_div.css" />';
    $insert .= $phpDebug->render();
	if (strpos($code, '</body>'))
    	$code = str_replace('</body>', $insert."\n</body>", $code);
    else
    	$code .= $insert;
	return $code;
}

//ob_start('_obRenderPHPDebug');