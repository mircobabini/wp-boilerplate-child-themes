<?php
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
