<?php
// todo: use the same register/enqueue login from assets/init.php

function wpctb__jquery_cdn() {
	wp_deregister_script( 'jquery' );

	// check the latest available version https://developers.google.com/speed/libraries/#jquery
	wp_register_script( 'jquery', 'http'.($_SERVER['SERVER_PORT'] == 443 ? 's' : '') . "://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js", false, null);
	wp_enqueue_script( 'jquery' );
}
if( ! is_admin() ){ // leave the default jquery for admin to avoid issues
	add_action( 'wp_enqueue_scripts', 'wpctb__jquery_cdn', 11 ); // someone suggested 100 instead of 11
}
