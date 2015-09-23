<?php
ini_set( 'date.timezone', 'Europe/Rome' );
require_once( dirname(__FILE__) . '/wpctb-utils.php' );

/* you need hardcore debug? */
// ini_set( 'log_errors', 'On' );
// ini_set( 'display_errors', 'On' );

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
require_once( dirname(__FILE__) . '/wpctb-defaults.php' );
