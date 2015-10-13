<?php
// prepare script.js requirements
global $scriptjs_requires;
$scriptjs_requires = array( 'jquery' );

function wpctb__import_styles(){
	// wp_enqueue_style( 'wpctb__googlefonts', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,700,300,800', '', '2', 'all' );
	// wp_enqueue_style( 'wpctb__fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', '' , '4.4.0', 'all' );
}
function wpctb__import_theme_style(){
	$parent = wp_get_theme()->get( 'Template' );
	wp_enqueue_style( $parent, get_template_directory_uri().'/style.css' );
	wp_enqueue_style( 'wpctb__style', CHILDPRESS__ASSETS.'/style.css', array( $parent ) );
}
add_action( 'wp_enqueue_scripts', 'wpctb__import_theme_style', 201 );
add_action( 'wp_enqueue_scripts', 'wpctb__import_styles', 200 );

function wpctb__register_assets(){
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
	wp_register_script( 'wpctb__scriptjs', CHILDPRESS__ASSETS.'/js/script.js', $scriptjs_requires, wpctb()->VERSION_JS, true );

	// this boilerplate uses the mobile-first approach for css.
	// it's cool because: http://www.zell-weekeat.com/how-to-write-mobile-first-css/
	// the guys from http://themble.com/bones/ uses these sizes for their mobile-first approach:
	wp_register_style( 'wpctb__allcss', CHILDPRESS__ASSETS.'/css/all.css', null, wpctb()->VERSION_CSS ); // base, for all devices
	wp_register_style( 'wpctb__utilscss', CHILDPRESS__ASSETS.'/css/utils.css', null, wpctb()->VERSION_CSS ); // utils, for all devices
	wp_register_style( 'wpctb__mobilecss', CHILDPRESS__ASSETS.'/css/mobile.css', array('wpctb__allcss'), wpctb()->VERSION_CSS ); // mobile-first, for all devices
	// and, for big-screen browsers
	wp_register_style( 'wpctb__desktopcss', CHILDPRESS__ASSETS.'/css/desktop.css', array('wpctb__mobilecss'), wpctb()->VERSION_CSS, 'only screen and (min-width : 992px)' );
	// and, because of ie8 ignorance (http://www.smashingmagazine.com/2011/10/developers-guide-conflict-free-javascript-css-wordpress/)
	wp_register_style( 'wpctb__desktopcss-ie', CHILDPRESS__ASSETS.'/css/desktop.css', array('wpctb__mobilecss'), wpctb()->VERSION_CSS );
	global $wp_styles; $wp_styles->add_data( 'wpctb__desktopcss-ie', 'conditional', '!(IEMobile)&(lt IE 9)' );
	// and, for ie only (all versions up to 9)
	wp_register_style( 'wpctb__desktopcss-ie-only', CHILDPRESS__ASSETS.'/css/ie.css', array('wpctb__mobilecss'), wpctb()->VERSION_CSS );
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
