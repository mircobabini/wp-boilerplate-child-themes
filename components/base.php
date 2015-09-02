<?php
/* FRONT END ONLY */
if( ! is_admin() ){
	/* enable/disable admin bar in frontend for logged users */
	show_admin_bar( WPCTB__DEV || user__is( 'administrator' ) );

	/* add plugin translations support for stupid plugins */
	// global $missing_plugins_textdomains;
	// $missing_plugins_textdomains['example_textdomain'] = 'plugin_folder_name';
}

/* BACK END ONLY */
if( is_admin() ){
}


/* FRONT & BACK END */
{
	/* clean the toolbar */
	if( is_admin_bar_showing() ){
		add_action( 'admin_bar_menu', function($wpab){
			// secondary bar
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

	// force perfect jpg images (compression set to 100% instead of 90% i.e. no compression at all)
	// someone said that with 80%/85% you may not even notice the difference
	// after changing, consider using Regenerate Thumbnails plugin to affect even old images
	add_filter( 'jpeg_quality', function(){ return 100; } );
	add_filter( 'wp_editor_set_quality', function(){ return 100; } );
}