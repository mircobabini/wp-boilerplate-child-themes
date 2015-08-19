<?php
// check setup
( ! defined( 'WPCTB__CONFIG' ) ) &&
	return wpctb__setup_error();

show_admin_bar( false );

define( 'WPCTB__BOILERPLATE_PATH', dirname(__FILE__) );
define( 'WPCTB__BOILERPLATE_ASSETS', get_stylesheet_directory_uri() );

require_once 'functions-others.php';
if( is_admin() ){ require_once 'function-admin.php'; }

function wpctb__init(){
	add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

	// setup components
	$components = array(
		/* keys are just for components legibility */
		'debug' => array( 'components/debug.php', false ),

		'assets__init'       => array( 'assets/init.php', true ),
		'assets__init-admin' => array( 'assets/init-admin.php', is_admin() ),

		'enhance__ltie9support' => array( 'components/enhance__ltie9support.php', false ),
		'enhance__jquery'       => array( 'components/enhance__jquery-cdn.php', true ),

		'security'         => array( 'components/security.php', false ),
		'cleanup__head'    => array( 'components/cleanup__head.php', false ),
		'cleanup__various' => array( 'components/cleanup__various.php', false ),

		'i18n/l10n'        => array( 'components/i18n.php', false ),

		'plugin__wpthumb'        => array( 'plugins/wp-thumb/wpthumb.php', false ),
		'plugin__wpmobiledetect' => array( 'plugins/wp-mobile-detect/wp-mobile-detect.php', false ),
	);

	// load components
	foreach( $components as $k => $component ){
		list( $filepath, $active );

		if( $active ){
			require WPCTB__BOILERPLATE_PATH.$filepath;
		}
	}
}
add_action( 'after_setup_theme', 'wptc_init' );
