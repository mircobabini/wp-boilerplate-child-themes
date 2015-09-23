<?php /*

Title: Blackhole for Bad Bots
Description: Automatically trap and block bots that don't obey robots.txt rules
Project URL: http://perishablepress.com/blackhole-bad-bots/
Author: Jeff Starr (aka Perishable)
Version: 2.0
License: GPLv2 or later

This program is free software; you can redistribute it and/or modify it under the
terms of the GNU General Public License as published by the Free Software Foundation;
either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.

Credits: The Blackhole includes customized/modified versions of these fine scripts:
 - Network Query Tool @ http://www.drunkwerks.com/docs/NetworkQueryTool/
 - Kloth.net Bot Trap @ http://www.kloth.net/internet/bottrap.php

*/
require dirname( dirname( dirname( __FILE__ ) ) ).'/wp-runnable.php';

$badbot = 0;
$filename = dirname( __FILE__ ).'/blackhole.dat';
$ipaddress = $_SERVER['REMOTE_ADDR'];

$fp = fopen($filename, 'r') or wp_die( 'Error, but you should not be here' );
while ($line = fgets($fp)) {
	if (!preg_match("/(googlebot|slurp|msnbot|teoma|yandex)/i", $line)) {
		$u = explode(' ', $line);
		if ($u[0] == $ipaddress) ++$badbot;
	}
}
fclose($fp);

if ($badbot > 0) {
	$title = 'You have been banned from this domain';
	$content = 'If you think there has been a mistake, contact the administrator via proxy server.';
	wp_die( $content, $title );
}

die();