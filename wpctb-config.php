<?php
/* you need hardcore debug? */
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

// globally mark this file as required
define( 'WPCTB__CONFIG', 1 );

// load utils
require_once( dirname(__FILE__) . '/wpctb-utils.php' );
require_once( dirname(__FILE__) . '/wpctb-base.php' );
