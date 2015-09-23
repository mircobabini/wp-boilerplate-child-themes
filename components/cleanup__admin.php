<?php
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

/* clean the toolbar */
if( is_admin_bar_showing() ){
	add_action( 'admin_bar_menu', function($wpab){
		// secondary bar
		$wpab->remove_node( 'user-info' );
		$wpab->remove_node( 'edit-profile' );

		// primary bar
		$wpab->remove_node( 'wp-logo' );
		$wpab->remove_node( 'new-content' );
		$wpab->remove_node( 'wpseo-menu' );

		if( ! user__is( 'administrator' ) ){
			$wpab->remove_node( 'updates' );
		}
	}, 999 );
}

/* clean things for non-administrators */
if( ! user__is( 'administrator' ) ){

	// remove help tab
	add_filter( 'contextual_help_list', function(){
		global $current_screen;
		$current_screen->remove_help_tabs();
	} ); /* todo: test it! */

	// remove Tools menu for non administrators
	add_action( 'admin_menu', function(){
		remove_menu_page( 'tools.php' );
	} );

}

