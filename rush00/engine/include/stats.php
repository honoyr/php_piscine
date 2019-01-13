<?php

/**
 * Блок со статистикой
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
function _obRenderStats($code)
{
	$rows = array();
	$rows['Generation time']  = array(1000*Timer::getPeriod(), 'ms');
	$rows['SQL queries']      = DbSimple_Mysql::$count;
	$rows['SQL queries time'] = array(1000*Timer::getPeriod('sql'), 'ms');
	$rows['Template time']    = array(1000*Timer::getPeriod('template'), 'ms');
	$rows['Wiki parsing']     = array(1000*Timer::getPeriod('wiki'), 'ms');

	$rows['Cache time'] = array(1000*number_format(Cache::$stats['time'], 4), 'ms');
	$rows['Cache get']  = Cache::$stats['count_get'];
	$rows['Cache set']  = Cache::$stats['count_set'];

	$info = array();
	foreach ($rows as $name => $value)
	{
		$value = (array)$value;
		if (!empty($value[0]))
		    $info[] = $name.': '.join(' ', $value);
	}
    $insert = '<div style="width:150px;position:fixed;bottom:0px;right:0px;margin:1px;padding:1px;background:darkred;color:#ffffff;font-size:12px;font-family:Arial;">
              '.join('<br/>', $info).'</div>';

	if (strpos($code, '</body>'))
    	$code = str_replace('</body>', $insert."\n</body>", $code);
    else
    	$code .= $insert;
	
	return $code;
}

ob_start('_obRenderStats');