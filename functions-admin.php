<?php
// todo: move in addons
function disable_autosave(){
	wp_deregister_script( 'autosave' );
}
add_action( 'admin_init', 'disable_autosave' );

// customizer: http://www.wpexplorer.com/theme-customizer-introduction/

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	global $wp_meta_boxes;
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);    // Right Now Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        // Activity Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Comments Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  // Incoming Links Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);         // Plugins Widget

	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);    // Quick Press Widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);     // Recent Drafts Widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);           //
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);         //

	// remove plugin dashboard boxes
	unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);           // Yoast's SEO Plugin Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);        // Gravity Forms Plugin Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);   // bbPress Plugin Widget

	/*
	have more plugin widgets you'd like to remove?
	share them with us so we can get a list of
	the most commonly used. :D
	https://github.com/eddiemachado/bones/issues
	*/
}

/*
For more information on creating Dashboard Widgets, view:
http://digwp.com/2010/10/customize-wordpress-dashboard/
*/

// removing the dashboard widgets
add_action( 'wp_dashboard_setup', 'disable_default_dashboard_widgets' );

// hide wordpress' version in footer
function wpctb__update_footer(){
	remove_filter( 'update_footer', 'core_update_footer', 800 );
}
add_action( 'admin_menu', 'wpctb__update_footer' );

// change admin credits
function wpctb__admin_footer_text( $default_text ){
	return '<span id="footer-thankyou">Made by <a href="http://sedweb.it">SED Web</a> with ♥<span>';
}
add_filter( 'admin_footer_text', 'wpctb__admin_footer_text' );

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
