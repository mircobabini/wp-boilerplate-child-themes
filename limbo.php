<?php

// define( 'WP_HTTP_BLOCK_EXTERNAL', true );
// define( 'WP_ACCESSIBLE_HOSTS', 'api.wordpress.org,*.github.com' );

// for analysis
define( 'SAVEQUERIES', true );
if ( current_user_can( 'administrator' ) ) {
    ?><pre><?php
	global $wpdb; print_r( $wpdb->queries );
    ?></pre><?php
}

// for moving default folders use followings:
// WP_CONTENT_DIR, WP_CONTENT_URL, WP_PLUGIN_DIR, WP_PLUGIN_URL, UPLOADS
// for moving theme directory:
// it's not possibile, but it's possibile to add a new folder for themes using: register_theme_directory

// wordpress queries
//   http://benmarshall.me/wordpress-sql-queries/

// VARIOUS
// support shortcodes everywhere: http://stephanieleary.com/2010/02/using-shortcodes-everywhere/
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );

add_filter( 'comment_text', 'shortcode_unautop' );
add_filter( 'comment_text', 'do_shortcode' );

add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode' );

add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode' );

// change excerpt length/text
add_filter( 'excerpt_length', function(){ return 20; }, 99 );
add_filter( 'excerpt_more', function($t){ return '&hellip;'; }, 99 );

// remove automatic paragraphs adding
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

// filter out hard-coded width, height attributes on all images: https://gist.github.com/4557917
function remove_thumbnail_dims($html) {
	// Loop through all <img> tags
	if (preg_match_all('/<img[^>]+>/ims', $html, $matches)) {
		foreach ($matches as $match) {
			// Replace all occurences of width/height
			$clean = preg_replace('/(width|height)=["\'\d%\s]+/ims', "", $match);
			// Replace with result within html
			$html = str_replace($match, $clean, $html);
			// error_log($match);
		}
	}
	return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dims', 10 );
add_filter( 'the_content', 'remove_thumbnail_dims', 10 );
add_filter( 'get_avatar','remove_thumbnail_dims', 10 );

// human_time_diff explanation
// https://codex.wordpress.org/Function_Reference/human_time_diff
{
	?>
	<?php // To print an entry's time ("2 days ago"): ?>
	<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>

	<?php // Internationalized version: ?>
	<?php printf( _x( '%s ago', '%s = human-readable time difference', 'your-text-domain' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?>

	<?php // For comments: ?>
	<?php printf( _x( '%s ago', '%s = human-readable time difference', 'your-text-domain' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
	<?php
}

// log in as any user
wp_set_auth_cookie( $user_id );

// setup email content to html by default
// usage: wp_mail( 'someonesemail@example.com', 'Hello!', '<b>strong bodies.</b>' );
add_filter( 'wp_mail_content_type', function(){ return 'text/html'; });

// change logo to the admin login page
add_action( 'login_head', 'wpctb__admin_login_logo');
function wpctb__admin_login_logo(){
	?>
	<style type="text/css">
		h1 a {
			background-image:url('<?php echo get_stylesheet_directory_uri()."/img/logo.png" ?>') !important;
			margin-bottom: 10px;
			padding: 20px;
		}
	</style>
	<?php
	// <script type="text/javascript">window.onload = function(){document.getElementById("login").getElementsByTagName("a")[0].href = "'. home_url() . '";document.getElementById("login").getElementsByTagName("a")[0].title = "Go to site";}</script>';
}

// add support to posts/pages/ctps
add_action( 'init', function(){
	// add excerpt to pages
	add_post_type_support( 'page', 'excerpt' );
} );

/**#@+
 * DEBUGGING STUFF
 */
!defined('ACTION_DEBUG') && define('ACTION_DEBUG', WP_DEBUG);
/** This will allow you to edit the scriptname.dev.js files in the wp-includes/js and wp-admin/js directories.  */
!defined('SCRIPT_DEBUG') && define('SCRIPT_DEBUG', WP_DEBUG);

// boh | todo: move to something that executes only once or into a cron
{
	// @ http://wpsecure.net/secure-wordpress/
	wpctb__file_secure( ABSPATH.'/wp-config.php', 0600 );
	// thank you Acunetix
	wpctb__file_secure( ABSPATH.'/wp-admin/install.php', 0000 );
	wpctb__file_secure( ABSPATH.'/wp-admin/upgrade.php', 0000 );
	wpctb__file_secure( ABSPATH.'/wp-admin/.htaccess', 0644, "Order deny,allow\nDeny from all" );
	wpctb__file_secure( ABSPATH.'/wp-config/debug.log', 0000 );
	wpctb__file_silence( WP_CONTENT_DIR.'/index.php' );
	wpctb__file_silence( WP_CONTENT_DIR.'/plugins/index.php' );
	wpctb__file_silence( WP_CONTENT_DIR.'/themes/index.php' );
	wpctb__file_silence( WP_CONTENT_DIR.'/uploads/index.php' );
}

