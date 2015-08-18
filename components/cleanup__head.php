<?php
function wpctb__head_cleanup(){
	// todo: ?
	// remove_action('wp_head', 'feed_links', 2);
	// remove_action('wp_head', 'feed_links_extra', 3);
	// remove_action('wp_head', 'rsd_link');
	// remove_action('wp_head', 'wlwmanifest_link');
	// remove_action('wp_head', 'index_rel_link');
	// remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	// remove_action('wp_head', 'start_post_rel_link', 10, 0);
	// remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	// remove_action('wp_head', 'wp_generator');
	// remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	// remove_action('wp_head', 'noindex', 1);

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
	// WP version
	remove_action( 'wp_head', 'wp_generator' );

	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

	// remove pesky injected css for recent comments widget
	add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
	// clean up comment styles in the head
	add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
	// clean up gallery output in wp
	add_filter( 'gallery_style', 'bones_gallery_style' );
}
add_action( 'init', 'wpctb__head_cleanup' );