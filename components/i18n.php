<?php
global $missing_plugins_textdomains;
$missing_plugins_textdomains = array();

// https://gist.github.com/epicdaze/1029717
// get theme's TextDomain (defined in parent style.css headers)
add_action( 'after_setup_theme', 'wpctb__load_theme_textdomain' );
function wpctb__load_theme_textdomain() {
	$textdomain = wp_get_theme()->get( 'TextDomain' );
	load_child_theme_textdomain( $textdomain, get_stylesheet_directory().'/languages' );
}

// some plugins are so stupid, they don't consider the default wp-content/languages/plugins directory for i10n
add_action( 'after_setup_theme', 'wpctb__load_missing_plugins_textdomains' );
function wpctb__load_missing_plugins_textdomains(){
	global $missing_plugins_textdomains;
	if( empty( $missing_plugins_textdomains ) ){
		return;
	}

	foreach( $missing_plugins_textdomains as $textdomain => $plugin_slug ){
		$locale = apply_filters( 'plugin_locale', get_locale(), $textdomain );
		load_textdomain( $textdomain, trailingslashit( WP_LANG_DIR ) . "plugins/{$plugin_slug}-{$locale}.mo" );
	}
}

// todo: ?
if (!is_admin()) {
	wp_deregister_script( 'l10n' ); // this script help translate comments entities
}