#!/usr/bin/php
<?php
	$fd = fopen("/var/run/utmpx", 'r');
	date_default_timezone_set("America/Los_Angeles");
	while ($data = fread($fd, 628)) {
		$elem = unpack("a256user/a4id/a32line/ipid/itype/Itime", $data);
		if ($elem['type'] == 7) {
			echo "$elem[user]   $elem[line]   ". date('M d H:i', $elem['time'])."\n";
		}
	}
?>
