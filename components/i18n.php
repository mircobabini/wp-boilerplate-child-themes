<?php
// get theme
$theme = wp_get_theme();
$textdomain = $theme->get( 'TextDomain' );
echo 'debug: '.$textdomain.PHP_EOL;

// https://gist.github.com/epicdaze/1029717
load_child_theme_textdomain( $textdomain, WPCTB__BOILERPLATE_PATH.'/languages' );

// todo: ?
if (!is_admin()) {
	wp_deregister_script( 'l10n' ); // this script help translate comments entities
}