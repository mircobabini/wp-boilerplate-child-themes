<?php
// hide wordpress' version in footer
function wpctb__update_footer(){
	remove_filter( 'update_footer', 'core_update_footer', 800 );
}
add_action( 'admin_menu', 'wpctb__update_footer' );

if( ! user_is__( 'administrator' ) ){
	// remove core update notifications from back-end for all but administrators
	// https://wordpress.org/plugins/wp-security-scan/
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
}
