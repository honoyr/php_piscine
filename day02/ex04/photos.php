#!/usr/bin/php
<?php
	function get_http_response_code($theURL) {
		$headers = get_headers($theURL);
		return substr($headers[0], 9, 3);
	}
	if ($argv[1]) {
		$html = file_get_contents($argv[1]);
        $name = substr(strstr($argv[1], "//"), 2);
        // print($name);
        // print($html);
		preg_match_all('/<img[^>]+>/',$html, $result); 
		$i = 0;
        $img = array();
        // print_r($result);
		foreach ($result[0] as $line)
		{
			$img[$i] = trim(preg_replace("( +)", " ", preg_replace("(\n+)", " ", $line)));
			preg_match_all('/src=("[^"]*")/',$line, $img[$line]);
			$i++;
        }
        // print($line). "\n";
        // print_r($img);
		if(!is_dir($name)) {
			mkdir($name, 0777, true);
        }
        // file_put_contents($name . "/" .$tempname, $tempimg);
		foreach ($img as $key ) {
			if (strlen($key[0][0]) > 1) {
				$key[1][0] = preg_replace("(\")", "", $key[1][0]);
				$tempname = strrchr($key[1][0], "/");
				$tempname = mb_substr($tempname, 1);
				// if ($key[1][0][0] != '/'){
				// 	$key[1][0] = $argv[1] . "/" . $key[1][0];
                // }
				// else {
				// 	$key[1][0] = $argv[1] . $key[1][0];
                // }
                print_r($key);
				if (get_http_response_code($key[0][0])) {
					$tempimg = file_get_contents($key[0][0]);
                }
                print_r($tempimg). "\n";
                print_r($tempname). "\n";
                print_r($name). "\n";









				if (strlen($tempname) > 0) {
					file_put_contents($name . "/" .$tempname, $tempimg);
				}
			}
		}
	}
?>