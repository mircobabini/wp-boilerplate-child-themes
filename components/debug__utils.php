<?php
// http://www.wprecipes.com/list-all-hooked-wordpress-functions
// usage: list_hooked_functions(), list_hooked_functions( 'wp_head' )
function list_hooked_functions($tag=false){
	global $wp_filter;
	if ($tag) {
		$hook[$tag]=$wp_filter[$tag];
		if (!is_array($hook[$tag])) {
			trigger_error("Nothing found for '$tag' hook", E_USER_WARNING);
			return;
		}
	} else {
		$hook=$wp_filter;
		ksort($hook);
	}

	echo '<pre>';
	foreach($hook as $tag => $priority){
		echo "<br />&gt;&gt;&gt;&gt;&gt;\t<strong>$tag</strong><br />";
		ksort($priority);
		foreach($priority as $priority => $function){
			echo $priority;
			foreach($function as $name => $properties){
				echo "\t$name<br />";
			}
		}
	}
	echo '</pre>';
	return;
}

// http://www.wprecipes.com/