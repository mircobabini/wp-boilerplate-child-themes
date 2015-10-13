<?php
return;
// todo with plugins / default clone:
// - wp_ to something different
// - 1|admin to 42|itsedweb
// - limit login attempts (ex: http://wordpress.org/extend/plugins/limit-login-attempts/)

// todo with wpctb/mainwp scan/cron
// - check file permissions
// - check .htaccess existence
// - check index.php for silence existence
// - delete readme.txt and similar useless files
( ! defined( 'ABSPATH' ) ) && exit;

/* you need hardcore debug? */
// ini_set( 'log_errors', 'On' );
// ini_set( 'display_errors', 'On' );

// check install
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( ! defined( 'WPCTB__CONFIG' ) || ! is_plugin_active('sedweb-security/init.php') ){
	require_once __DIR__.'/inc/wpctb-error.php';
	wpctb__setup_error();
}

// constants, defaults
define( 'CHILDPRESS__INC', __DIR__.'/inc' );
define( 'CHILDPRESS__ASSETS', get_stylesheet_directory_uri() );

// requires
require_once CHILDPRESS__INC.'/functions-utils.php';
is_admin() && require_once CHILDPRESS__INC.'/functions-admin.php';

// setup
wpctb()->VERSION_JS  = '1.0.0';
wpctb()->VERSION_CSS = '1.0.0';

wpctb()->EXT_JS    = WPCTB__DEV ? '.min.js' : '.js';
wpctb()->EXT_CSS   = WPCTB__DEV ? '.min.css' : '.css';
wpctb()->PROT_HTTP = 'http'.($_SERVER['SERVER_PORT'] == 443 ? 's' : '');

// init
function childpress__init(){
	// setup components
	$components = array(
		/* keys are just for components legibility */
		'assets__init'       => array( 'assets.php', true ),
		'assets__init-admin' => array( 'assets__admin.php', is_admin() ),

		'enhance__ltie9support' => array( 'enhance__ltie9support.php', false ), // todo: add local ballbacks
		'enhance__fastclick'    => array( 'enhance__fastclick.php', wp_is_mobile() ), // todo: add local ballbacks

		'i18n/l10n'        => array( 'i18n.php', true ),

		'plugin__wpthumb'        => array( 'plugins/wp-thumb/wpthumb.php', false ),
		'plugin__wpjqueryplus'   => array( 'plugins/wp-jquery-plus/wp-jquery-plus.php', false ),
		'plugin__wpmobiledetect' => array( 'plugins/wp-mobile-detect/wp-mobile-detect.php', false ),
		// wpthumb+wpmobiledetect usage example: example/flatsome.lightweight-slideshows.php
	);

	// load components
	define( 'CHILDPRESS__COMPONENTS', CHILDPRESS__INC.'/components' );
	foreach( $components as $k => $component ){
		list( $filepath, $active ) = $component;


		if( ! file_exists( trailingslashit( CHILDPRESS__COMPONENTS ).$filepath ) ){
			throw new Exception( trailingslashit( CHILDPRESS__COMPONENTS ).$filepath );
		}
		if( $active ){
			require_once( trailingslashit( CHILDPRESS__COMPONENTS ).$filepath );
		}
	}
}
add_action( 'after_setup_theme', 'childpress__init', 20 );
