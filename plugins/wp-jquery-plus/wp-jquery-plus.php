<?php
/*
Plugin Name: WP jQuery Plus
Plugin URI: http://zslabs.com
Description: Loads jQuery from a CDN using the exact version as your current WordPress install
Author: Zach Schnackel
Author URI: http://zslabs.com
Version: 1.1.2
*/

/**
 * Swap jQuery source for CDN
 * @return void
 *
 * @since 0.3
 */
function wpjp_set_src() {

	global $wp_version;

	if ( !is_admin() ) :

		wp_enqueue_script('jquery');

		// Get current version of jQuery from WordPress core
		$wp_jquery_ver = $GLOBALS['wp_scripts']->registered['jquery-core']->ver;
		$wp_jquery_migrate_ver = $GLOBALS['wp_scripts']->registered['jquery-migrate']->ver;

		// Set jQuery Google URL
		if ( defined('WPJP_USE_CDNJS') )
			$jquery_cdn_url = '//cdnjs.cloudflare.com/ajax/libs/jquery/'. $wp_jquery_ver .'/jquery.min.js';
		else
			$jquery_cdn_url = '//ajax.googleapis.com/ajax/libs/jquery/'. $wp_jquery_ver .'/jquery.min.js';

		$jquery_migrate_cdn_url = '//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/'. $wp_jquery_migrate_ver .'/jquery-migrate.min.js';

		// Deregister jQuery and jQuery Migrate
		wp_deregister_script('jquery-core');
		wp_deregister_script('jquery-migrate');

		// Register jQuery with CDN URL
		wp_register_script('jquery-core', $jquery_cdn_url, '', null, false );
		// Register jQuery Migrate with CDN URL
		wp_register_script('jquery-migrate', $jquery_migrate_cdn_url, array('jquery-core'), null, false );

	endif;
}
add_action('wp_enqueue_scripts', 'wpjp_set_src');

/**
 * Add local fallback for jQuery if CDN is down or not accessible
 * Inspired by http://rootstheme.com
 * Inspired by http://wordpress.stackexchange.com/a/12450
 * @param  string $src
 * @param  string $handle
 * @return string
 */
function wpjp_local_fallback( $src, $handle = null ) {

	if ( !is_admin() ) :

		static $add_jquery_fallback = false;
		static $add_jquery_migrate_fallback = false;

		if ( $add_jquery_fallback ) :
			echo '<script>window.jQuery || document.write(\'<script src="' . includes_url('js/jquery/jquery.js') . '"><\/script>\')</script>' . "\n";
			$add_jquery_fallback = false;
		endif;

		if ( $add_jquery_migrate_fallback ) :
			echo '<script>window.jQuery.migrateMute || document.write(\'<script src="' . includes_url('js/jquery/jquery-migrate.min.js') . '"><\/script>\')</script>' . "\n";
			$add_jquery_migrate_fallback = false;
		endif;

		if ( $handle === 'jquery-core')
			$add_jquery_fallback = true;

		if ( $handle === 'jquery-migrate')
			$add_jquery_migrate_fallback = true;

		return $src;

	endif;

	return $src;

}
add_filter('script_loader_src', 'wpjp_local_fallback', 10, 2 );