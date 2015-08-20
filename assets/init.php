<?php
// prepare script.js requirements
global $scriptjs_requires;
$scriptjs_requires = array( 'jquery' );

function wpctb__import_parent_style(){
	$parent = 'parent';
	wp_enqueue_style( $parent, get_template_directory_uri().'/style.css' );
	wp_enqueue_style( 'wpctb__style', get_stylesheet_directory_uri().'/style.css', array( $parent ) );
}
/* parent style is imported into the child style.css, but */
/* if you prefer including parent style programmatically: uncomment the line below */
// add_action( 'wp_enqueue_scripts', 'wpctb__import_parent_style' );


function wpctb__register_assets(){
	$VERSION_JS  = '1.0.0';
	$VERSION_CSS = '1.0.0';

	// list of already available scripts in wordpress
	//   http://codex.wordpress.org/Function_Reference/wp_enqueue_script#Default_Scripts_Included_and_Registered_by_WordPress

	// remember that:
	// - Registering a file alone doesn’t do anything to the output of your HTML; it only adds the file to WordPress’s list of known scripts.
	//     As you’ll see in the next section, we register files early on in a theme or plugin where we can keep track of versioning information.
	// - To output the file to the HTML, you need to enqueue the file.
	//     Once you’ve done this, WordPress will add the required script tag to the header or footer of the outputted page.
	// - the wp_enqueue_script 4th parameter is the 'place_in_footer' boolean

	// let's start
	global $scriptjs_requires;
	wp_register_script( 'wpctb__scriptjs', WPCTB__BOILERPLATE_ASSETS.'/js/script.js', $scriptjs_requires, $VERSION_JS, true );

	// this boilerplate uses the mobile-first approach for css.
	// it's cool because: http://www.zell-weekeat.com/how-to-write-mobile-first-css/
	// the guys from http://themble.com/bones/ uses these sizes for their mobile-first approach:
	wp_register_style( 'wpctb__allcss', WPCTB__BOILERPLATE_ASSETS.'/css/all.css', null, $VERSION_CSS ); // base, for all devices
	wp_register_style( 'wpctb__utilscss', WPCTB__BOILERPLATE_ASSETS.'/css/utils.css', null, $VERSION_CSS ); // utils, for all devices
	wp_register_style( 'wpctb__mobilecss', WPCTB__BOILERPLATE_ASSETS.'/css/mobile.css', array('wpctb__allcss'), $VERSION_CSS ); // mobile-first, for all devices
	// and, for big-screen browsers
	wp_register_style( 'wpctb__desktopcss', WPCTB__BOILERPLATE_ASSETS.'/css/desktop.css', array('wpctb__mobilecss'), $VERSION_CSS, 'only screen and (min-width : 992px)' );
	// and, because of ie8 ignorance (http://www.smashingmagazine.com/2011/10/developers-guide-conflict-free-javascript-css-wordpress/)
	wp_register_style( 'wpctb__desktopcss-ie', WPCTB__BOILERPLATE_ASSETS.'/css/desktop.css', array('wpctb__mobilecss'), $VERSION_CSS );
	global $wp_styles; $wp_styles->add_data( 'wpctb__desktopcss-ie', 'conditional', '!(IEMobile)&(lt IE 9)' );
	// and, for ie only (all versions up to 9)
	wp_register_style( 'wpctb__desktopcss-ie-only', WPCTB__BOILERPLATE_ASSETS.'/css/ie.css', array('wpctb__mobilecss'), $VERSION_CSS );
	global $wp_styles; $wp_styles->add_data( 'wpctb__desktopcss-ie-only', 'conditional', 'lte IE 9' );

	// otherwise, if you don't like mobile-first approach,
	// use: https://gist.github.com/LuXDAmore/8220b4d8e3657e2e221b

	// google fonts? here we go
	// wp_register_style( 'wpctb__google-fonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' );
}

function wpctb__enqueue_styles(){
	wp_enqueue_style( 'wpctb__allcss' );
	wp_enqueue_style( 'wpctb__utilscss' );
	wp_enqueue_style( 'wpctb__mobilecss' );
	wp_enqueue_style( 'wpctb__desktopcss' );
	wp_enqueue_style( 'wpctb__desktopcss-ie' );

	// wp_enqueue_style( 'wpctb__google-fonts' );
}
function wpctb__enqueue_scripts(){
	wp_enqueue_script( 'wpctb__scriptjs' );
}


// register the assets
add_action( 'init', 'wpctb__register_assets' );

// and enqueue them only for front-end
if( ! is_admin() ){
	add_action( 'wp_print_styles', 'wpctb__enqueue_styles');
	add_action( 'wp_print_scripts', 'wpctb__enqueue_scripts' );

	// or:
	// add_action( 'wp_enqueue_scripts', 'wpctb__enqueue_styles' );
	// add_action( 'wp_enqueue_scripts', 'wpctb__enqueue_scripts' );
}
