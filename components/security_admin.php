<?php
// hide wordpress' version in footer
function wpctb__update_footer(){
	remove_filter( 'update_footer', 'core_update_footer', 800 );
}
add_action( 'admin_menu', 'wpctb__update_footer' );

// remove core update notifications from back-end for all but administrators
function acunetix_wpsec__remove_core_update_notifications(){
	add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_notices', 'maintenance_nag' );" ) );
	add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_notices', 'update_nag', 3 );" ) );
	add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_init', '_maybe_update_core' );" ) );
	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ) );
	add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
	remove_action( 'wp_version_check', 'wp_version_check' );
	remove_action( 'admin_init', '_maybe_update_core' );
	add_filter( 'pre_transient_update_core', create_function( '$a', "return null;" ) );
	add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );
}
add_action( 'init', 'acunetix_wpsec__remove_core_update_notifications' );

// remove plugins update notifications from back-end for all but administrators
function acunetix_wpsec__remove_plugins_update_notifications(){
	add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_init', 'wp_plugin_update_rows' );" ), 2 );
	add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_init', '_maybe_update_plugins' );" ), 2 );
	add_action( 'admin_menu', create_function( '$a', "remove_action( 'load-plugins.php', 'wp_update_plugins' );" ) );
	add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_init', 'wp_update_plugins' );" ), 2 );
	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_update_plugins' );" ), 2 );
	add_filter( 'pre_option_update_plugins', create_function( '$a', "return null;" ) );
	remove_action( 'load-plugins.php', 'wp_update_plugins' );
	remove_action( 'load-update.php', 'wp_update_plugins' );
	remove_action( 'admin_init', '_maybe_update_plugins' );
	remove_action( 'wp_update_plugins', 'wp_update_plugins' );
	remove_action( 'load-update-core.php', 'wp_update_plugins' );
	add_filter( 'pre_transient_update_plugins', create_function( '$a', "return null;" ) );
}
add_action( 'init', 'acunetix_wpsec__remove_plugins_update_notifications' );

// remove themes update notifications from back-end for all but administrators
function acunetix_wpsec__remove_themes_update_notifications(){
	remove_action( 'load-themes.php', 'wp_update_themes' );
	remove_action( 'load-update.php', 'wp_update_themes' );
	remove_action( 'admin_init', '_maybe_update_themes' );
	remove_action( 'wp_update_themes', 'wp_update_themes' );
	remove_action( 'load-update-core.php', 'wp_update_themes' );
	add_filter( 'pre_transient_update_themes', create_function( '$a', "return null;" ) );
}
add_action( 'init', 'acunetix_wpsec__remove_themes_update_notifications' );

// remove admin notifications from back-end for all but administrators
function acunetix_wpsec__remove_admin_notifications(){
    add_action('init', create_function('$a', "remove_action('init', 'wp_version_check');"), 2);
    add_filter('pre_option_update_core', create_function('$a', "return null;"));
}
add_action( 'init', 'acunetix_wpsec__remove_admin_notifications' );

