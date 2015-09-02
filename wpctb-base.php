<?php

/* DEBUGGING */
define( 'WPCTB__DEV', true );

if( ! defined( 'WP_DEBUG' ) ){
	/* no    debug: false, false, false */
	/* operativity: true, false, false */
	/* soft  debug: true, true, false */
	/* hard  debug: true, true, true */
	if( wp_debug__( true ) ){
		wp_debug__log( true );
		wp_debug__display( false );
	}
}

/* you need hardcore debug? */
// ini_set( 'log_errors', 'On' );
// ini_set( 'display_errors', 'On' );

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
