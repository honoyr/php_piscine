#!/usr/bin/php
<?php
if ($argc == 1)
	exit();
$fd = fopen($argv[1], 'r');
while ($data = fgets($fd))
{
	$data = preg_replace_callback('/<a.*?title="(.*?)"/', function ($matches) {
		return str_replace($matches[1], strtoupper($matches[1]), $matches[0]);
        }, $data);
	$data = preg_replace_callback('/<a.*?>(.*?)</', function ($matches) {
		return str_replace($matches[1], strtoupper($matches[1]), $matches[0]);
        }, $data);

	echo "$data";
}
fclose($fd);
?>