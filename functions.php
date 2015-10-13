<?php
// todo with plugins / default clone:
// - wp_ to something different
// - 1|admin to 42|itsedweb
// - limit login attempts (ex: http://wordpress.org/extend/plugins/limit-login-attempts/)

// todo with wpctb/mainwp scan/cron
// - check file permissions
// - check .htaccess existence
// - check index.php for silence existence
// - delete readme.txt and similar useless files
(!defined('ABSPATH')) && exit; // todo: test!

// check setup
( ! defined( 'WPCTB__CONFIG' ) ) && {
	wpctb__setup_error();
}

define( 'WPCTB__BOILERPLATE_PATH', dirname(__FILE__) );
define( 'WPCTB__BOILERPLATE_ASSETS', get_stylesheet_directory_uri() );


wpctb()->VERSION_JS  = '1.0.0';
wpctb()->VERSION_CSS = '1.0.0';

wpctb()->EXT_JS    = WPCTB__DEV ? '.min.js' : '.js';
wpctb()->EXT_CSS   = WPCTB__DEV ? '.min.css' : '.css';
wpctb()->PROT_HTTP = 'http'.($_SERVER['SERVER_PORT'] == 443 ? 's' : '');

require_once 'functions-utils.php';
is_admin() && require_once 'function-admin.php';

if( function_exists( 'wpctb__maybe_disable_error_reporting' ) ){
	wpctb__maybe_disable_error_reporting();
}

function wpctb__init(){
	// setup components
	$components = array(
		/* keys are just for components legibility */
		'base'  => array( 'components/base.php', true ),
		'debug' => array( 'components/debug.php', false ),

		'assets__init'       => array( 'assets/init.php', true ),
		'assets__init-admin' => array( 'assets/init-admin.php', is_admin() ),

		'enhance__ltie9support' => array( 'components/enhance__ltie9support.php', false ), // todo: add local ballbacks
		'enhance__fastclick'    => array( 'components/enhance__fastclick.php', wp_is_mobile() ), // todo: add local ballbacks

		'security'         => array( 'components/security.php',         !is_administrator() ),
		'security__admin'  => array( 'components/security__admin.php',   is_admin() && !is_administrator() ),
		'cleanup__head'    => array( 'components/cleanup__head.php',    !is_administrator() ),
		'cleanup__toolbar' => array( 'components/cleanup__toolbar.php', true ),
		'cleanup__various' => array( 'components/cleanup__various.php', !is_admin() ),

		'i18n/l10n'        => array( 'components/i18n.php', true ),

		'plugin__wpthumb'        => array( 'plugins/wp-thumb/wpthumb.php', false ),
		'plugin__wpjqueryplus'   => array( 'plugins/wp-jquery-plus/wp-jquery-plus.php', false ),
		'plugin__wpmobiledetect' => array( 'plugins/wp-mobile-detect/wp-mobile-detect.php', false ),
		// wpthumb+wpmobiledetect usage example: example/flatsome.lightweight-slideshows.php
	);

	// load components
	foreach( $components as $k => $component ){
		list( $filepath, $active );

		if( $active ){
			require_once( WPCTB__BOILERPLATE_PATH . $filepath );
		}
	}
}
add_action( 'after_setup_theme', 'wptc_init' );
