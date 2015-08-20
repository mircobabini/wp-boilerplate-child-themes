<?php
// @deprecated since 0.1.13-beta
// @use plugins/wp-jquery-plus instead
function wpctb__register_jquery_cdn() {
	wp_deregister_script( 'jquery' );

	// check the latest available version https://developers.google.com/speed/libraries/#jquery
	wp_register_script( 'jquery', COND_PROT_HTTP.'://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery'.COND_EXT_JS, false, null);
}
function wpctb__enqueue_jquery_cdn(){
	wp_enqueue_script( 'jquery' );
}

if( ! is_admin() ){ // leave the default jquery for admin to avoid issues
	add_action( 'init', 'wpctb__register_jquery_cdn' );
	add_action( 'wp_enqueue_scripts', 'wpctb__enqueue_jquery_cdn', 11 ); // someone suggested 100 instead of 11
}
