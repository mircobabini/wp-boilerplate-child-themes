<?php
show_admin_bar( false );

define( 'WPCTB__DEBUG', true );

define( 'WPCTB__BOILERPLATE_PATH', dirname(__FILE__) );
define( 'WPCTB__BOILERPLATE_ASSETS', get_stylesheet_directory_uri() );

require_once 'functions-others.php';
if( is_admin() ){ require_once 'function-admin.php'; }

function wpctb__init(){
	add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

	// setup components
	$components = array(
		/* keys are just for components legibility */
		'assets__init'       => array( 'assets/init.php', true ),
		'assets__init-admin' => array( 'assets/init-admin.php', is_admin() ),

		'debug'        => array( 'components/debug.php', false ),
		'debug__utils' => array( 'components/debug__utils.php', false ),

		'enhance__html5shiv' => array( 'components/enhance__html5shiv-cdn.php', false ),
		'enhance__jquery'    => array( 'components/enhance__jquery-cdn.php', true ),

		'cleanup__head'    => array( 'components/cleanup__head.php', false ),
		'cleanup__various' => array( 'components/cleanup__various.php', false ),

		'i18n/l10n'        => array( 'components/i18n.php', false ),
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
