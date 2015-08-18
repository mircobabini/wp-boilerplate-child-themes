<?php
// Add the JS
function theme_name_scripts() {
	wp_enqueue_script( 'ajax-frontend-example', dirname(__FILE__).'/ajax-frontend-example.js', array('jquery'), '1.0.0', true );
	wp_localize_script( 'ajax-frontend-example', 'ajaxobj', array(
		// URL to wp-admin/admin-ajax.php to process the request
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		// generate a nonce with a unique ID "myajax-post-comment-nonce"
		// so that you can check it later when an AJAX request is sent
		'security' => wp_create_nonce( 'my-special-string' )
	));
}
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
// The function that handles the AJAX request
function my_action_callback() {
	check_ajax_referer( 'my-special-string', 'security' );
	$whatever = intval( $_POST['whatever'] );
	$whatever += 10;
	echo $whatever;
	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_my_action', 'my_action_callback' );
// add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );