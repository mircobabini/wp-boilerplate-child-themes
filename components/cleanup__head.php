<?php
function wpctb__init_cleanup_head(){
	// category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	// others
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action( 'wp_head', 'noindex', 1 );
}
add_action( 'init', 'wpctb__init_cleanup_head' );

