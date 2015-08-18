<?php
// debug constants and settings
function wp_debug__log( $bool, $file = null ){
	@ini_set( 'log_errors', $bool ? 'On' : 'Off' );
	define( 'WP_DEBUG_LOG', $bool );

	if( $file ){
		@ini_set( 'error_log', $file );
		define( 'ERRORLOGFILE', $file ); // database erros will be logged into the file
	}
}
function wp_debug__display( $bool ){
	@ini_set( 'display_errors', $bool ? 'On' : 'Off' );
	define( 'WP_DEBUG_DISPLAY', $bool );
}

/* WordPress debug mode for developers. */
define( 'WP_DEBUG', false );
{
	wp_debug__log( false, dirname(__FILE__).'/wptc-errors.log' );
	wp_debug__display( true );
}

// load non-minified version of wp core assets
define( 'SCRIPT_DEBUG', false );

// to result in a faster administration area, all Javascript files are concatenated into one URL.
// if Javascript is failing to work in your administration area, you can try disabling this feature
define( 'CONCATENATE_SCRIPTS', true );
