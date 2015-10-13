<?php
// customization

/* custom favicon */
function wpctb__favicon(){
	?><link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/assets/img/favicon.ico" ><?php
}
add_action( 'wp_head', 'wpctb__favicon');

/* custom excerpt-more */
function wpctb__excerpt_more( $text ){
	// you can use wpml__( 'Read more', 'childpress' );
	return $text;
}
add_filter( 'excerpt_more', 'wpctb__excerpt_more' );

/* custom active/disable events handlers for current theme */
function wpctb__on_activate(){
	/* register a cron job */
	// if( ! wp_next_scheduled( 'wpctb__cron_event_01' ) ){
	// 	wp_schedule_event( time(), 'twicedaily', 'wpctb__cron_event_01' );
	// }

	// function wpctb__cron_routine_01() {
	// 	wp_mail( 'you@example.com', 'Cron Routine 01', 'This is your first cron job. Namaste.' );
	// }
	// add_action( 'wpctb__cron_event_01', 'wpctb__cron_routine_01' );
}
function wpctb__on_deactivate(){
	/* un-register the cron job */
	// wp_clear_scheduled_hook( 'wpctb__cron_event_01' );
}
add_action( 'after_switch_theme', 'wpctb__on_activate' );
add_action( 'switch_theme', 'wpctb__on_deactivate' );
