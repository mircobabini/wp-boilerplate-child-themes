<?php
function wpctb__register_fastclick() {
	// wp_deregister_script( 'fastclick' );

	// check the latest available version http://cdnjs.com/libraries/fastclick
	wp_register_script( 'fastclick', 'https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick'.COND_EXT_JS, false, null);
}
function wpctb__enqueue_fastclick() {
	wp_enqueue_script( 'fastclick' );
}

if( ! is_admin() ){
	add_action( 'init', 'wpctb__register_fastclick' );
	add_action( 'wp_enqueue_scripts', 'wpctb__enqueue_fastclick', 11 );
}
