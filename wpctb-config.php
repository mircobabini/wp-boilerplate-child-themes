<?php
// ini_set( 'log_errors', 'On' );
// ini_set( 'display_errors', 'On' );

// aux error function
function wpctb__setup_error( $error = null ){
	if( $error === null ){
		$error = 'include <code>wpctb-config.php</code> into wp-config.php, just before wp-settings.php require';
	}

	$die = function_exists( 'wp_die' ) ? 'wp_die' : 'die';
	$die( $error );
}

// check setup
( ! defined( 'ABSPATH' ) || defined( 'WPINC' ) ) && {
	wpctb__setup_error();
}

if( defined( 'WP_DEBUG' ) ){
	wpctb__setup_error( 'don\'t define WP_DEBUG into wp-config, or comment this check to force (yes, it\'s secure)' );
}

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
