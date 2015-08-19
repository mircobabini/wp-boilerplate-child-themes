<?php
// aux error function
function wpctb__setup_error(){
	wp_die( 'include <code>wpctb-config.php</code> into wp-config.php, just before wp-settings.php require', 'wpctb: setup error' );
}

// check setup
( ! defined( 'ABSPATH' ) || defined( 'WPINC' ) ) &&
	return wpctb__setup_error();

if( defined( 'WP_DEBUG' ) )
	return wp_die( 'don\'t define WP_DEBUG into wp-config, or comment this check to force (yes, it\'s secure)' );

// load requirements
require_once dirname(__FILE__).'/wpctb-utils.php';

// globally mark this file as required
define( 'WPCTB__CONFIG', 1 );


// tuning
define( 'WPCTB__DEV', true );

/* DEBUGGING */
if( ! defined( 'WP_DEBUG' ) ){
	if( wp_debug__( true ) ){
		wp_debug__log( true );
		wp_debug__display( false );
	}
}

// load non-minified version of wp core assets
__define( 'SCRIPT_DEBUG', WPCTB__DEV );

// to result in a faster administration area, all Javascript files are concatenated into one URL.
// if Javascript is failing to work in your administration area, you can try disabling this feature
__define( 'CONCATENATE_SCRIPTS', !WPCTB__DEV );

// saves the database queries to a array and that array can be displayed to help analyze those queries.
// example: global $wpdb; print_r( $wpdb->queries );
__define( 'SAVE_QUERIES', WPCTB__DEV );

/* OPTIMIZATIONS */
// remove or limit revisions
// example: define( 'WP_POST_REVISIONS', false );
define( 'WP_POST_REVISIONS', WPCTB__DEV ? 20 : 5 );

// force perfect jpg images (compression set to 100% instead of 90% i.e. no compression at all)
// someone said that with 80%/85% you may not even notice the difference
// after changing, consider using Regenerate Thumbnails plugin to affect even old images
add_filter( 'jpeg_quality', function(){ return 100; } );
add_filter( 'wp_editor_set_quality', function(){ return 100; } );
