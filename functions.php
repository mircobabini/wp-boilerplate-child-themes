<?php
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


require_once 'functions-others.php';
is_admin() && require_once 'function-admin.php';

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

		'security'         => array( 'components/security.php', false ),
		'cleanup__head'    => array( 'components/cleanup__head.php', false ),
		'cleanup__various' => array( 'components/cleanup__various.php', false ),

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
