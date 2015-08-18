<?php
// The JavaScript
function my_action_javascript() {
	//Set Your Nonce
	$ajax_nonce = wp_create_nonce( 'my-special-string' );
	?>
	<script>
	jQuery( document ).ready( function( $ ) {
		var data = {
			action: 'my_action',
			security: '<?php echo $ajax_nonce; ?>',
			whatever: 1234
		};
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$.post( ajaxurl, data, function( response)  {
			alert( 'Got this from the server: ' + response );
		});
	});
	</script>
	<?php
}
add_action( 'admin_footer', 'my_action_javascript' );

// The function that handles the AJAX request
function my_action_callback() {
	global $wpdb; // this is how you get access to the database
	check_ajax_referer( 'my-special-string', 'security' );
	$whatever = intval( $_POST['whatever'] );
	$whatever += 10;
	echo $whatever;
	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_my_action', 'my_action_callback' );